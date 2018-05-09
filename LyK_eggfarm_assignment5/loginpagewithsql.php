<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Egg Farm</title>
    <link rel="stylesheet" type="text/css" href="loginpageCSS.css">

    <script>
        function validateForm()
        {
            var username= document.forms["login"]["username"].value;
            var password= document.forms["login"]["password"].value;
            if (username==="" || password==="")
            {
                window.alert("Field cannot be left blank!");
                return false;
            }
        }
    </script>
</head>


<body>
<!--in PHP, open the config file configFile.txt-->
<!--then get the first line using fgets, followed by the second line-->
<!--save these into the $gold and $time variables respectively-->
<?php
//$filename = 'configFile.txt';  #save your configFile to a filename variable
$filename="users.txt";
$filehandle = fopen($filename,'r');
$_SESSION["gold"] = fgets($filehandle);
$_SESSION["time"] = fgets($filehandle);
fclose($filehandle);                  # close file
?>


<script>

</script>

<div class="panel">
    <h1>Welcome to Egg Farm!</h1>
    <h2>Each play will cost you 10 gold</h2>

<img src="./image014.png" class="barn">
<p>Please enter your username and password</p>

    <div class="login">
<!--        <form action= "navigationmenu.php" method="post">-->
            <form action ="navigationmenuwithSWL.php" onsubmit="return validateForm()" method="post">
            <p>Enter your username:
                <br><input type="text" name="username" required>
                <br>Enter your password:
                <br><input type="password" name="pass" required>
                <br><input type="submit" value="Submit">
        </form>

    </div>



</div>


</body>
</html>