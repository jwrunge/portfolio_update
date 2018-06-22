<template>
    <div id='loadingScreen' ref='loadingScreen'>
        <div id='left_shutter' ref='left_shutter'></div>
        <div id='right_shutter' ref='right_shutter'></div>
        <div id='setup_loading' ref='setup_loading'>
            <p>Getting set up</p>
            <svg width="200px"  height="200px"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid" class="lds-ellipsis" style="background: none;">
                <circle cx="84" cy="50" r="0" fill="#d3d3d3">
                <animate attributeName="r" values="10;0;0;0;0" keyTimes="0;0.25;0.5;0.75;1" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" calcMode="spline" dur="2s" repeatCount="indefinite" begin="0s"></animate>
                <animate attributeName="cx" values="84;84;84;84;84" keyTimes="0;0.25;0.5;0.75;1" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" calcMode="spline" dur="2s" repeatCount="indefinite" begin="0s"></animate>
                </circle>
                <circle cx="16" cy="50" r="9.99265" fill="#979797">
                <animate attributeName="r" values="0;10;10;10;0" keyTimes="0;0.25;0.5;0.75;1" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" calcMode="spline" dur="2s" repeatCount="indefinite" begin="-1s"></animate>
                <animate attributeName="cx" values="16;16;50;84;84" keyTimes="0;0.25;0.5;0.75;1" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" calcMode="spline" dur="2s" repeatCount="indefinite" begin="-1s"></animate>
                </circle>
                <circle cx="84" cy="50" r="0.00735188" fill="#e1e1e1">
                <animate attributeName="r" values="0;10;10;10;0" keyTimes="0;0.25;0.5;0.75;1" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" calcMode="spline" dur="2s" repeatCount="indefinite" begin="-0.5s"></animate>
                <animate attributeName="cx" values="16;16;50;84;84" keyTimes="0;0.25;0.5;0.75;1" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" calcMode="spline" dur="2s" repeatCount="indefinite" begin="-0.5s"></animate>
                </circle>
                <circle cx="83.975" cy="50" r="10" fill="#ffffff">
                <animate attributeName="r" values="0;10;10;10;0" keyTimes="0;0.25;0.5;0.75;1" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" calcMode="spline" dur="2s" repeatCount="indefinite" begin="0s"></animate>
                <animate attributeName="cx" values="16;16;50;84;84" keyTimes="0;0.25;0.5;0.75;1" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" calcMode="spline" dur="2s" repeatCount="indefinite" begin="0s"></animate>
                </circle>
                <circle cx="49.975" cy="50" r="10" fill="#d3d3d3">
                <animate attributeName="r" values="0;0;10;10;10" keyTimes="0;0.25;0.5;0.75;1" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" calcMode="spline" dur="2s" repeatCount="indefinite" begin="0s"></animate>
                <animate attributeName="cx" values="16;16;16;50;84" keyTimes="0;0.25;0.5;0.75;1" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" calcMode="spline" dur="2s" repeatCount="indefinite" begin="0s"></animate>
                </circle>
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
                setTimeout(function(){ 
                    context.openAll()
                    context.$emit("loaded")
                 }, 2000);
            })
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

<style lang='scss'>

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

        p {
            color: white;
            margin: 0;
        }

        svg {
            width: 2em;
            height: 50px;
            margin: 0;
        }

        &.open { opacity: 0; }
    }

</style>