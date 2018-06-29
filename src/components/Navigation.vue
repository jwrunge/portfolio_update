<template>
    <div id='nav'>
        <transition name='navtrans' mode='out-in' appear>
            <div id='nav_bar' key='fullnav' v-if='shown' @mouseleave='shown = false'> 
                <router-link to='/about'>About</router-link>
                <router-link to='/services'>Services</router-link>
                <router-link to='/portfolio'>Portfolio</router-link>
            </div>

            <div id='nav_mouseover' key='navprompt' v-else @mouseenter='shown = true' @click='shown = true'>
                <img src='~../assets/menu.svg'/>
            </div>
        </transition>
    </div>
</template>

<script>

    export default {
        name: 'Navigation',
        data() {
            return {
                shown: false
            }
        }
    }

</script>

<style lang='scss' scoped>

    #nav {
        position: fixed;
        width: 100%;
        top: 0; left: 0;
        min-height: 1em;
        text-align: center;
        z-index: 100;

        a {
            color: white;
            margin: 1em;
            padding: .5em; 

            &:hover{ color: #fff991; }
            &.router-link-active {
                background-color: #ff8133;
                border-radius: 3px;
                box-shadow: 0 2px 4px #00000088;
                &:hover { color: white; text-decoration: none; }
            }
        }
    }

    #nav_bar {
        padding-top: 2em;
        padding-bottom: 2em;
        position: relative;
        background-color: #03587c;
        transition: top .2s ease-in-out, opacity .2s ease-in-out;
        box-shadow: 0 0 10px #000000;
        overflow: hidden;
    }

    #nav_mouseover {
        width: 100%;
        text-align: center;
        height: 1.5em;
        position: relative;
        background-color: #03587c;
        cursor: pointer;
        transition: top .2s ease-in-out, opacity .2s ease-in-out;
        box-shadow: 0 0 10px #000000;

        img {
            width: 3em;
            margin: 0 auto;
        }
    }

    /*
        TRANSITIONS
    */
    .navtrans-enter {
        top: -2em;
        opacity: 0;
    }

    .navtrans-enter-to {
        top: 0;
        opacity: 1;
    }

    .navtrans-leave {
        top: 0;
        opacity: 1;
    }
    
    .navtrans-leave-to {
        top: -2em;
        opacity: 0;
    }
</style>