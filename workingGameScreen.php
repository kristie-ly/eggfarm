<?php session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>EggFarm</title>
    <link rel="stylesheet" type="text/css" href="gamescreenCSS.css">

    <script>
        //putting everything into a game class "object"
        var game=
        {
            keepbutton: document.getElementsByClassName("keepBLocation"),
            sellbutton: document.getElementsByClassName("sellBLocation"),
            anim: document.getElementsByClassName("animalLocation"),
            egg: document.getElementsByClassName("eggPosition"),
            gameOver: true,
            game_time: <?php echo $_SESSION["time"];?>
        };

        function startGame()
        {
            game.gameOver=false;
            document.getElementById("startBPos").style.visibility="hidden";
        }

        function addUp() {
            if (game.gameOver === false)
            {
                x++; //incrementer
                document.getElementById("tapCount").innerHTML = "Taps: " + x; //changes the tap count
                //If statements that change the image & the message based on the number of clicks


                if (x > 10) {
                    game.egg[0].src = "./<?php echo $_REQUEST["chosenegg"];?>_crack1.png";
                    document.getElementById("message").innerHTML = "Keep going!";
                }
                if (x > 20) {
                    game.egg[0].src = "./<?php echo $_REQUEST["chosenegg"];?>_crack2.png";
                    document.getElementById("message").innerHTML = "Tap tap tap!";

                }
                if (x > 30) {
                    game.egg[0].src = "./<?php echo $_REQUEST["chosenegg"];?>_crack3.png";
                    document.getElementById("message").innerHTML = "Ready to hatch!!!";
                }
                if (x > 40) {
                    //    document.getElementById("animal").src = "./pig.png";
                    // document.getElementById("pinkegg").src = "./pigegg_crack3.png";
                    game.egg[0].src = "./<?php echo $_REQUEST["chosenegg"];?>_crack4.png";
                    document.getElementById("message").innerHTML = "Here's your baby!";
                    game.anim[0].src = "./pig.png";
                    game.sellbutton[0].style.visibility="visible";
                    game.keepbutton[0].style.visibility="visible";
                    return game.gameOver= true;
                }


            }
        }

        //a dictionary to be used later; assign the number of taps that each egg needs to hatch
        var numberOfTaps =
            {
                mouseegg: "10",
                snakeegg: "20",
                roosteregg: "30",
                rabbitegg: "40",
                dogegg: "50",
                sheepegg: "60",
                horseegg: "70",
                oxegg: "90",
                monkeyegg:"100",
                tigeregg:"150",
                dragonegg:"200"
            };




    </script>


</head>


<body>

<div class="panel">
    <h1 id="message"></h1>
    <h3 id="goldM" class="goldMPosition">Your Gold: 0 </h3>
    <p id = "timer" class="timerPosition"> Timer: 60</p>
    <p id = "tapCount" class="tapPosition"> Taps: 0</p>
    <img src="./nest1.png" class="nestPosition"/>
    <img src="./<?php echo $_REQUEST["chosenegg"];?>.png" class="eggPosition">
    <img src="" class="animalLocation">
    <img src="sprite_keep_0.png" class="keepBLocation">
    <img src="sprite_sell_0.png" class="sellBLocation">
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



