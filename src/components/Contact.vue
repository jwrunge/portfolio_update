<template>
    <div>
        <h2>Want to get in touch?</h2>
        <div class='two-part'>
            <img src='~../assets/gmail.png' class='contact_logo'/>
            <p>Feel free to email me at <a href='mailto:jwrunge@gmail.com'>jwrunge@gmail.com</a>. I'm happy to answer any questions you may have, or just talk about web development.</p>
        </div>
        <p>If you're interested in having your website or webapp (re)designed, please contact me via email. I would love the opportunity to discuss your project!</p>
        <h2>Want to see more?</h2>
        <div class='two-part'>
            <img src='~../assets/github.svg' class='contact_logo'/>
            <p>To see the code for most of my projects, including full site designs, my JavaScript libraries and JQuery plugins, and PHP scripts, check out <a href='https://github.com/jwrunge' target='_blank'>my GitHub page</a>.</p>
        </div>
        <div class='two-part'>
            <img src='~../assets/jsfiddle.png' class='contact_logo'/>
            <p>For interactive JavaScript demos, check out <a href='https://jsfiddle.net/user/jwrunge/fiddles/' target='_blank'>my JSFiddle page</a>.</p>
        </div>
    </div>
</template>

<script>

    export default {
        name: "Contact"
    }

</script>

<style lang='scss' scoped>

    .contact_logo {
        width: 4em;
        margin: 1em 1em 1em 0;
    }

    .two-part {
        display: flex;
        justify-content: flex-start;
        align-items: center;

        p { margin-bottom: 0; }
    }

</style>