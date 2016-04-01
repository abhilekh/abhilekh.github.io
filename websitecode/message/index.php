<!DOCTYPE HTML>
<html lang="en-US">
<?php

ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);

$servername = "localhost";
$username = "root";
$password = "Apeksh@1";
$dbname = "wed";

if(!isset($_POST['name']))
{
    echo '
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="refresh" content="1;url=http://www.abhilekhwedsmegha.com">
        <script type="text/javascript">
            window.location.href = "http://www.abhilekhwedsmegha.com"
        </script>
        <title>Page Redirection</title>
    </head>
    <body>
        <p>Data updated successfully</p>
        <p>You got to wrong page. If you are not redirected automatically, follow the 
            <a href="http://www.abhilekhwedsmegha.com">link to main site</a></p>
    </body>';
    exit();
}

$myname = $_POST['name'];
$mywishes = $_POST["wishes"];


// Check file type

$target_dir = "../../nginx/static/com.wed/upimg/";
$target_base = "http://www.abhilekhwedsmegha.com:8080/com.wed/upimg/"
$base = basename($_FILES["photo"]["name"]);
$target_file = $target_dir . $base;
$target_url = $target_base . $base;
$uploadOk = true;
$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);


$check = getimagesize($_FILES["photo"]["tmp_name"]);
if($check == false) {
    $uploadOk = false;
}

// Check file size
if ($_FILES["photo"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Check if file already exists
while ($uploadOk == true && file_exists($target_file)) {
    $randval = rand(100);
    $target_file = $target_dir . randval . $base;
    $target_url = $target_base . randval . $base;
}


if($uploadOk == true && $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    $uploadOk = false;
}


if ($uploadOk == false || !move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    $target_url = "";
}

$myphoto = $target_url;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "INSERT INTO wishes (name, wishes, photo) VALUES ('$myname', '$mywishes', '$myphoto')";

if ($conn->query($sql) === TRUE) {
    echo '  
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="refresh" content="1;url=http://www.abhilekhwedsmegha.com/guestbook/index.php?re=1">
        <script type="text/javascript">
            window.location.href = "http://www.abhilekhwedsmegha.com/guestbook/index.php?re=1"
        </script>
        <title>Page Redirection</title>
    </head>
    <body>
        <p>Data updated successfully</p>
        <p> Your entry is well received. We really appreciate your good wishes.</p>
        <p> If you are not redirected automatically, follow the 
            <a href="http://www.abhilekhwedsmegha.com/guestbook/index.php?re=1">link to guestbook</a>
        </p>
    </body>';
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
</html>