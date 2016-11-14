<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>IET-LMS Search Results</title>
</head>
<body>
<?php
// create short variable names
$bookname=$_POST['bookname'];
$author=$_POST['author'];
$number=$_POST['number'];
if (!$bookname || !$author || !$number) {
echo "You have not entered all the required details.";
exit;
}
if (!get_magic_quotes_gpc()) {
$bookname = addslashes($bookname);
$author = addslashes($author);
$number = addslashes($number);
}
$maxbook=$number;
@ $db = new mysqli('localhost', 'root', '', 'ietlibdb');
if (mysqli_connect_errno()) {
echo "Error: Could not connect to database. Please try again later.";
exit;
}
$query = "insert into books values
('".$bookname."', '".$author."', '".$number."', '".$maxbook."')";
$result = $db->query($query);
if ($result) {
echo "$number.' book inserted into database.";
} else {
echo "An error has occurred. The item was not added.";
}
$db->close();
?>
</body>
</html>