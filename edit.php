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
$searchtype=$_POST['searchtype'];
$edit=$_POST['edit'];
if (!$bookname || !$author || !$edit) {
echo "You have not entered all the required details.";
exit;
}
if (!get_magic_quotes_gpc()) {
$bookname = addslashes($bookname);
$author = addslashes($author);
$edit = addslashes($edit);
}
@ $db = new mysqli('localhost', 'root', '', 'ietlibdb');
if (mysqli_connect_errno()) {
echo "Error: Could not connect to database. Please try again later.";
exit;
}
$query = "select * from books where bookname like '%".$bookname."%' and author like '%".$author."%'";
$result = $db->query($query);
$row = $result->fetch_assoc();
if( $searchtype == "maxbook" && $row['number'] < "maxbook" )
{
	$no = $row['number']+$edit;
	$query2 = "update books set number = '".$no."' where bookname = '".$bookname."' and author = '".$author."'";
	$result3 = $db->query($query2);
}
$no1 = $row['maxbook']+$edit;
$query1 = "update books set ".$searchtype." = '".$no1."' where bookname = '".$bookname."' and author = '".$author."'";
$result2 = $db->query($query1);
if ($result2) {
echo "Changes were Done.";
} else {
echo "An error has occurred.";
}
$db->close();
?>
</body>
</html>