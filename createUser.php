<?php session_start();

//defined user_file variable as whatever the user entered.txt
//turned the POST["username" into a session variable to be used across PHP pages
$filename = 'configFile.txt';
$user_file = $_POST["username"].".txt";
$_SESSION["username"] = $_POST["username"];

//if the file exists, greet the user
if (file_exists($user_file))
{
    echo "Welcome back, " . $_SESSION["username"];
}
//otherwise, create a new file for the user and thank them for registering
else
{
    $file = fopen($user_file, 'w');
    fwrite($file, $_POST["pass"]."\n");
    fwrite($file, $_SESSION["gold"]."\n");
    fclose($file);
}
?>

<!DOCTYPE html>
<html lang="en">
<style type="text/css">
    .panel
    {
        background: lightskyblue;
        height: 530px;
        width: 400px;
        font-family: "American Typewriter";
        text-align: center;
    }

    #nextPageButton
    {
        font-size: 20px;
        font-family: "American Typewriter";
        position: absolute;
        top: 70px;
        left: 250px;
        color: white;
        background-image: url("./pricetag.png");
        padding: 15px;
        margin-bottom: 15px;
    }

</style>
<head>

    <script>
        function nextPage()
        {
            window.location= "navigationmenu.php";
        }
    </script>
</head>
<body>

<div class="panel">
    <h2> Hi, <?php echo $_POST["username"]; ?></h2>
    <span id="nextPageButton">Next</span>
</div>


<script>
    document.getElementById("nextPageButton").addEventListener('click', nextPage)
</script>
</body>