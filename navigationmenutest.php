<?php session_start();
$filename = 'configFile.txt';
$user_file = "users.txt";
$_SESSION["username"] = $_REQUEST["username"];
$users = array();
$passwords = array();
$goldamt= array(); #make empty usernames, passwords, and gold arrays

//if the users.txt file exists, do nothing
if (file_exists($user_file))
{
    echo null;
}
//otherwise, create a users.txt
else
{
    $file = fopen($user_file, 'w');
    fwrite($file, $_REQUEST["username"].":");
    fwrite($file, $_REQUEST["pass"] . ":");
    fwrite($file, 150 . ":");
    fwrite($file, 0 . ":");                     //mice
    fwrite($file, 0 . ":");                     //snakes
    fwrite($file, 0 . ":");                     //roosters
    fwrite($file, 0 . "\r\n");
}


//explode function to split the user file into discrete chunks
$filename = "users.txt";
$filehandle = fopen($filename, "r"); #filehandle is like a temporary file info reading divice

//a while loop that goes thru the file
//makes username and password arrays
while(!FEOF($filehandle)) #FEOF is a special “End of file”, so while NOT end of file
{
    $line = fgets($filehandle); #grab the first line
    $filevalues = explode(":", $line);
    #split that first line at the colons and save that bunch of data into an array called $filevalues
    array_push($users, $filevalues[0]); #grab the username after reading each line and push it to $users
    array_push($passwords, $filevalues[1]); #grab the password after reading each line and push to $passwords
    array_push($goldamt, $filevalues[2]); #grab the gold amount after reading each line and push to $gold
}

//foreach loop goes through username array
//if the username already exists in the text file, set "found" flag to TRUE
//if the username does not exist, "found" flag remains false; add a new line to the text file
$found = false;

//foreach ($users as $username)
//{
//    if ($_SESSION["username"] === $username)
//    {
//        echo "welcome back";
//        echo $users;
//        $found = true;
//        break;
//    }
//}
$arraylength=count($users);
for ($x=0; $x<$arraylength; $x++)
{
    if ($_SESSION["username"] === $users[$x])
    {
        echo "welcome back";
        $_SESSION["gold"]= $goldamt[$x];
        echo "you have " . $_SESSION["gold"] . " gold";
        $found = true;
        break;
    }
}
if ($found===false)
{
    $file = fopen($user_file, 'a');
    fwrite($file, $_REQUEST["username"] . ":");
    fwrite($file, $_REQUEST["pass"] . ":");
    fwrite($file, 150 . ":");
    fwrite($file, 0 . ":");                     //mice
    fwrite($file, 0 . ":");                     //snakes
    fwrite($file, 0 . ":");                     //roosters
    fwrite($file, 0 . "\r\n");                  //pigs
    fclose($file);
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
            margin-bottom: 50px;
            position: relative;
            width: 150px;
            font-family: "Chalkboard";
            font-size: 1.5em;
        }
    </style>
</head>

<body>

<div class="panel">
    <h1>Welcome to EggFarm, <?php echo $_SESSION["username"]; ?>!</h1>
    <h3> You have <?php echo $_SESSION["gold"]; ?> gold </h3>
    <a href="eggstore.php"> <div class="sign">Egg Store</div> </a> <br>
    <div class="sign">My Barn</div> <br>
    <div class="sign">Scoreboard</div>
</div>

<?php
//$con = mysqli_connect(“localhost”, “root”, ””);
//$db = mysqli_select_db("eggfarm");
//if($con)
//{
//    Echo "successful connection";
//}
//if($db)
//{
//    Echo "successfully found the db";
//}
//?>

<?php
$servername="localhost";
$username = "kristie";
$password="bunny";
$dbname= "eggfarm";
//$db = mysqli_select_db("eggfarm");

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error){
    die("Connection failure".$conn->connect_error);
}
echo "Successfully connected to the db";


$query= mysqli_query($conn, "SELECT * FROM userinfo");
while ($row = mysqli_fetch_array($query))
{
    $id = $row['userid'];
    $username = $row['username'];
    $gold = $row['gold'];
    echo $id . $username . $gold;
}
?>

<!--//if ($conn->query($sql) === TRUE)-->
<!--//{-->
<!--//    echo "printed succesfully";-->
<!--//}-->
<!--//else-->
<!--//{-->
<!--//    echo "error";-->
<!--//}-->
<!--//-->


</body>
</html>