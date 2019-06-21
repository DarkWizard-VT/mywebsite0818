<!DOCTYPE html>
<html>
<body>

<h1>UPDATE DATA TO DATABASE</h1>

<?php

echo "Update database!";
?>
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
        "host=ec2-174-129-240-67.compute-1.amazonaws.com;port=5432;user=wrflrxtavasvqh;password=fbfef36049fbd28f1200e3a775a389e014838e86522765e67782f9cf7a3f516b;dbname=d3mmhribgmc6bf",
        $db["host"],
        $db["port"],
        $db["user"],
        $db["pass"],
        ltrim($db["path"], "/")
   ));
}  


$sql = "UPDATE toystore SET toyname = $_POST[toyname] WHERE toyid = $_POST[toyid]";
      $stmt = $pdo->prepare($sql);
if($stmt->execute() == TRUE){
    echo "Record updated successfully.";
} else {
    echo "Error updating record. ";
}
    
?>
</body>
</html>
