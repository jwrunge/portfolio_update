<template>
  <div>
    <Loader @loaded='loaded'></Loader>
    <navigation v-if='allLoaded'></navigation>
    <div v-if='allLoaded'>
      <transition name='viewswitch' mode='out-in' @after-enter='afterRouteEnter' @before-leave='beforeRouteLeave'>
          <router-view></router-view>
      </transition>      
    </div>

    <div id='bgimg' v-if='isThin'></div>
    <video id='bg' alt='' ref='video'  v-else muted>
      <source src='~./assets/video/Coffee.mp4' type='video/mp4'/>
    </video>
    
  </div>
</template>

<script>
  import Loader from './components/Loader'
  import Navigation from './components/Navigation'

  export default {
      name: 'App',

      components: { Loader, Navigation },

      data () {
        return {
          allLoaded: false,
          routeTransitionEnd: false,
        }
      },

      computed: {
        isThin() {
          return window.outerWidth < 500
        }
      },

      methods: {
        loaded() {
          this.allLoaded = true
          this.$refs['video'].play()
        },

        //Route transition hooks
        afterRouteEnter() {
          this.routeTransitionEnd = true
        },
        beforeRouteLeave() {
          this.routeTransitionEnd = false
        },
      }
  }

</script>

<style lang='scss'>

	#bg
	{
		position: fixed;
		top: 0; left: 0;
		z-index: -1;
		width: 100%;
		min-height: 100vh;
		background-color: #000000;
		object-fit: cover;
	}

	#bgimg
	{
		width: 100%;
		height: 2000px;
		height: 100vh;
		position: fixed;
		top: 0;
		left: 0;
		background-image: url('~./assets/novideo_bg.jpg');
		background-attachment: fixed;
		background-size: cover;
		background-position: top left;
		z-index: -100;
	}
</style>