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
$searchtype=$_POST['searchtype'];
$searchterm=trim($_POST['searchterm']);
if (!$searchterm) {
echo "You have not entered search details. Please go back and try again.";
exit;
}
if (!get_magic_quotes_gpc()){
$searchtype = addslashes($searchtype);
$searchterm = addslashes($searchterm);
}
@ $db = new mysqli('localhost', 'root', '', 'ietlibdb');
if (mysqli_connect_errno()) {
echo "Error: Could not connect to database. Please try again later.";	
exit;
}
$query = "select * from books where ".$searchtype." like '%".$searchterm."%'";
$result = $db->query($query);
$num_results = $result->num_rows;
echo "<p>Number of books found: ".$num_results."</p>";
for ($i=0; $i <$num_results; $i++) {
$row = $result->fetch_assoc();
echo "<p><strong>".($i+1).". Book Name: ";
echo htmlspecialchars(stripslashes($row['bookname']));
echo "</strong><br />Author: ";
echo stripslashes($row['author']);
echo "<br />Available Books: ";
echo stripslashes($row['number']);
echo "</p>";
}
$result->free();
$db->close();
?>
</body>
</html>