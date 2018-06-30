<template>
    <div class='page'>
        <h1>Portfolio</h1>
        <div class='bluestrip'></div>
        <div class='content'>
            <div class='block slightlynarrow'>
                <h2 v-if='entries.sites'>Websites</h2>
                <div class='flexlist'>
                    <PortEntry v-for='(entry, index) in entries.sites' :entry='entry' :key='index'></PortEntry>
                </div>

                <h2 v-if='entries.demos'>Demos</h2>
                <div class='flexlist'>
                    <PortEntry v-for='(entry, index) in entries.demos' :entry='entry' :key='index'></PortEntry>
                </div>

                <h2 v-if='entries.graphics'>Graphics</h2>
                <div class='flexlist'>
                    <PortEntry v-for='(entry, index) in entries.graphics' :entry='entry' :key='index'></PortEntry>
                </div>
            </div>
        </div>
        <div class='bluestrip'></div>
    </div>
</template>

<script>

import PortEntry from './PortEntry'

export default {
  name: 'Portfolio',
  props: [ 'entries' ],
  components: { PortEntry },
}

</script>

<style lang='scss' scoped>

    .slightlynarrow {
        max-width: 60em;
        margin: 0 auto;
    }

    .flexlist {
        display: grid;
        grid-gap: 1rem;
        justify-content: space-between;
        grid-template-columns: 1fr;

        @media screen and (min-width: 600px) {
            grid-template-columns: 1fr 1fr;
        }

        @media screen and (min-width: 1300px) {
            grid-template-columns: 1fr 1fr 1fr;
        }
    }

</style>
