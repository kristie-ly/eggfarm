<?php session_start();
$filename = 'configFile.txt';
$user_file = "users.txt";
$_SESSION["username"] = $_REQUEST["username"];

//if the users.txt file exists, greet the user
if (file_exists($user_file))
{
    echo null;
}
//otherwise, create a users.txt file and write in the original info
else
{
    $file = fopen($user_file, 'w');
    fwrite($file, $_REQUEST["username"].":");
    fwrite($file, $_REQUEST["pass"] . ":");
    fwrite($file, 150 . ":");
    fwrite($file, 0 . ":");                     //mice
    fwrite($file, 0 . ":");                     //snakes
    fwrite($file, 0 . ":");                     //roosters
    fwrite($file, 0 . "\n");                           //pigs
    fclose($file);
}

//append any new user below that first user
//    $file = fopen($user_file, 'a');
//    fwrite($file, $_REQUEST["username"].":");
//    fwrite($file, $_REQUEST["pass"] . ":");
//    fwrite($file, 150 . ":");
//    fwrite($file, 0 . ":");                     //mice
//    fwrite($file, 0 . ":");                     //snakes
//    fwrite($file, 0 . ":");                     //roosters
//    fwrite($file, 0);                           //pigs
//    fclose($file);
?>

<!--if username exists, greet-->
<!--otherwise, tell them how much default gold they're given-->


<!--explode function to split the user file into lines-->
<?php
$filename = "users.txt";
$filehandle = fopen($filename, "r"); #filehandle is like a temporary file info reading divice
while(!FEOF($filehandle)) #FEOF is a special “End of file”, so while NOT end of file
{
    $line = fgets($filehandle); #grab the first line
    $filevalues = explode(":", $line);
    #split that first line at the colons and save that bunch of data into an array called $filevalues
//    echo $filevalues[0];
//    echo $filevalues[1];
//    echo $filevalues[2];
//    echo $filevalues[3];
//    echo $filevalues[4];
//    echo $filevalues[5];
//    echo $filevalues[6];
    if ($_SESSION["username"] === $filevalues[0])
    {
        echo "true";
    }
    else //apend any new users below that initial user in the text fiel
    {
        $file = fopen($user_file, 'a');
        fwrite($file, $_REQUEST["username"].":");
        fwrite($file, $_REQUEST["pass"] . ":");
        fwrite($file, 150 . ":");
        fwrite($file, 0 . ":");                     //mice
        fwrite($file, 0 . ":");                     //snakes
        fwrite($file, 0 . ":");                     //roosters
        fwrite($file, 0);                           //pigs
        fclose($file);
    }
}

$users = array(); #make an empty usernames array
//Repeat the steps above
array_push($users, $filevalues[0]); #grab the username after reading each line and push it to vals
//Make a new array for each bit of information
echo "users" . $users[0];

$passwords = array();
array_push($passwords, $filevalues[1]);
echo "password" . $passwords[0];


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


    <?php $gold = htmlspecialchars($_REQUEST['gold']);?>
<!--    <h3> You have --><?php //echo $_SESSION["gold"]; ?><!-- gold </h3>-->
    <h3> You have <?php echo $_REQUEST["gold"]; ?> gold </h3>
    <div class="sign">Egg Store</div> <br>
    <div class="sign">My Barn</div> <br>
    <div class="sign">Scoreboard</div>
</div>




<script>
    var xhttp = new XMLHttpRequest();


    xhttp.onreadystatechange= function(){
        if (this.readyState == 4 && this.status == 200)
        {
            gold = parseInt(this.responseText);
        }
    };

    xhttp.open("GET", "update.php?inquiry=gold", true)
    xhttp.send();
    h3.innerHTML = "Your Gold:" + gold;

</script>





</body>
</html>