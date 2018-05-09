<?php<?php session_start();
$filename = 'configFile.txt';
$user_file = "users.txt";

//control logic: allows the session to be kept regardless if you are coming from the form or not
if(isset($_REQUEST["username"]) && isset($_REQUEST["pass"]))
{
    $_SESSION["username"] = $_REQUEST["username"];
}
else
{
    $theusername = $_SESSION["username"];
}
?>

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
            margin-bottom: 30px;
            margin-left: auto;
            margin-right: auto;
            position: relative;
            width: 150px;
            font-family: "Chalkboard";
            font-size: 1.5em;
            align-items:center;
        }
    </style>
    <script>
        function layGold()
        {
            <?php
            $laygold= "UPDATE userinfo
        SET gold = gold + $goldperhour*COUNT($animaltype)
        WHERE userid =
        (SELECT userid FROM userinfo WHERE username= $_SESSION[username])
        AND animalid= (SELECT animalid FROM animals WHERE animaltype = $animaltype)";?>
        }
    </script>
</head>

<body>
<!--connect to the database-->
<?php
$servername="localhost";
$username = "kly5";
$password="912703004";
$dbname= "kly5";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error){
    die("Connection failure".$conn->connect_error);
}

//if user has less than 50 gold, give them 100 sympathy gold
$query= mysqli_query($conn, "SELECT * FROM userinfo");
while ($row = mysqli_fetch_array($query))
{
    $id = $row['userid'];
    $username = $row['username'];
    $gold = $row['gold'];
    if ($gold<=50)
    {
        $sympathygold = "UPDATE userinfo SET gold = 100 WHERE username = '$_SESSION[username]'";
        $sympathygoldresult = $conn->query($sympathygold);
    }
}

//makes a new table row for the user
$addrecord= "INSERT INTO userinfo(username, password) VALUES ('$_SESSION[username]', '$_REQUEST[pass]')";
$result = $conn->query($addrecord);
//makes a new table row for the user's animals
$addanimalrecord ="INSERT INTO useranimals(mouse) VALUES (0)";
$theresult = $conn ->query($addanimalrecord);

//set the session gold to the gold value thats in the database
$sql = "SELECT userid, username, gold FROM userinfo WHERE username= '$_SESSION[username]'";
$result = $conn->query($sql);
if($result->num_rows > 0)
{
    while($row = $result->fetch_assoc())
    {
        $_SESSION["gold"] = $row["gold"];
    }
}
?>



<div class="panel">
    <h1>Welcome to EggFarm,
        <?php if(isset($_REQUEST["username"]) && isset($_REQUEST["pass"]))
        {
            echo $_SESSION["username"];
        }
        else
        {
            echo $theusername;
        }
        ?>!</h1>

    <h3 id="goldamount"> You have <?php echo $_SESSION["gold"]; ?> gold </h3>
    <h4>It costs 10 gold to go to the egg store and play!</h4>
    <a href="eggstorewithsql.php"> <div class="sign">Egg Store</div> </a> <br>
    <div class="sign">My Barn</div> <br>
    <a href="scoreboard.php"><div class="sign">Scoreboard</div> </a>
</div>


</body>
</html>

<!--setInterval(layGold, 3600000)-->
<!--$query= mysqli_query($conn, "SELECT * FROM userinfo");-->
<!--while ($row = mysqli_fetch_array($query))-->
<!--{-->
<!--$id = $row['userid'];-->
<!--$username = $row['username'];-->
<!--$gold = $row['gold'];-->
<!--if ($gold<=50)-->
<!--{-->
<!--$sympathygold = "UPDATE userinfo SET gold = 100 WHERE username = '$_SESSION[username]'";-->
<!--$sympathygoldresult = $conn->query($sympathygold);-->
<!--$sympathygoldmessage="We see that you're low on gold; here's 100 to help you out";-->
<!--echo $sympathygoldmessage;-->
<!--}-->
<!---->
<!---->
<!---->
<!--function dieOff()-->
<!--{-->
<!--#if the time has been reached of the lifepsan, remove that row-->
<!--}-->
