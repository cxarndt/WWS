
<?php
 #$page = $_SERVER['PHP_SELF'];
 #$sec = "3";
 #header("Refresh: $sec; url=$page");
 ?>

<html>

<head>

</head>

<body>

<h1>WWS</h1>

<form action='tarek.php' method="post">
	<select name="way">
    <option value="out">Entnahme</option>
    <option value="in">Rückgabe</option>
    <option value="new">Anlegen</option>
    <option value="delete">Löschen</option>
	</select>
	<input type='text' name="barcode" value="barcode scannen"></input>
	
	
</form>





<?php

var_dump($_POST);
echo "<br />";




#####################################################
#													#
#		mySQL Verbindung herstellen					#
#													#
#####################################################
$servername = "127.0.0.1:3306";
$username = "root";
$password = "";
$dbname = "inventarWWS";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 



#####################################################
#													#
#		Hardware per Scan eintragen, austragen, etc.#
#													#
#####################################################


if ($_POST['way']=='new'){
	$barcode = $_POST['barcode'];
	$sql = "INSERT INTO inventar (EAN) VALUES (".$barcode.");";
} elseif ($_POST['way']=='delete'){
	$barcode = $_POST['barcode'];
	$sql = "DELETE FROM inventar WHERE (EAN) = (".$barcode.");";
	if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
} else { echo "no tarek today";}

}else{
	echo"<br /> tarek <br />";
}











#####################################################
#													#
#		ganze Tabelle anzeigen						#
#													#
#####################################################




$sql = "SELECT * FROM inventar";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "EAN: " . $row["EAN"]. " - EAN_Warengruppe: " . $row["EAN_WG"]. " " . $row["NAME"]. "<br>";
    }
} else {
    echo "0 results";
}

?>


</body>

</html>