<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Egg Farm</title>
    <link rel="stylesheet" type="text/css" href="eggstoreCSS.css">

    <script>
        //        var shop=
        //            {
        //                gold: 900,
        //                eggs: document.getElementsByClassName("eggs"),
        //                buyButton: document.getElementById("buyButtonLocation"),
        //                goldamt: document.getElementsByClassName("goldAmount"),
        //                selectedEgg: document.getElementsByClassName("selectedEgg"),
        //                isPurchased: false
        //            };



        //When egg is clicked, assign it an extra class called "selectedEgg"
        //The CSS for this class makes the egg glow
        //the for loop assures that only a single egg is assigned to the class at once
        var currentEggPrice;
        var selectEgg = function(e)
        {
            for (var i = 0; i < shop.eggs.length; i++)
            {
//
                shop.eggs[i].classList.remove("selectedEgg");
            }
            this.classList.add("selectedEgg");
            currentEggPrice= animalsDictionary[this.id].price;
            console.log(currentEggPrice);
            //document.getElementById("buyButtonLocation").style.visibility="visible"; //once you click, the buy button is visible
            shop["buyButton"].style.visibility="visible";
            return currentEggPrice;
        };

        //Purchase function: runs when buy button clicked
        //If currentEggPrice is less than user's gold amt, then price is deducted from user's amount

        function purchase(e)
        {
            if (currentEggPrice<=shop.gold)
            {
                shop.gold = shop.gold - currentEggPrice;
                window.alert("Thank you for your purchase!");
                shop.goldamt[0].innerHTML = "You have " + shop.gold + " gold";
                //animalsDictionary[document.getElementsByClassName("selectedEgg")].purchaseStatus = true;
                animalsDictionary[document.getElementsByClassName("selectedEgg")[0].id].purchaseStatus = true;
                console.log(animalsDictionary[document.getElementsByClassName("selectedEgg")[0].id].purchaseStatus);
                //this is supposed to redirect to a new page once "next" button was presssed
                shop["buyButton"].style.visibility="hidden";
                //shop["nextButton"].style.visibility="visible";
                document.getElementById("chosenegg").value = document.getElementsByClassName("selectedEgg")[0].id;
            }
            else
            {
                window.alert("You don't have enough gold");
            }
        }

//        function redirect()
//        {
//            window.location= "gamescreen.php";
//        }

        //document.getElementsByClassName("selectedEgg"")[0].id


    </script>
</head>

<body>



<!--<form id="form1">-->
<!--    <img src="./mouseEgg.png" title="mouseegg" id="mouseEggImage" />-->
<!--    <input type="checkbox" id="imgCheck" name="imgCheck" value="mouseegg" style="visibility: hidden;" />-->
<!--    <input type="submit" value="Submit" />-->
<!--</form>-->

<div class="panel">
    <h1 >Welcome to the shop!</h1>
    <span class="goldAmount">
        <img src="./sprite_coin_0.png" style="width:25px;height:25px;">
        You have <?php echo $_SESSION["gold"];?> gold
    </span>
    <!--hidden form that allows selected egg's id to be passed to "value"-->
        <form id="eggselectorform" action="gamescreenwithgold.php" method="get">
            <input type="hidden" name="chosenegg" id="chosenegg" value="defaultValue">
            <input type="image" id="submittor" src="nextButton.png" width="80" height="50" align="">
        </form>

        <span id="buyButtonLocation">BUY</span>
<!--        <span id="nextPageButton">NEXT</span>-->


    <p>Click on an egg to purchase it.</p>
    <div class="row">
        <img src="./mouseegg.png" class="eggs" id="mouseEgg">
        <img src="./snakeegg.png" class="eggs" id="snakeEgg">
        <img src="./roosteregg.png" class="eggs" id="roosterEgg">
        <img src="./pigegg.png" class="eggs" id="pigEgg">
    </div>

    <div class="row">
        <span class="sign">50</span>
        <span class="sign">100</span>
        <span class="sign">150</span>
        <span class="sign">200</span>
    </div>

    <div class="row">
        <img src="./rabbitEgg.png" class="eggs" id="rabbitEgg">
        <img src="./dogEgg.png" class="eggs" id="dogEgg">
        <img src="./unknownegg.png" class="eggs" id="sheepEgg">
        <img src="./horseEgg.png" class="eggs" id="horseEgg">
    </div>

    <div class="row">
        <span class="sign">400</span>
        <span class="sign">500</span>
        <span class="sign">600</span>
        <span class="sign">700</span>
    </div>



    <div class="row">
        <img src="./cowEgg.png" class="eggs" id="oxEgg">
        <img src="./unknownegg.png" class="eggs" id="monkeyEgg">
        <img src="./tigerEgg.png" class="eggs" id="tigerEgg">
        <img src="./dragonEgg.png" class="eggs" id="dragonEgg">

    </div>

    <div class="row">
        <span class="sign">800</span>
        <span class="sign">1000</span>
        <span class="sign">1500</span>
        <span class="sign">2000</span>
    </div>
</div>

<script>
    var shop=
        {
            //set the gold to the PHP saved GOLD variable (echoing it apparently doesn't force it to be literal)
            gold: <?php echo $_SESSION["gold"];?>,
            eggs: document.getElementsByClassName("eggs"),
            buyButton: document.getElementById("buyButtonLocation"),
            nextButton: document.getElementById("nextPageButton"),
            goldamt: document.getElementsByClassName("goldAmount"),
            selectedEgg: document.getElementsByClassName("selectedEgg"),
            isPurchased: false
        };
    var buyButton = document.getElementById("buyButtonLocation");
    //Create a dictionary with objects. Objects contain prices, purchase status etc
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


    //iterate through the array of the class "eggs" and allows each egg to become clickable
    for (var i = 0; i < shop.eggs.length; i++)
    {
        shop.eggs[i].addEventListener('click', selectEgg);
    }

    shop["buyButton"].addEventListener('click', purchase);

//    shop["nextButton"].addEventListener('click', redirect);
</script>



</body>
</html>