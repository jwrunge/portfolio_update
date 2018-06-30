<template>
    <transition name='modal'>
        <div class='modal_container' @click='cancel' ref='modal_container'>
            <div class='controls' @click.stop=''>
                <img src='~../assets/bwcircle.svg' @click='btow'/>
                <img ref='zoomin' src='~../assets/zoomin.svg' @click='changezoom'/>
                <img ref='zoomout' class='selected' src='~../assets/zoomout.svg' @click='changezoom'/>
                <img src='~../assets/xout.svg' @click='cancel'/>
            </div>
            <div class='modal_inner'><!--Prevent cancel method from bubbling up-->
                <img class='enlarged_img fit' ref='viewedimg' :src='source' @click.stop=''/>
            </div>
        </div>
    </transition>
</template>

<script>

    export default {
        name: 'PicViewer',
        props: ['source'],
 
        mounted () {
            this.$refs['modal_container'].style.zIndex = 3000
        },
        methods: {
            cancel () {
                this.$emit('close')
            },
            btow() {
                if(this.$refs.modal_container.classList.contains('whited'))
                    this.$refs.modal_container.classList.remove('whited')
                else this.$refs.modal_container.classList.add('whited')
            },
            changezoom() {
                if(this.$refs.viewedimg.classList.contains('fit')) {
                    this.$refs.viewedimg.classList.remove('fit')
                    this.$refs.zoomout.classList.remove('selected')
                    this.$refs.zoomin.classList.add('selected')
                }
                else {
                    this.$refs.viewedimg.classList.add('fit')
                    this.$refs.zoomout.classList.add('selected')
                    this.$refs.zoomin.classList.remove('selected')
                }
            }
        }
    }

</script>

<style lang='scss' scoped>

    .modal_container {
        background-color: rgba(0,0,0,.9);
        width: 100%;
        height: 100vh;
        position: fixed;
        top: 0;
        left: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        transition: background-color .5s;

        &.whited { background-color: rgba(255,255,255,.9); }
    }

    .modal_inner {
        display: block;
        width: 95%;
        margin: 1em auto;
        border-radius: 2px;
        max-height: 90vh;
        overflow: auto;
        position: relative;

        @media screen and (max-width: 500px) {
            width: 100%;
            margin: 1em 0;
        }

        img {
            display: block;
            margin: 0 auto;
            min-width: 100%;
            max-width: 300%;
            max-height: 200vh;
            border-radius: 2px;
            transition: all .5s ease-in-out;

            &.fit {
                min-width: 0;
                max-width: 100%;
                max-height: 90vh;
            }

        }
    }

    .modal-enter-active, .modal-leave-active {
        transition: opacity .2s;

        & .modal_inner {
            transition: transform .2s;
        }
    }

    .modal-enter, .modal-leave-to {
        opacity: 0;

        & .modal_inner {
            transform: scale(.75);
        }
    }

    .scrollable_content {
        max-height: 80vh;
        overflow-y: auto;
    }

    .controls {
        position: absolute;
        padding-top: .3em;
        top: 1em;
        margin: 0 auto;
        z-index: 3001;
        background-color: white;
        border-radius: 2px;
        box-shadow: 0 2px 4px #00000088;
        transition: background-color .5s, opacity .5s;
        
        @media screen and (min-width: 500px) {
            opacity: .3;
            &:hover { opacity: 1; }
        }

        img {
            width: 1.5em;
            cursor: pointer;
            margin: .5em;

            &.selected {
                display: none;
            }

            & + img {
                margin-left: 0;
            }
        }
    }

</style>