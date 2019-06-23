<!DOCTYPE html>
<html>
    <head>
<title>Insert data to PostgreSQL with php - creating a simple web application</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
li {
list-style: none;
}
</style>
</head>
<body>
<h1>INSERT DATA TO DATABASE</h1>
<h2>Enter data into ToyStore table</h2>
<ul>
    <form name="InsertData" action="InsertData.php" method="POST" >
<li>toyid:</li><li><input type="text" name="toyid" /></li>
<li>toyname:</li><li><input type="text" name="toyname" /></li>

<li><input type="submit" /></li>
</form>
</ul>

<?php

if (empty(getenv("DATABASE_URL"))){
    echo '<p>The DB does not exist</p>';
    $pdo = new PDO('pgsql:host=localhost;port=5432;dbname=mydb', 'postgres', '123456');
}  else {
     
   $db = parse_url(getenv("DATABASE_URL"));
   $pdo = new PDO("pgsql:" . sprintf(
        "host=ec2-54-225-72-238.compute-1.amazonaws.com;port=5432;user=ceunivuhcevgju;password=4d325c3e99cf1899edf91c3f49af2bfad5864cbca9124356320bfa86cb111d63;dbname=d475nitcbnrrif",
        $db["host"],
        $db["port"],
        $db["user"],
        $db["pass"],
        ltrim($db["path"], "/")
   ));
}  

if($pdo === false){
     echo "ERROR: Could not connect Database";
}


$sql = "INSERT INTO Toystore(toyid, toyname)"
        . " VALUES('$_POST[toyid]','$_POST[toyname]')";
$stmt = $pdo->prepare($sql);
//$stmt->execute();
 if (is_null($_POST[toyid])) {
   echo "ToyId must be not null";
 }
 else
 {
    if($stmt->execute() == TRUE){
        echo "Record inserted successfully.";
    } else {
        echo "Error inserting record: ";
    }
 }
?>
</body>
</html>
