<template>
    <transition name='modal'>
        <div class='modal_container' @click='cancel' ref='modal_container'>
            <div class='modal_inner' @click.stop=''><!--Prevent cancel method from bubbling up-->
                <img class='xout' src='~../assets/xout.svg' @click='cancel'/>
                <div class='scrollable_content'>
                    <slot>
                        <h2>Whoops!</h2>
                        <p>Looks like there was no data passed to the modal. :-(</p>
                        <button class='btn btn-primary' @click='cancel'>OK</button>
                    </slot>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>

    export default {
        name: 'Modal',
        mounted () {
            this.$refs['modal_container'].style.zIndex = 3000
        },
        methods: {
            cancel () {
                this.$emit('close')
            }
        }
    }

</script>

<style lang='scss' scoped>

    .modal_container {
        background-color: rgba(0,0,0,.6);
        width: 100%;
        height: 100vh;
        position: fixed;
        top: 0;
        left: 0;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .modal_inner {
        display: block;
        background-color: white;
        padding: 1em;
        padding-top: 3.5em;
        width: 95%;
        max-width: 45em;
        margin: 1em auto;
        border-radius: 2px;
        max-height: 90vh;
        position: relative;

        @media screen and (max-width: 500px) {
            width: 100%;
            margin: 1em 0;
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

    img.xout {
        position: absolute;
        top: 1em;
        right: 1em;
        width: 1.5em;
        cursor: pointer;
    }


</style>