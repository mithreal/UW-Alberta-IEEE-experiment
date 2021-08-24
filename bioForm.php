<html>
<head>
<style>.error {color: #FF0000;}</style>
<script type="text/javascript">
function getRadioValue(name) {
    var val;
    var radios = bioData.elements[name];
    for (i = 0, len = radios.length; i < len; i++) {
        
        if (radios[i].checked) {
            val = radios[i].value;
            break;
        }
    }
    return val;
}
function validate() {
    var error="";
    var headphones = document.getElementById("headphones");
    var age = document.getElementById("age");
    var gender = getRadioValue("gender")
    var hearingLoss = getRadioValue("hearingLoss");
    var EngLang = getRadioValue("EngLang");
    
    if (headphones.value == "") {
        error = "You must enter your type of headphones";
        document.getElementById( "error_message" ).innerHTML = error;
        return false;
    } else if (age.value == "") {
        error = "You must enter your age.";
        document.getElementById( "error_message" ).innerHTML = error;
        return false;
    } else if (isNaN(age.value)) {
        error = "Your age must be a number.";
        document.getElementById( "error_message" ).innerHTML = error;
        return false;
    } else if (gender === undefined) {
        error = "You must enter your gender.";
        document.getElementById("error_message").innerHTML = error;
        return false
    } else if (hearingLoss === undefined) {
        error = "You must answer: do you have any hearing loss?";
        document.getElementById("error_message").innerHTML = error;
        return false
    } else if (EngLang === undefined) {
        error = "You must answer: is English your first language?"; 
        document.getElementById("error_message").innerHTML = error;
        return false
    } else {
        return true;
    }
}

</script>

</head>
<body>
    <h2>Instructions</h2>
    <p>Please enter the requested data below. This data is anonymous and is associated with individual experiment runs.</p>
    <p>For headphones, please enter the type of headphones you are using (manufacturer and product). If you don't know, <br>
    please enter either earbuds or headset.</p> 

<h2>Enter Biographical Data</h2>		
<span class="error"><h3 id="error_message"></h3></span>
<form method="POST" id="bioData" action="db_bio.php" onsubmit="return validate();">
        What type of headphones are you using:
        <br><input id="headphones" type="text" name="headphones">
        <br>
        Age:
        <br><input id="age" type="text" name="age">
        <br>
        Gender:
        <br>
        <input type="radio" name="gender" value="female">Female
        <input type="radio" name="gender" value="male">Male
        <input type="radio" name="gender" value="other">Other
        <br>
        Do you have any hearing loss?
        <br>
        <input type="radio" name="hearingLoss" value="yes">Yes
        <input type="radio" name="hearingLoss" value="no">No
        <br>
        Is English your first language?
        <br>
        <input type="radio" name="EngLang" value="yes">Yes
        <input type="radio" name="EngLang" value="no">No
        <br><br>
        <input type="submit" name="submit" value="Submit">  
</form>

</body>
</html>