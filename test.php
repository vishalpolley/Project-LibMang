<!doctype html>
<html>
<head>
<title>IET-LMS Book Entry Results</title>
</head>
<body>
<h1>IET-LMS Book Entry Results</h1>
<?php
// create short variable names
$bookname=$_POST['bookname'];
$author=$_POST['author'];
$isbn=$_POST['isbn'];
$number=$_POST['number'];
if (!$bookname || !$author || !$isbn || !$number) {
echo "You have not entered all the required details.<br />"
."Please go back and try again.";
exit;
}
if (!get_magic_quotes_gpc()) {
$bookname = addslashes($bookname);
$author = addslashes($author);
$isbn = addslashes($isbn);
$number = addslashes($number);
}
@ $db = new mysqli('localhost', 'root', '', 'ietlibdb');
if (mysqli_connect_errno()) {
echo "Error: Could not connect to database. Please try again later.";
exit;
}
$query = "insert into books values
('".$bookname."', '".$author."', '".$isbn."', '".$number."')";
$result = $db->query($query);
if ($result) {
echo $db->affected_rows." book inserted into database.";
} else {
echo "An error has occurred. The item was not added.";
}
$db->close();
?>
</body>
</html>