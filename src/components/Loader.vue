<template>
    <div id='loadingScreen' ref='loadingScreen'>
        <div id='left_shutter' ref='left_shutter'></div>
        <div id='right_shutter' ref='right_shutter'></div>
        <div id='setup_loading' ref='setup_loading'>
            <p>Getting set up</p>
            <svg ref='ellipsis' viewBox="0 0 110 100" xmlns="http://www.w3.org/2000/svg">
                <circle cy='50' cx='35' r='5' fill='#222' id='one'/>
                <circle cy='50' cx='90' r='10' fill='#aaa' id='four'/>
                <circle cy='50' cx='20' r='10' fill='#aaa' id='two'/>
                <circle cy='50' cx='55' r='13' fill='#fff' id='three'/>
            </svg>
        </div>
    </div>
</template>

<script>

    export default {
        name: 'Loader',
        
        created() {
            var context = this
            window.addEventListener('load', function(){
                //Make sure loading screen doesn't just blink on and then off if no load time
                setTimeout(function(){ 
                    context.openAll()
                    context.$emit("loaded")
                 }, 2000);
            })
        },

        mounted() {
            try{
                var elone = document.getElementById('one')
                var eltwo = document.getElementById('two')
                var elthree = document.getElementById('three')
                var elfour = document.getElementById('four')
                TweenMax.to(elone, .7, { attr:{ r: 10, cx: 20, fill: '#aaa' }, repeat: -1, ease: Power2.easeInOut })
                TweenMax.to(eltwo, .7, { attr:{ r: 13, cx: 55, fill: '#fff' }, repeat: -1, ease: Power2.easeInOut })
                TweenMax.to(elthree, .7, { attr:{ r: 10, cx: 90, fill: '#aaa' }, repeat: -1, ease: Power2.easeInOut })
                TweenMax.to(elfour, .7, { attr:{ r: 5, cx: 80, fill: '#222' }, repeat: -1, ease: Power2.easeInOut })
            }
            catch(err) {
                console.log('GreenSock animation library failed to load or is unsupported; some animations will not work properly.')
            }
        },

        beforeDestroy() {
            window.removeEventListener('load')
        },

        methods: {
            openAll() {
                this.$refs['left_shutter'].classList.add('open')
                this.$refs['right_shutter'].classList.add('open')
                this.$refs['setup_loading'].classList.add('open')
            }
        }
    }

</script>

<style lang='scss' scoped>

    //Ellipse animation

    #loading_screen
    {
        position: relative;
        z-index: 1100;
    }

    #left_shutter, #right_shutter
    {
        width: 50%;
        position: absolute;
        top: 0;
        background-color: black;
        height: 100vh;
        transition: width .75s ease-in-out;

        &.open { width: 0; }
    }

    #left_shutter { left: 0; }
    #right_shutter { right: 0; }

    #setup_loading
    {
        position: absolute;
        display: block;
        width: 100%;
        text-align: center;
        left: 0;
        top: 45vh;
        transition: opacity .5s ease-in-out;
        pointer-events: none;
        z-index: 1101;

        p {
            color: white;
            margin: 0;
        }

        svg {
            height: 3em;
            margin: 0;
            z-index: 1102;
        }

        &.open { opacity: 0; }
    }
</style>