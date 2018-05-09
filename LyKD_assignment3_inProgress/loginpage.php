<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Egg Farm</title>
    <style type="text/css">
        .panel
        {
            background: lightskyblue;
            height: 530px;
            width: 400px;
            font-family: "American Typewriter";
            text-align: center;
        }

        .msgPosition
        {
            position: absolute;
            top: 120px;
            left: 10px;
            font-size: 16px;
            font-family: "American Typewriter";
            text-align: center;
        }
        .login
        {
            position: absolute;
            top: 150px;
            left: 25px;
            font-size: 14px;
            font-family: "American Typewriter";
        }

        .barn
        {
            position: absolute;
            top: 200px;
            left: 58px;
            height: 350px;
            width: 350px;
        }

</style>
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


<div class="panel">
    <h1>Welcome to Egg Farm!</h1>
    <h2>Each play will cost you 50 gold</h2>

<!--</div>-->


<img src="./image014.png" class="barn">
<p>Please enter your username and password</p>

    <div class="login">
        <form action= "navigationmenu.php" method="post">
            <p>Enter your username:
                <br><input type="text" name="username" required>
                <br>Enter your password:
                <br><input type="password" name="pass" required>
                <br><input type="submit" value="Submit">
        </form>

    </div>


<!--<script>-->
    <!--<form action="welcome.php" method="post">-->
        <!--Enter your username:-->
        <!--<br> <input type="text" name="username" required>-->
    <!--<br> Password:-->
    <!--<br> <input type="password" name="password" required>-->
    <!--<input type="submit" value="Submit">-->
        <!--</form>-->
<!--</script>-->



</div>


</body>
</html>