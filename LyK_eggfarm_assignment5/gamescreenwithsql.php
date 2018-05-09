<?php session_start();
$newValue = $_SESSION["gold"];
$_SESSION["chosenegg"] = $_REQUEST["chosenegg"];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>EggFarm</title>
    <link rel="stylesheet" type="text/css" href="gamescreenCSS.css">
    <?php
    $servername="localhost";
    $username = "kly5";
    $password="912703004";
    $dbname= "kly5";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error){
        die("Connection failure".$conn->connect_error);
    }
   // echo "Successfully connected to the db </br>";

    $sql = "SELECT * FROM eggs WHERE eggtype= '$_SESSION[chosenegg]'";
    $result = $conn->query($sql);
    if($result->num_rows > 0)
    {
        while($row = $result->fetch_assoc())
        {
            //echo $row["price"];
            $eggcost = $row["price"];
            //echo $eggcost;
            $_SESSION["gold"] -= $eggcost;
        }
    }
    else {
       // echo "0 results";
        echo null;
    }
    $modifygold = "UPDATE userinfo SET gold = '$_SESSION[gold]' WHERE username = '$_SESSION[username]'";
    $result = $conn->query($modifygold);

    $temp = $_SESSION["chosenegg"];
    //echo $temp;
    $animaltype= rtrim($temp,"Egg");
    //echo $animaltype;
    ?>
    <script>
        //putting everything into a game class "object"
        var game=
            {
                keepbutton: document.getElementsByClassName("keepBLocation"),
                sellbutton: document.getElementsByClassName("sellBLocation"),
                navmenubutton: document.getElementsByClassName("navmenubutton"),
                anim: document.getElementsByClassName("animalLocation"),
                egg: document.getElementsByClassName("eggPosition"),
                gameOver: true,
                game_time:60
            };

        function startGame()
        {
            game.gameOver=false;
            document.getElementById("startBPos").style.visibility="hidden";
            window.top(animalsDictionary[mouseEgg].requiredTaps);
        }

        function addUp() {
            if (game.gameOver === false)
            {
                x++; //incrementer
                document.getElementById("tapCount").innerHTML = "Taps: " + x; //changes the tap count
                //If statements that change the image & the message based on the number of clicks


                if (x > animalsDictionary["<?php echo $_SESSION["chosenegg"]?>"].requiredTaps*0.25) {
                    game.egg[0].src = "./<?php echo $_REQUEST["chosenegg"];?>_crack1.png";
                    document.getElementById("message").innerHTML = "Keep going!";
                }
                if (x > animalsDictionary["<?php echo $_SESSION["chosenegg"]?>"].requiredTaps*0.5) {
                    game.egg[0].src = "./<?php echo $_REQUEST["chosenegg"];?>_crack2.png";
                    document.getElementById("message").innerHTML = "Tap tap tap!";

                }
                if (x > animalsDictionary["<?php echo $_SESSION["chosenegg"]?>"].requiredTaps*0.75) {
                    game.egg[0].src = "./<?php echo $_REQUEST["chosenegg"];?>_crack3.png";
                    document.getElementById("message").innerHTML = "Ready to hatch!!!";
                }
                if (x > animalsDictionary["<?php echo $_SESSION["chosenegg"]?>"].requiredTaps) {
                    //    document.getElementById("animal").src = "./pig.png";
                    // document.getElementById("pinkegg").src = "./pigegg_crack3.png";
                    game.egg[0].src = "./<?php echo $_REQUEST["chosenegg"];?>_crack4.png";
                    document.getElementById("message").innerHTML = "Here's your baby!";
                    game.anim[0].src = "./<?php echo $animaltype?>.png";
                    game.sellbutton[0].style.visibility="visible";
                    game.keepbutton[0].style.visibility="visible";
                    return game.gameOver= true;
                }
            }
        }

    </script>


</head>


<body>



<div class="panel">
    <h1 id="message"></h1>
    <h3 id="goldM" class="goldMPosition">Your Gold: <?php echo $_SESSION["gold"];?> </h3>
    <p id = "timer" class="timerPosition"> Timer: 60</p>
    <p id = "tapCount" class="tapPosition"> Taps: 0</p>
    <img src="./nest1.png" class="nestPosition"/>
    <img src="./<?php echo $_REQUEST["chosenegg"];?>.png" class="eggPosition">
    <img src="" class="animalLocation">
    <a href="keepscreenwithsql.php"> <img src="sprite_keep_0.png" class="keepBLocation"> </a>
    <a href="sellscreenwithsql.php"> <img src="sprite_sell_0.png" class="sellBLocation"> </a>
    <a href="navigationmenuwithSWL.php" class="navmenubutton"> MAIN MENU </a>
    <span id="startBPos">START GAME</span>
</div>


<script>
    var x = 0;
    game.egg[0].addEventListener("click", addUp);
    document.getElementById("startBPos").addEventListener("click", startGame);
    /*Set interval function: takes 2 arguments: a function and how often to execute it (in millisecs)
    function() is defined within the braces; it automatically executes without being called
     In this function, if the game time is NOT zero, then the time decrements and is displayed
      Otherwise, if the game time hits zero, the timer stops and a msg is displayed and the interval is cleared*/

    var countdown = setInterval(function()
    {
        if (game.game_time !== 0 && game.gameOver===false)
        {
            game.game_time = game.game_time - 1;
            document.getElementById("timer").innerHTML = "Timer: " + game.game_time;
        }

        if (game.game_time <= 0)
        {
            document.getElementById("timer").innerHTML = "Timer: Game Over!";
            clearInterval(countdown);
            game.navmenubutton[0].style.visibility="visible";
            return game.gameOver = true;
        }
    }, 1000); //setinterval is a js built in method that takes a function & an interval

    var animalsDictionary =
        {
            mouseEgg:
                {
                    price: 50,
                    purchaseStatus: false,
                    requiredTaps: 40
                },
            snakeEgg:
                {
                    price: 100,
                    purchaseStatus: false,
                    requiredTaps: 50
                },
            roosterEgg:
                {
                    price: 150,
                    purchaseStatus: false,
                    requiredTaps: 60
                },
            pigEgg:
                {
                    price: 200,
                    purchaseStatus: false,
                    requiredTaps: 100
                },
            rabbitEgg:
                {
                    price: 400,
                    purchaseStatus: false,
                    requiredTaps: 120
                },
            dogEgg:
                {
                    price: 500,
                    purchaseStatus: false,
                    requiredTaps: 150
                },
            sheepEgg:
                {
                    price: 600,
                    purchaseStatus: false,
                    requiredTaps: 200
                },
            horseEgg:
                {
                    price: 700,
                    purchaseStatus: false,
                    requiredTaps: 250
                },
            oxEgg:
                {
                    price: 800,
                    purchaseStatus: false,
                    requiredTaps: 275
                },
            monkeyEgg:
                {
                    price: 1000,
                    purchaseStatus: false,
                    requiredTaps: 300
                },
            tigerEgg:
                {
                    price: 1400,
                    purchaseStatus: false,
                    requiredTaps: 310
                },
            dragonEgg:
                {
                    price: 2000,
                    purchaseStatus: false,
                    requiredTaps: 350
                }
        };



</script>

</body>
</html>



