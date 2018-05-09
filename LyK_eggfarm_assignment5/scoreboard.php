<?php session_start()?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <style type="text/css">
        .panel
        {
            background: lightskyblue;
            height: 530px;
            width: 400px;
            font-family: "American Typewriter";
        }

        h1
        {
            font-family:"American Typewriter";
            text-align:center;
        }

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
            color: white;
        }
    </style>
</head>

<body>
<?php
$servername="localhost";
$username = "kly5";
$password="912703004";
$dbname= "kly5";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error){
    die("Connection failure".$conn->connect_error);
}

$query= mysqli_query($conn, "SELECT username, gold FROM userinfo ORDER BY gold LIMIT 10");
?>


<div class="panel">
    <h1>Top Players</h1>
   <p>
       <?php while ($row = mysqli_fetch_array($query))
{
    $username = $row['username'];
    $gold = $row['gold'];
    echo $username . " " . $gold . '<br />';
}
?>
</p>
    <a href="navigationmenuwithSWL.php"><div class="sign">Main Menu</div> </a>
</div>



</body>
</html>