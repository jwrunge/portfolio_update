<template>  
    <div class='page'>
        <h1>About Jake</h1>
        <div class='bluestrip'></div>
        <div class='content'>
            <div class='block narrowed small_bottom'>
                <h2>Who am I?</h2>
                <p>I'm a web developer living in Illinois with my wife, Mary, and our three dogs, Max, Lucky, and Sadie. We lead pretty busy lives, so we mostly enjoy any opportunity we can get to just stay home and watch a movie, write strange stories, or play board games. A lot of our weekends are spent on our snail's-pace home renovation.</p>
            </div>
            <img src='~../assets/j&m2.jpg' alt='Jake and Mary Runge in Autumn' class='enlargeable'/>
            <div class='block narrowed'>
                <p>Web development has provided me the opportunity to combine the activities I have enjoyed since childhood, from art to coding to writing. It has become something I love getting lost in&mdash;practical puzzles not just to be set aside when solved, but that always make me just a little better of a coder and a little more skillful of a designer; a little more efficient and a little more adventurous. I have discovered a passion for developing engaging, responsive, and accessible designs and interfaces, and for writing code that is useful, adaptable, and efficient.</p>
                <p>Like what you see? I'd love to hear from you! Get in touch with me <a href='#contact_me' class='getintouch'>here</a>.</p>              
            </div>
        </div>
        <div class='bluestrip'></div>
    </div>
</template>

<script>

    export default {
        name: 'About'
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
