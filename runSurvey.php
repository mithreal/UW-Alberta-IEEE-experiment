<html>
<head>
    <Title>UW-Alberta IEEE Sentences</Title>
    <?php
        session_start();
        $id = session_id();
    ?>
    <link rel="stylesheet" type="text/css" href="svy.css">
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script>
    
        var id = "<?php echo $id; ?>";
        var listName = "";
        var fname = "";
        var response = "";
        var responseFile = "";
        function reveal() {
            document.getElementById("reveal").style.display = "block";
        }    
        $(document).ready(function(){   
            $("#COMPLETE").hide();        
            $("#start").click(function(){
                $("#intro").hide();
                $("#start").hide();
                $("#fascHide").show();
                $("#surveyID").text("id: " + id);
                var data = [id, id, responseFile];
                $.post("getAudio.php", {data}, function(data, status){
                    $("#status").text("DataS: " + data + " Status: " + status);                    
                    xt = data.split(",");
                    listName = xt[0];
                    fname = xt[1];
                    if (fname == true) {
                        $("#COMPLETE").show();
                        return true;
                    } else {
                        var x = document.getElementById("sentence");
                        x.setAttribute('src', fname);
                        x.setAttribute('onended', "reveal()");
                        x.play(); 
                    }
                });
            });
            $(document).on('submit', '#sentence_in', function() {
                $("#reveal").hide();
                responseFile = fname;
                $("#responseFile").text("responseFile: " + responseFile);
                var response = $("input#data_in").val();
                var data = [id, response, responseFile];
                $("#sentence_in").trigger("reset");
                $.post("getAudio.php", {data}, function(data, status) {
                    var xt = data.split(",");
                    listName = xt[0];
                    fname = xt[1];
                    if (fname == true) {
                        $("#COMPLETE").show();
                        return true;
                    } else {
                        var x = document.getElementById("sentence");
                        x.setAttribute('src', fname);
                        x.setAttribute('onended', "reveal()");
                        x.play();
                    }
                });
                return false;
            });    
        }); 
    </script>
</head>
<body>

    <div id ="intro">
        <h1>UWNU-Alberta Experiment Run</h1>

        <h3>Instructions:</h3>
        <p>Just like in the practice run, once you press the start button, a "+" sign will pop up. A sound file will play. 
        Some of the sound files contain background noise, which will make it more difficult to understand what is being said.
        When it has finished playing, enter what you heard to the best of your ability.</p>
        <p>Please do not refresh the page or use the back arrow during the experiment run. If you do so accidentally, just return
        to this page and press the Start button again to continue. There are 120 sound files, though an individual experimental 
        run is likely to take 30 minutes to 1 hour.</p>
        <p> When your experiment is finished, follow the instructions to get to the thank you page, where you will be able to obtain
        verification for instructional purposes.</p>
        <br>
    </div>

    <button id = "start">Start</button>

    <div id="fascHide">
        <img src="images/Plus_symbol.jpg">
    </div>
    
    <div id="COMPLETE"><h3>The experiment is finished. Thank you for your participation!</h3><p><h4><a href='thankyou.php'>Click here for verification.<a></h4></p></div>
    <audio id="sentence"></audio>

    <div id = "reveal">
        <br>
        <form method = "post" id = "sentence_in" action = "">
            <input id = "data_in" style="width: 400px" type="text">
            <br>
            <input type="submit" name="submit" value="Submit">
        </form>
    </div>

</body>
</html>


