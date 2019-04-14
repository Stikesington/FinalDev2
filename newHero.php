<?php
require "authenticate.php";
require "connect.php";

$valid= false;
$descriptionValid= false;

$query="INSERT INTO dota_hero (heroName, mainAtt,heroRole, heroDescription) values (:heroName, :mainAtt, :heroRole, heroDescription)";
$statement= $db-> prepare($query);



if(isset($_POST["heroName"]))
{
  $heroName= filter_input(INPUT_POST, 'heroName',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  if(strlen($heroName)>0 && strlen($heroName)<30)
  {

    $statement->bindValue(':heroName', $heroName);
    $valid=true;
  }
}

if(isset($_POST["mainAtt"]))
{
  $mainAtt= filter_input(INPUT_POST, 'mainAtt',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  if($mainAtt != "startAtt")
  {

    $statement->bindValue(':mainAtt', $mainAtt );
    $valid=true;
  }
}

if(isset($_POST["heroRole"]))
{
  $heroRole= filter_input(INPUT_POST, 'heroRole',FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
  if($heroRole != "startRole")
  {

    $statement->bindValue(':heroRole', $heroRole );
    $valid=true;
  }
}

if(isset($_POST["heroDescription"]))
{
  $heroDescription=filter_input(INPUT_POST,'heroDescription',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  if(strlen($heroDescription)>0 && strlen($heroDescription)<700)
  {
    $statement->bindValue(':heroDescription',$heroDescription);
    $insert_id= $db-> lastInsertId();

    $descriptionValid=true;
  }

}

if($valid && $descriptionValid)
{
  $statement->execute();
  $insert_id= $db-> lastInsertId();
  header("Location: http://localhost:31337/Final/index.php");
  exit;
}



?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Create New Hero</title>
    <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
    <div id="wrapper">
        <div id="header">
            <h1><a href="index.php">Hero Creator</a></h1>
        </div> <!-- END div id="header" -->
<ul id="menu">
    <li><a href="index.php" >Created Heros</a></li>
    <li><a href="newHero.php" class='active'>Create New Hero</a></li>
</ul> <!-- END div id="menu" -->
<div id="all_heros">
  <form method="post">
    <fieldset>
      <legend>Help us create a Better DOTA!</legend>
      <p>
        <label for="hero_name">Hero Name</label>
        <input name="heroName" id="heroName" />
      </p>
      <label for="mainAtt">Main Attribute:</label>
      <select name="mainAtt">
        <option value="startAtt">Choose main attribute</option>
        <option value="strength">Strength</option>
        <option value="agility">Agility</option>
        <option value="intelligience">Intelligience</option>
      </select>
      <label for="role">Role:</label>
      <select name="heroRole">
        <option value="startRole">Choose Role</option>
        <option value="carry">Carry</option>
        <option value="roamer">Roamer</option>
        <option value="support">Support</option>
        <option value="nuker">Nuker</option>
      </select>
      <p>
        <label for="heroDescription">Describe your Hero</label>
        <textarea name="heroDescription" id="heroDescription"></textarea>
      </p>
      <p>
        <input type="submit" name="command" value="Submit Hero" />
      </p>
    </fieldset>
  </form>
  
</div>
        <div id="footer">
            Dota Heros of Tomorrow
        </div> <!-- END div id="footer" -->
    </div> <!-- END div id="wrapper" -->
</body>
</html>
