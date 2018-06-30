<template>
    <div class='entry'>
        <img :src='entry.src' :alt='entry.alt'/>
        <div class='title'>{{ entry.title }}</div>
    </div>
</template>

<script>

export default {
  name: 'PortEntry',
  props: [ 'entry' ]
}

</script>

<style lang='scss' scoped>
    .entry {
        margin-bottom: 2em;
        background-color: #03587c;
        display: inline-block;
        border-top-right-radius: 2px;
        border-top-left-radius: 2px;
        box-shadow: 0 2px 4px #00000088;
        overflow: hidden;

        img { min-width: 100%; }

        .title { 
            width: 90%;
            color: white;
            text-align: center;
            padding: 5%;
            border-bottom-right-radius: 2px;
            border-bottom-left-radius: 2px;
        }
    }
</style>
