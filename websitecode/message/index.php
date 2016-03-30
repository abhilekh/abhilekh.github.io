<?php
$servername = "localhost";
$username = "root";
$password = "Apeksh@1";
$dbname = "wed";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "INSERT INTO wishes (name, wishes, photo)
VALUES ('John', 'Doe', 'john@example.com')";

if ($conn->query($sql) === TRUE) {
    echo "<!DOCTYPE HTML>
<html lang="en-US">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="refresh" content="5;url=http://www.abhilekhwedsmegha.com/guestbook/index.php?re=1">
        <script type="text/javascript">
            window.location.href = "http://www.abhilekhwedsmegha.com/guestbook/index.php?re=1"
        </script>
        <title>Page Redirection</title>
    </head>
    <body>
        <!-- Note: don't tell people to `click` the link, just tell them that it is a link. -->
        <p>Data updated successfully</p>
        <p>If you are not redirected automatically, follow the <a href='http://www.abhilekhwedsmegha.com/guestbook/index.php?re=1'>link to guestbook</a></p>
    </body>
</html>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>