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
$roll=$_POST['roll'];
$name=$_POST['name'];
$room=$_POST['room'];
$mobile=$_POST['mobile'];
if (!$name || !$roll || !$room || !$mobile) {
echo "You have not entered all the required details.";
exit;
}
if (!get_magic_quotes_gpc()) {
$roll = addslashes($roll);
$name = addslashes($name);
$room= addslashes($room);
$mobile = addslashes($mobile);
}
$uid="";
$uid.=$room;
$name2 = strtolower($name);
$uid.=substr($name2, 0, 2);
$id2 = $uid;
@ $db = new mysqli('localhost', 'root', '', 'ietlibdb');
if (mysqli_connect_errno()) {
echo "Error: Could not connect to database. Please try again later.";
exit;
}
$query = "insert into student values
('".$id2."', '".$roll."', '".$name."', '".$room."', '".$mobile."')";
$result = $db->query($query);
if ($result) {
echo "Your Registration was successful!!";
} else {
echo "An error has occurred. Registration Failed.";
}
$db->close();
?>
</body>
</html>