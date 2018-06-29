<template>  
    <div class='page'>
        <h1>About Jake</h1>
        <div class='bluestrip'></div>
        <div class='content'>
            <div class='block narrowed small_bottom'>
                <h2>Who am I?</h2>
                <p>I'm a web developer living in Illinois with my wife, Mary (who is awesome). We lead pretty busy lives, so we mostly enjoy any opportunity we can get to just stay home and watch a movie, write strange stories, or play board games. A lot of our weekends are spent on our snail's-pace home renovation.</p>
            </div>
            <img src='~../assets/j&m2.jpg' alt='Jake and Mary Runge in Autumn' class='enlargeable shadowed'/>
            <div class='block narrowed small_bottom'>
                <p>Along for the ride are our three dogs, Lucky, Max, and Sadie; and our six completely non-edible (we love them too much!) chickens, Coco, Domino, Hazel, Gracie, Tilly, and Nugget. No, we do not live on a farm! Wouldn't mind giving it a try, though...</p>
            </div>
                <img src='~../assets/dogs_new.jpg' alt='Our dogs, Lucky, Max, and Sadie' class='enlargeable shadowed'/>
            <div class='block narrowed'>
                <h2>Development</h2>
                <p>Web development has provided me the opportunity to combine the activities I have enjoyed since childhood, from art to coding to writing. It has become something I love getting lost in&mdash;practical puzzles not just to be set aside when solved, but that always make me just a little better of a coder and a little more skillful of a designer; a little more efficient and a little more adventurous. I have discovered a passion for developing engaging, responsive, and accessible designs and interfaces, and for writing code that is useful, adaptable, and efficient.</p>
                <p>I've played around with a number of different programming languages and frameworks, but have really come to love the flexibility and simplicity of Laravel (it does everything) and Vue.js (which this site relies on). I also get a lot of joy (and frustration...) out of managing my own VPS, running a LEMP stack on Ubuntu. Some of the sites in my portfolio are hosted on my server!</p>
                <p><strong>Like what you see?</strong> I'd love to hear from you! Feel free to <a href='' @click.prevent='$parent.contactModalOpen = true'>check out my code samples and get in touch with me</a>. You're also welcome to <router-link to='/portfolio'>browse my portfolio</router-link> and see what I've been working on. Thanks for the visit! Make yourself at home and stick around as long as you like. :-)</p>              
            </div>
        </div>
        <div class='bluestrip'></div>
    </div>
</template>

<script>

    export default {
        name: 'About',
        mounted() {
            this.$parent.addEnlargeListeners()
        }
    }

</script>

<style>

.regular_block { padding: 2em 1em; }

.dark_block {background-color: #02435f; background: linear-gradient(to top right, #013047, #03587c); /* Standard syntax */}

#traffic_bg
{
    background: #02435f url('~../assets/traffic_bg.jpg') no-repeat center;
    background-size: cover;
}

#library_bg
{
    background: #02435f url('~../assets/library_bg.jpg') no-repeat center;
    background-size: cover;
}

.attention_block
{
	padding: 2em 1em;
    text-align: center;
}

.attention_block p 
{
	color: white;
	margin-bottom: 2em;
	padding: 0;
}

.attention_block img
{
    max-height: 50vh;
    max-width: 90%;
}

.attention_block .leftmost
{
    order: -1;
}

.attention_block h3 {font-size: 2em; color: white; }


</style>
