<template>
  <div>
    <navigation v-if='!splashOpen'></navigation>

    <div id='bgimg' v-if='isThin'></div>
    <video id='bg' alt='' ref='video' v-else muted>
      <source src='~./assets/video/Coffee.mp4' type='video/mp4'/>
    </video>
    
    <transition name='page-in' mode='out-in'>
      <router-view v-if='allLoaded' :entries='entries'></router-view>
    </transition>

    <Loader @loaded='loaded'></Loader>
    <Modal v-if='contactModalOpen' @close='contactModalOpen = false'>
      <Contact></Contact>
    </Modal>
    <PicViewer v-if='viewer.open' :source='viewer.src' @close='viewer.open = false'></PicViewer>

  </div>
</template>

<script>
  import Loader from './components/Loader'
  import Navigation from './components/Navigation'
  import Contact from './components/Contact'
  import PicViewer from './components/PicViewer'
  import Modal from './components/Modal'

  export default {
      name: 'App',

      components: { Loader, Navigation, Contact, PicViewer, Modal },

      data () {
        return {
          allLoaded: false,
          splashShown: false,
          contactModalOpen: false,
          viewer: { open: false, src: '' },
          entries: {}
        }
      },

      created() {
        this.getPortfolioEntries()
      },

      computed: {
        isThin() {
          return window.outerWidth < 700
        },
        splashOpen() {
          if(this.allLoaded)
            return this.$route.path === '/splash' || this.$route.path === '/'
          else return true
        }
      },

      methods: {
        loaded() {
          //Play video, mark everything loaded
          this.allLoaded = true
          if(this.$refs['video'])
            this.$refs['video'].play()
        },

        addEnlargeListeners() {
          //Add event listeners for enlarging images
          var enlargeables = document.getElementsByClassName('enlargeable')
          for(var i=0; i<enlargeables.length; i++) {
            enlargeables[i].addEventListener('click', this.enlargeImg)
          }
        },

        enlargeImg(e) {
          this.viewer.open = true
          this.viewer.src = e.target.src
        },

        //Get portfolio entries
        getPortfolioEntries() {
          var context = this
          var xhr = new XMLHttpRequest();
          xhr.open('GET', '/static/data/portfolio_entries.json', true);
          xhr.responseType = 'json';
          xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
              context.entries = xhr.response
            }
          };
          xhr.send();
        },

        // Processing text
        addLineBreaks: function (text) {
          var newstring = '<p>'
          var brokentext = text.split('\n')
          newstring += brokentext.join('</p><p>') + '</p>'
          return newstring
        },

        // Staggering item entry
        beforeEnter: function (el) {
          el.style.opacity = 0
          el.style.left = '-.5em'
        },
        enter: function (el, done) {
          var delay = (el.dataset.index * 200)
          setTimeout(function () {
            el.style.opacity = 1
            el.style.left = 0
          }, delay)
        }
      }
  }

</script>

<style lang='scss'>

  /* 
    Body, fonts, and background
  */
  body { 
    margin: 0 auto;
    max-width: 3840px;
    padding: 0;
    background-color: black;
    overflow-y: scroll; 
    overflow-x: hidden; 
    font: normal normal normal 14px 'Pontano Sans', sans-serif;
    background-color: #000;

    @media screen and (min-width: 800px) {
      font-size: 18px;
    }

    @media screen and (min-width: 1600px) {
      font-size: 24px;
    }

    @media screen and (min-width: 2400px) {
      font-size: 30px;
    }

    @media screen and (min-width: 3000px) {
      font-size: 42px;
    }

    @media screen and (min-width: 3840px) {
      font-size: 56px;
    }
  }

  h1, h2, h3, h4, h5
  {
    font-family: 'Open Sans Condensed', sans-serif;
    font-weight: normal;
    margin: 0;
    margin-bottom: .4em;
    padding: .5em 0 0 0;
  }

  h1 { text-align: center; font-size: 4em; color: white;}
  h2 { font-size: 2em; font-weight: bold; color: #03587c;}
  h3 { font-size: 1.5em; color: black;}
  h4 { font-size: 1.12em; font-weight: bold; color: black; margin-bottom: .1em;}
  h5 { font-size: 1em; font-weight: bold; color: gray; margin-bottom: .1em;}

  p 
  {
    font-size: 1em;
    color: black;
    padding: 0;
    margin: 0;
    margin-bottom: 1em;

    &.emph {
      font-size: 1.3em;
      font-weight: bold;
    }
  }

  a {
    color: #ff8133;
    text-decoration: none;
    &:hover {color: #ffaa66; text-decoration: underline;}
  }

  ul
  {
    margin-top: 0;
    margin-bottom: 1em;
  }

	#bg
	{
		position: fixed;
		top: 0; left: 0;
		z-index: -1;
		width: 100%;
		height: 100vh;
		background-color: #000000;
		object-fit: cover;
	}

	#bgimg
	{
		width: 100%;
		height: 100vh;
		position: fixed;
		top: 0; left: 0;
		background-image: url('~./assets/novideo_bg.jpg');
		background-attachment: fixed;
		background-size: cover;
		background-position: top left;
		z-index: -100;
	}

  /*
    Buttons
  */
  div.button_list
  {
      text-align: center;
      margin: 2em auto .5em auto;
  }

  input[type=button], button
  {
    border: none;
    min-width: 8em;
    background-color: #ff8133;
    padding: 1em .5em;
    margin: .5em;
    color: white;
    border-radius: 2px;
    cursor: pointer;
    font-size: 1em;
    box-shadow: 0 2px 4px #00000088;
    transition: transform .2s ease-in-out, background-color .2s linear;

    &:hover { background-color: #ffaa66; }
    &:active { transform: scale(.9); }
  }

  /*
    Pages
  */
  .page {
    position: relative;
    transition: left .5s ease-out, opacity .5s ease;
    width: 100%;
    top: 30vh;
    min-height: 70vh;
    margin: 0 auto;

    h1 { position: relative; margin-bottom: 0; }
      
    .content {
      background-color: #EEEEEE;
    }

    img {
      border-radius: 2px;
      display: block;
      margin: 0 auto;
      max-width: 100%;
      max-height: 70vh;
      
      &.shadowed { box-shadow: 0 2px 4px #00000088; }
      &.enlargeable { cursor: zoom-in; }
    }

    .bluestrip { 
      background-color: #03587c; 
      width: 100%; height: 1em;
    }
  }

  .block { 
    padding: 2em 1em;

    @media screen and (min-width: 450px) {
      padding: 6em 1em; 
    }
    
    h2:first-of-type { padding-top: 0; }
    p:last-of-type { margin-bottom: 0; } 

    &.small_bottom { padding-bottom: 2em; }
  }
  img + .block { padding-top: 2em; }

  .narrowed {
    max-width: 40em;
    margin: 0 auto;
  }

  .page-in-enter {
    opacity: 0;
    left: 10em;
  }

  .page-in-leave-to {
    opacity: 0;
    left: -10em;
  }

  .page-in-enter-to, .page-in-leave {
    opacity: 1;
    left: 0;
  }

</style>