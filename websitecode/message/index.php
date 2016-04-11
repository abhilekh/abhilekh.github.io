
<?php

ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);



if(!isset($_POST["message"]))
{
    // echo '
    // <!DOCTYPE HTML>
    // <html lang="en-US">
    // <head>
    //     <meta charset="UTF-8">
    //     <meta http-equiv="refresh" content="20;url=http://www.abhilekhwedsmegha.com?red=g1">
    // <!--    <script type="text/javascript">
    //         window.location.href = "http://www.abhilekhwedsmegha.com?red=g2"
    //     </script> -->
    //     <title>Page Redirection</title>
    // </head>
    // <body>
    //     <p>This page does not exist</p>
    //     <p>You got to wrong page. If you are not redirected automatically, follow the 
    //         <a href="http://www.abhilekhwedsmegha.com?red=g3">link to main site</a>
    //         </p>
    // </body>
    // </hlml>';
    print_r($_POST);
    exit();
}

echo '<!DOCTYPE HTML>
<html lang="en-US">';

$servername = "localhost";
$username = "root";
$password = "Apeksh@1";
$dbname = "wed";

$msg = $_POST["message"];
$myname = $msg['name'];
$mywishes = $msg['note'];

// Check file type
/*
$target_dir = "../../nginx/static/com.wed/upimg/";
$target_base = "http://www.abhilekhwedsmegha.com:8080/com.wed/upimg/";
$basenm = basename($_FILES["photo"]["name"]);
$temppath = $_FILES["photo"]["tmp_name"];
$target_file = $target_dir . $basenm;
$target_url = $target_base . $basenm;
$uploadOk = true;
$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

if (file_exists($temppath)){
    echo "File Path is ". $temppath;
    exec("ls -1 " . $temppath, $output);
    echo "<p>$output</p>";

    $check = getimagesize($temppath);
    if($check == false) {
        $uploadOk = false;
    }
} else {
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
    $target_file = $target_dir . randval . $basenm;
    $target_url = $target_base . randval . $basenm;
}


if($uploadOk == true && $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    $uploadOk = false;
}


if ($uploadOk == false || !move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    $target_url = "";
}
*/

$myphoto = "";

if( ! ini_get('date.timezone') ){
    date_default_timezone_set('Asia/Calcutta');
}

$idate = date("Y-m-d H:i:s");

echo $idate;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "INSERT INTO guestbook (idate, name, wishes, photo) VALUES ('$idate', '$myname', '$mywishes', '$myphoto')";

if ($conn->query($sql) === TRUE) {
    echo '  
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="refresh" content="1;url=https://www.facebook.com/abhilekhmegha?re=g1">
        <script type="text/javascript">
            window.location.href = "https://www.facebook.com/abhilekhmegha?re=g2"
        </script>
        <title>Page Redirection</title>
    </head>
    <body>
        <p>Data updated successfully</p>
        <p> Your entry is well received. We really appreciate your good wishes.</p>
        <p> If you are not redirected automatically, follow the 
            <a href="https://www.facebook.com/abhilekhmegha?re=g3">link to guestbook</a>
        </p>
    </body>';
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
</html>