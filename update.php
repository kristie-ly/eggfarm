<?php
//session_start();
//ini_set('display_errors', 1);
//error_reporting(~0);
//$gold = htmlspecialchars($_SESSION['gold']);
////$animal_name = htmlspecialchars($_REQUEST['animal']);
////$check = htmlspecialchars($_REQUEST['inquiry']);
//$filename = "users.txt";
//$myfile = fopen($filename, "r+") or die ("Cannot open file.");
//$data = array();
//while (!FEOF($myfile))
//{
//    $line = fgets($myfile); //file handel
//    $temp_array=explode(":", $line);
//
//    if(count($temp_array) == 1)
//        continue;
//    $data[$temp_array[0]] = $temp_array[1];
//    echo $temp_array[0] . ".." . $temp_array[1];
//    echo $_SESSION['gold'];
//}?>

<?php
session_start();
$users= array();
$passwords=array();
$goldamt=array();
$reformedArray=array();
$numMice = array();
$numSnakes = array();
$numRoosters = array();
$numPigs = array();

$newValue = $_SESSION["gold"];
$username = $_SESSION["username"];

$filename = "users.txt";
$filehandle =fopen($filename, "r");

//loop through entire file and pull out the lines
while(!FEOF($filehandle)) #FEOF is a special “End of file”, so while NOT end of file
{
    $line = fgets($filehandle); #grab the first line
    $filevalues = explode(":", $line);
    #split that first line at the colons and save that bunch of data into an array called $filevalues
    array_push($users, $filevalues[0]); #grab the username after reading each line and push it to $users
    array_push($passwords, $filevalues[1]); #grab the password after reading each line and push to $passwords
    array_push($goldamt, $filevalues[2]); #grab the gold amount after reading each line and push to $gold
    array_push($numMice, $filevalues[3]);
    array_push($numSnakes, $filevalues[4]);
    array_push($numRoosters, $filevalues[5]);
    array_push($numPigs, $filevalues[6]);
}
fclose($filehandle);

$chosenegg = $_REQUEST["chosenegg"];
if ($chosenegg === "mouseEgg")
{
    $newValue = $newValue - 50;
}


//$temp_array=explode(":", $line);
$arraylength=count($users);
for ($x=0; $x<$arraylength; $x++)
{
    if ($_SESSION["username"] === $users[$x])
    {
        $gold = $goldamt[$x]; //gold variable set to gold amount in the gold array
        $gold = $gold + $newValue; //add newValue (current gold) to have the running total $gold
        $goldamt[$x] = $gold; //set the array element to the running total
        $_SESSION["gold"]=$gold; //set the session variable to the running tota;
        array_push($reformedArray, $users[$x]);
        array_push($reformedArray, $passwords[$x]);
        array_push($reformedArray, $goldamt[$x]);
        array_push($reformedArray, $numMice[$x]);
        array_push($reformedArray, $numSnakes[$x]);
        array_push($reformedArray, $numRoosters[$x]);
        array_push($reformedArray, $numPigs[$x]);
        echo "you have " . $_SESSION["gold"] . " gold";
        break;
    }
}


//$gold = $temp_array[2];
//$gold += $newValue;
//$temp_array[2] = $gold;
$line= implode(":", $reformedArray);
//$line= implode(":", $temp_array);

$filehandle=fopen("users.txt", "w+");

fwrite($filehandle, $line);
fclose($filehandle);

?>


