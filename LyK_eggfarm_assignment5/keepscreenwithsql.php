<?php session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>EggFarm</title>
    <link rel="stylesheet" type="text/css" href="gamescreenCSS.css">
<style>
    div.sign
    {
        background-image: url("./pricetag.png");
        padding: 25px;
        margin-bottom: 50px;
        position: absolute;
        top: 470px;
        width: 150px;
        font-family: "American Typewriter";
        font-size: 1.5em;
        margin-left: auto;
        margin-right: auto;
    }

    h3
    {
        font-family: "American Typewriter";
    }

    .animalLocation
    {
        position: absolute;
        top: 200px;
    }

</style>
    <script>
    </script>
</head>

<body>
<?php
$servername="localhost";
$username = "kly5";
$password="912703004";
$dbname= "kly5";
$theusername =$_SESSION["username"];

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error){
    die("Connection failure".$conn->connect_error);
}
//echo "Successfully connected to the db </br>";

//$sql = "SELECT sellprice FROM eggs WHERE eggtype = '$_SESSION[chosenegg]'";
//$result = $conn->query($sql);
//if($result->num_rows > 0)
//{
//    while($row = $result->fetch_assoc())
//    {
//       //echo $row["sellprice"];
//        $eggsellprice = $row["sellprice"];
//       // echo $eggsellprice;
//        $_SESSION["gold"] += $eggsellprice;
//    }
//}
//else
//{
//    echo "0 results";
//}
//$modifygold = "UPDATE userinfo SET gold = '$_SESSION[gold]' WHERE username = '$_SESSION[username]'";
//$result = $conn->query($modifygold);

$temp = $_SESSION["chosenegg"];
$animaltype= rtrim($temp,"Egg");
echo $animaltype;
$incrementNumOfAnimals =
    "UPDATE useranimals
SET $animaltype=$animaltype+1
WHERE userid=
   (SELECT userid FROM userinfo WHERE username= '$_SESSION[username]')";
$result = $conn->query($incrementNumOfAnimals);
if ($result -> num_rows >0)
{
    echo 'executed';
}
else{
    echo 'no result';
}

$animallifespan=
    "SELECT lifespan
    FROM animals
    WHERE animalid = 
    (SELECT animalid FROM eggs WHERE eggtype= 'mouseEgg')";
$theresult = $conn->query($animallifespan);
while ($row = mysqli_fetch_array($theresult)) {
    $currentanimallifespan= $row['lifespan'];
}
?>

<div class="panel">
    <h1 id="message">You have adopted <?php echo $animaltype?>!</h1>
    <h3>Gold per hour: <?php echo $eggsellprice?> </h3>
    <h3>Lifespan: <?php echo $currentanimallifespan?> hours</h3>
    <h3 id="goldM">Your Gold: <?php echo $_SESSION["gold"];?> </h3>
    <img src="./<?php echo $animaltype?>.png" class="animalLocation">
    <a href="navigationmenuwithSWL.php"><div class="sign">Main Menu</div> </a>
</div>
</body>

