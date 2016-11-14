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
$id=$_POST['id'];
$bookname=trim($_POST['bookname']);
$author=trim($_POST['author']);
if (!$id || !$bookname || !$author) {
echo "You have not entered all the required details.";
exit;
}
if (!get_magic_quotes_gpc()) {
$id = addslashes($id);
$bookname = addslashes($bookname);
$author = addslashes($author);
}
@ $db = new mysqli('localhost', 'root', '', 'ietlibdb');
if (mysqli_connect_errno()) {
echo "Error: Could not connect to database. Please try again later.";
exit;
}
$query = "select * from books where bookname like '%".$bookname."%' and author like '%".$author."%'";
$query1 = "select * from student where id like '%".$id."%'";
$result = $db->query($query);
if (!$result) {
echo "An error has occurred. The item was not added.";
}
$result1 = $db->query($query1);
if (!$result1) {
echo "An error has occurred. The item was not added.";
}
$row = $result->fetch_assoc();
$bookname1=$row['bookname'];
$author=$row['author'];
$number=$row['number'];
$maxbook=$row['maxbook'];
if (!$bookname1 || !$author || !$maxbook) {
echo "You have not entered all the required details.";
exit;
}
if (!get_magic_quotes_gpc()) {
$bookname1 = addslashes($bookname1);
$author = addslashes($author);
$number = addslashes($number);
$maxbook = addslashes($maxbook);
}
$row1 = $result1->fetch_assoc();
$name=$row1['name'];
$id1=$row1['id'];
$room=$row1['room'];
$mobile=$row1['mobile'];
if (!$name || !$id || !$room || !$mobile) {
echo "You have not entered all the required details.";
exit;
}
if (!get_magic_quotes_gpc()) {
$name = addslashes($name);
$id1 = addslashes($id1);
$room = addslashes($room);
$mobile = addslashes($mobile);
}
$num=1;
$date=date('jS F Y');
if($maxbook>=$number && $number!=0)
{
$query4 = "select * from issue";
$query3 = "insert into issue(bookname, author, name, id, mobile, room, number, issue_date) values
('".$bookname1."', '".$author."', '".$name."', '".$id."', '".$mobile."', '".$room."', '".$num."', '".$date."')";
$result3 = $db->query($query3);
if ($result3) {
echo "The book is issued Successfully."."</br>";
echo "<p>Book issued at ".date('H:i, jS F Y')."</p>";
$query5="update books set number=".($number-1)." where bookname='".$bookname1."' and author='".$author."'";
$result4 = $db->query($query5);
} else {
echo "An error has occurred. The item failed to issue.";
}
}
else
{
	echo "This Book is not currently available.";
}
$db->close();
?>
</body
></html>