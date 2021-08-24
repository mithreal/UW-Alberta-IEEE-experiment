<html>
<head>
<script>
    function playAudio(file) {
        var audio = new Audio(file);
        audio.play();
    }
</script>
</head>
<h1>Sound Test</h1>

<p>With your headphones on, play both audio files in order to adjust your volume to a comfortable level.<br>
   When you are finished, click the Next button<p>

<button id="ts1" onclick=playAudio("/uwnu-v2/speakers/PNM055/audio/PNM055_04-06_N1.wav")>Test 1</button>
<button id="ts2" onclick=playAudio("/uwnu-v2/speakers/PNF139/audio/PNF139_05-01_N1.wav")>Test 2</button>


<div id="next">
<input type = "button" onclick="location.href='practice.php'"; value="Next"/>
</div>
