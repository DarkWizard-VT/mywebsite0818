<!DOCTYPE html>
<html>
<body>

<h1>DELETE DATA FROM DATABASE</h1>

<?php

echo "Delete database!";
?>
<ul>
    <form name="DeleteData" action="DeleteData.php" method="POST" >
<li>toyID:</li><li><input type="text" name="toyid" /></li>
<li><button type="submit" value="Submit">Delete</button></li>
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

$sql = "DELETE FROM toystore WHERE toyid = '$_POST[toyid]'";
$stmt = $pdo->prepare($sql);

if(is_null ($_POST[toyid])== FALSE)  {    
    if($stmt->execute() == TRUE){
        echo "Record updated successfully.";
    } else {
        echo "Error updating record. ";
    }}
?>
</body>
</html>
