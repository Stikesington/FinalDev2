<?php

include "authenticate.php";
include "connect.php";

$valid= false;
$descriptionValid= false;



//update statement
$updateQuery= "UPDATE dota_hero SET heroName = :heroName , heroDescription = :heroDescription, mainAtt=:mainAtt, heroRole=:heroRole WHERE heroID = :heroID";
$update = $db-> prepare($updateQuery);

 $deleteQuery="DELETE FROM dota_hero WHERE heroID = :heroID ";
 $delete= $db -> prepare($deleteQuery);

 if(isset($_POST["heroName"]))
 {
   $heroName= filter_input(INPUT_POST, 'heroName',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   if(strlen($heroName)>0 && strlen($heroName)<30)
   {
 
     $update->bindValue(':heroName', $heroName);
     $valid=true;
   }
 }
 
 if(isset($_POST["mainAtt"]))
 {
   $mainAtt= filter_input(INPUT_POST, 'mainAtt',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   if($mainAtt != "startAtt")
   {
     
 
     $update->bindValue(':mainAtt', $mainAtt );
     $valid=true;
   }
 }
 
 if(isset($_POST["heroRole"]))
 {
   $heroRole= filter_input(INPUT_POST, 'heroRole',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   if($heroRole != "startRole")
   {
 
     $update->bindValue(':heroRole', $heroRole );
     $valid=true;
   }
 }
 
 if(isset($_POST["heroDescription"]))
 {
   $heroDescription=filter_input(INPUT_POST,'heroDescription',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   echo strlen($heroDescription);
   if(strlen($heroDescription)>0 && strlen($heroDescription)<700)
   {
     $update->bindValue(':heroDescription',$heroDescription);
     $insert_id= $db-> lastInsertId();
 
     $descriptionValid=true;
   }
 
 }

 if(isset($_GET['heroID']))
 {
     if(filter_input(INPUT_GET,'heroID', FILTER_SANITIZE_NUMBER_INT))
     {
         $heroId= filter_input(INPUT_GET,'heroID', FILTER_SANITIZE_NUMBER_INT);
         $update->bindValue(':heroID',$heroId,PDO::PARAM_INT);
         $delete-> bindValue(':heroID',$heroId,PDO::PARAM_INT);
     }
 }
 else{
    header("Location: http://localhost:31337/Final/index.php");
     exit;
 }
 //if post is clicked
 if(isset($_POST['update']))
 {
   
   
     if($descriptionValid && $valid)
     {
         echo "hi";
         $update->execute();
         header("Location: http://localhost:31337/Final/index.php");
         exit;
     }
 }

 //if delete is clicked 
 if(isset($_POST['delete']))
 {
     $delete->execute();
     header("Location: http://localhost:31337/Final/index.php");
     exit;
 }
  
 $selectQuery= "SELECT* FROM dota_hero WHERE heroID=$heroId";
 $select= $db-> prepare($selectQuery);
 $select->execute();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Update Hero</title>
    <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
    <div id="wrapper">
        <div id="header">
            <h1><a href="index.php">Update Your Hero</a></h1>
        </div> <!-- END div id="header" -->
<ul id="menu">
    <li><a href="index.php" >Home</a></li>
    <li><a href="create.php" >New Hero</a></li>
</ul> <!-- END div id="menu" -->
<div id="all_blogs">
  <form method="post">
    <fieldset>
      <legend>Update Hero</legend>
      <?php while($row = $select->fetch()):?>
      <p>
      <label for= "heroName">Hero Name:</label>
      <input name="heroName" id="heroName" value="<?=$row['heroName']?>"/>
      </p>
      <label for="mainAtt">Main Attribute:</label>
      <select name="mainAtt">
        <option value="startAtt">Choose main attribute</option>
        <option value="strength">Strength</option>
        <option value="agility">Agility</option>
        <option value="intelligience">Intelligience</option>
      </select>
      <label for="heroRole">Role:</label>
      <select name="heroRole">
        <option value="startRole">Choose Role</option>
        <option value="carry">Carry</option>
        <option value="roamer">Roamer</option>
        <option value="support">Support</option>
        <option value="nuker">Nuker</option>
      </select>
      <label for= "heroDescription"> Hero Description</label>
      <textarea name="heroDescription" id="heroDescription"><?=$row['heroDescription']?></textarea>
      </p>
      <p>
        <input type="hidden" name="id"/>
        <input type="submit" name="update" value="update"/>
        <input type="submit" name="delete" value="delete" onclick="return confirm('Are you sure you wish to delete this hero?')" />
      </p>
      <?php endwhile?>
    </fieldset>
  </form>
</div>
        <div id="footer">
        Dota Heros of Tomorrow
        </div> <!-- END div id="footer" -->
    </div> <!-- END div id="wrapper" -->
</body>
</html>