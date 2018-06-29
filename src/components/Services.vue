<template>  
    <div class='page'>
        <h1>Services</h1>
        <div class='bluestrip'></div>
        <div class='content'>
            <div class='block narrowed'>
                <h2>Let me build you something awesome</h2>
                <p>I build <b>dynamic, responsive, vibrant web experiences</b> that are both <b>intuitive and fun to interact with</b>. From static, promotional websites to interactive web applications, my designs will give your users something to remember you by.</p>
                <p class='emph'>Your web presence is important.</p>
                <p>Whether you need to maintain client information, to provide sales and service over the internet, or just to get the word about your business or organization out there, <b>quality matters</b>. I begin the design process by learning as much about you and your organization as possible - your core values, your workflow, your client base, your personality. Your web presence shouldn't be a generic template with your logo slapped on top. Your web presence should reflect you, your employees, and your clients.</p>
                
                <div class='button_list'>
                    <router-link to='/portfolio'><input class='samples' type='button' value='See my portfolio'/></router-link>
                    <input class='getintouch' type='button' @click='$parent.contactModalOpen = true' value='Get in touch'/>
                </div>
            </div>

            <div class='block dark attention'>
                <img src='~../assets/responsive.svg' class='enlargeable'/>
                <div class='fifty'>
                    <h3><span class='line'>Responsive designs</span> <span class='line'>built for every</span> <span class='line'>screen size</span></h3>
                    <p>Every design is rigorously tested to ensure it looks just as good on a tiny smartphone as it does on a widescreen computer monitor, and everything inbetween. With <a href='https://marketingland.com/mobile-top-sites-165725' target='_blank'>56% of consumer web traffic coming from mobile devices</a>, it's just silly not to.</p>
                </div>
                <br clear='both'/>			
            </div>
                
            <div id='library_bg' class='block attention innershadow'>
                <img src='~../assets/databook.svg' class='enlargeable'/>
                <div class='fifty leftmost'>
                    <h3><span class='line'>Strong back-end</span> <span class='line'>architecture </span> <span class='line'>and data management</span></h3>
                    <p>Solid server-side architecture for dynamic, interactive web applications; reliable database interaction and record-keeping. Your application will have all the data your clients need ready and waiting.</p>
                </div>
                <br clear='both'/>					
            </div>
            
            <div class='block dark attention'>
                <img src='~../assets/intuitive.svg' class='enlargeable'/>
                <div class='fifty'>
                    <h3><span class='line'>UI that's intuitive</span> <span class='line'>and fun to use</span></h3>
                    <p>Your app or website works how your clients think it should, both with a mouse and keyboard and with a touchscreen. And because good user interface design is also fun to interact with, your site will never be boring!</p>
                </div>
                <br clear='both'/>					
            </div>
            
            <div id='traffic_bg' class='block attention innershadow'>
                <img src='~../assets/traffic_light.svg' class='enlargeable'/>
                <div class='fifty leftmost'>
                    <h3><span class='line'>Drive traffic</span> <span class='line'>to your app</span> <span class='line'>or website</span></h3>
                    <p>Search engine optimization, conservative download sizes, and ease of use bring visitors in; vibrant design, useful functionality, and an enjoyable user experience keep them coming back.</p>
                </div>
                <br clear='both'/>					
            </div>

            <div class='block narrowed'>
                <h2>Interested?</h2>
                <p>Do you have an idea for a website or webapp and want to discuss designs, functionality, and implementation? I look forward to hearing from you! Please <a href='' @click.prevent='$parent.contactModalOpen = true'>get in touch.</a></p>
                <p>Want to learn a little more about me? Take a look at <router-link to='/about'>my "About" page</router-link> for a brief personal introduction as well as a look at the technologies I use most.</p>
                <p>Want to see samples of my work? <router-link to='/portfolio'>Be sure to check out my portfolio!</router-link> It's just a sampling of the work I've done, so please feel free to reach out if I can provide any additional resources.</p>
            </div>
        </div>
        <div class='bluestrip'></div>
    </div>
</template>

<script>

    export default {
        name: 'Services',
        mounted() {
            this.$parent.addEnlargeListeners()
        }
    }

</script>

<style lang='scss' scoped>

.white { background-color: white; }

.attention
{
    text-align: center;

    p { color: white; font-size: 1.2em; }
    img { max-height: 50vh; max-width: 90%; }
    h3 {font-size: 2.5em; color: white; }

    a {
        color: #42c5f4;
        text-decoration: none;
        &:hover {color: #87dfff; text-decoration: underline;}
    }

    @media screen and (min-width: 800px) {
        padding: 4em 10%;
		display: flex;
		text-align: center;
		align-items: center; /* align vertical */
		flex-direction: row;

        .fifty { width: 50%; padding: 1em; }
        .leftmost { order: -1; }
        img {
            width: 50%;
            padding: 1em;
            max-height: 70vh;
        }

        .left_img
        {
            display: inline;
            float: left;
            width: 40%;
            margin-right: .5em;
        }

        .right_img
        {
            display: inline;
            float: right;
            width: 40%;
            margin-left: .5em;
        }
    }
}

.innershadow { box-shadow: inset 0 0 10px #000000; }

.dark {
    background-color: #02435f; 
    background: linear-gradient(to top right, #013047, #03587c); /* Standard syntax */
}

#traffic_bg
{
    background: #02435f url('~../assets/traffic_bg.jpg') no-repeat center;
    background-size: cover;
    background-attachment: fixed;
}

#library_bg
{
    background: #02435f url('~../assets/library_bg.jpg') no-repeat center;
    background-size: cover;
    background-attachment: fixed;
}

span.line { display: inline-block; }

</style>
