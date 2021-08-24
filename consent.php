<!DOCTYPE html>
<html>
<head>
    <?php 
        session_start();
    ?>
    <title>UW-Alberta IEEE Sentences</title>    
    <style>
        div {
            text-align: justify;
            text-justify: inter-word;
        }
        #desc {
            display: none;
        }
    </style>
    <script>
        function forward() {
            var i = document.getElementById("intro");
            i.style.display = "none";
            var j = document.getElementById("desc");
            j.style.display = "block";
        }
    </script>
</head>
<body>

    <div id="intro">
    	<h2> Please read before continuing to the experiment </h2>

        <p> You must use a computer to participate in this experiment. The experiment is not formatted for mobile devices. 
        </p>

        <p> Please ensure that nothing will distract you during the experiment. Close all other windows on your computer and 
            silence notifications from other devices. The experiment will require your full attention. 
        </p>

        <p> IMPORTANT: Please take a screen shot or photo of the thank you page at the end of the experiment. You will not 
            be able to receive credit for participation without your participant code. 
        </p>

        <p> If you try pressing the "I consent" button on the next page and the next page isn't loaded, please try pressing
            the button again. 
        </p>

        <input class="button" id="proceed" type="submit" value="Continue" onclick="forward()">
    </div>

    <div id="desc">
        <h2>Project Title: The role of fine phonetic detail in human communication</h2>
        <p>You are being invited to take part in a research study and are asked to read this form so that you know about 
           this research study. The information in this form is provided to help you decide whether or not to take part. 
           If you decide to take part in the study, you will be asked to sign this consent form. If you decide you do not 
           want to participate, there will be no penalty to you.
        </p>
        
        <h2>Purpose of this study?</h2>
        <p>The purpose of this study is to learn how people understand speech. 
        </p>

        <h2>What will I be asked to do in this study?</h2>
        <p>Your experiment session will last approximately 30 (or 60) minutes. Your task is to read or listen to words or 
           sounds and respond (via text) based on the instructions given in the experiment.
        </p>

        <h2>Will audio or video recordings be made of me during this study?</h2>
            No. The only response is text based. There is no audio or video response on the part of (you) the subject.
            
        <h2>Are there any risks to me?</h2>
        <p>No. The experiment is completely anonymous. The only identifier is the participant code. Unless that code is 
           given, there is no way to identify a participant. The code is used internally to identify a given participant's 
           run (but not the participant), and externally to provide verification that you have participated in the experiment.
        </p>
        
        <h2>Are there any benefits to me?</h2>
        <p>There is no direct benefit to you by being in this study. What researchers find out from this study may help us 
           understand how people communicate.
        </p>

        <h2>Will I be compensated for my time?</h2>
        <p>If you are in a course that gives course credit for participating in this study, you will receive a small amount of 
           course credit in your course (1% for every 30 minutes of participation). You may also choose to volunteer your time 
           and receive no compensation.
        </p>
        
        <h2>Will information from this study be kept confidential?</h2>
        <p>There is no personally identifiable information collected in this experiment. Questions about gender, hearing loss,
           age, and whether or not English is your first language will be identifiable only by the participant code. Nowhere is
           the participant code associated with your name, except to claim course credit, if you are able. 
           Information about you with regard to this experiment will be stored on computer hard drives and servers that are 
           password protected. Information about you will be kept confidential to the extent permitted or required by law. 
           People who have access to your information include the Principle Investigator and research study personnel, and 
           other scientists working with the Principal Investigator. Any information made available to others will be coded 
           with a number so that they cannot tell who you are. If there are any reports about this study, your name will not 
           be in them.
        </p>

        <h2>Whom can I contact for more information?</h2>
        <p>You can call the Principal Investigator with any questions, concerns or complaints about this research study. 
           The Principal Investigator, Benjamin V. Tucker, Ph. D., can be called at (+1)-(780)-492-5952.
        </p>
        <p>If you have any questions or concerns about how the study is being conducted, please contact the University of 
           Alberta Ethics Office at 780-492-2615. This office has no affiliation with the study investigators.
        </p>

        <h2>May I change my mind about participating?</h2>
        <p>You have the choice whether or not to be in this research study. You may decide to not begin or to stop the study at any time.
        </p>


        <form method="POST" id="consentForm" action="db_consent.php">
            <input name="rConsent" type="checkbox" value="y">Optional Release
        
            <p>I agree that the data I provide may be included (with no indication of my name or other personal information) in 
                not-for-profit scientific data archives that may be disseminated by this project or may be used by the current 
                researcher or other researchers.
            </p>
        
            <p>By checking 'I Consent' I acknowledge that I have read the above information and consent to participate in this experiment.
            </p>
            <input name="consent" required="" type="checkbox" value="y">I Consent
            <br>
            
            <input id="submit" name="submit" type="submit" value="Continue to Experiment">
        </form>
    </div>    
</body>
</html>