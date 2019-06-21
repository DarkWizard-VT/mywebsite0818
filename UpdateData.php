<!DOCTYPE html>
<html>
<body>

<h1>Update DATA TO DATABASE</h1>

<?php

echo "Update database!";
?>
<ul>
    <form name="UpdateData" action="UpdateData.php" method="POST" >
<li>toyID:</li><li><input type="text" name="toyid" /></li>
<li>Toy Name:</li><li><input type="text" name="toyname" /></li>

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
$sql = "UPDATE toystore SET  toyname = '$_POST[toyname]' WHERE toyid = '$_POST[toyid]'";
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
