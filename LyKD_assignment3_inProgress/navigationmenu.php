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

        div.sign
        {
            background-image: url("./pricetag.png");
            padding: 25px;
            margin-bottom: 70px;
            position: relative;
            width: 150px;
            font-family: "Chalkboard";
            font-size: 1.5em;
        }
</style>
</head>

<body>
<?php session_start(); $_SESSION["defaultgold"]=50 ?>

<div class="panel">
    <h1>Welcome to EggFarm, <?php echo $_POST["username"]; ?>!</h1>
    <p> You have <?php echo $_SESSION["defaultgold"] ?> gold </p>
    <div class="sign">Egg Store</div> <br>
    <div class="sign">My Barn</div> <br>
    <div class="sign">Scoreboard</div>
</div>

</body>
</html>