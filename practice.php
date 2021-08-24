<html>
<head>
<style> 
#start {
    display:block;
}
#fasc {
    display:none;
}
#sen1 {
    display:none;
}
#sen2 {
    display:none;
}
</style>
<?php

session_start();
$id = session_id();

?>
<script>
function reveal1() {
    document.getElementById("sen1").style.display = "block";
}    
function reveal2() {
    document.getElementById("sen2").style.display = "block";
}    
function start() {
    var i = document.getElementById("fasc");
    i.style.display = "block";
    var j = document.getElementById("audio1");
    j.setAttribute('src', "/uwnu-v2/speakers/PNM055/audio/PNM055_04-06_N1.wav");
    j.setAttribute('onended', "reveal1()"); 
    var x = document.getElementById("start");
    x.style.display = "none";
    var y = document.getElementById("par1");
    y.style.display = "none";
    var a = document.getElementById("par2");
    a.style.display = "none";
    var z = document.getElementById("practice");
    z.style.display = "none";
    j.play();
}
function first() {
    var i = document.getElementById("sen1");
    i.style.display = "none";
    var j = document.getElementById("audio1");
    j.setAttribute('src', "/uwnu-v2/speakers/PNF139/audio/PNF139_05-01_N1.wav");
    j.setAttribute('onended', "reveal2()"); 
    j.play();
}    
</script>
</head>
<body>
<h1 id='practice'>Practice</h1>

<p id="par1">
This is a chance to practice with the same two sentences used in the sound test.<br>
When you press Start, a large + sign will appear, and an audio file will be played.<br>
After the audio file has played, a response box will appear. Enter what you heard<br> 
to the best of your ability. 
</p><p id="par2">
When you hit Submit, the response box will disappear, and a new sentence will be<br>
played. Repeat the same procedure. After the second sentence, you will be redirected<br>
to the experiment itself.  
</p>

<button id="start" onclick="start()">Start</button>

<div id="fasc">
    <img src="images/Plus_symbol.jpg">
</div>

<audio id="audio1"></audio>

<div id = "sen1">
    <input style="width: 400px" type="text">
    <br>
    <input type="submit" name="submit" value="Submit" onclick="first()">
</div>

<div id = "sen2">
    <input style="width: 400px" type="text">
    <br>
    <input type="submit" name="submit" value="Submit" onclick="location.href='runSurvey.php'">
</div>
</body>
