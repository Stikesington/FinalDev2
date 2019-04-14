<?php
require "connect.php";

$heroId= $_GET['heroID'];

$selectQuery= "SELECT* FROM dota_hero WHERE heroID=$heroId";
 $select= $db-> prepare($selectQuery);
 $select->execute();




?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dota Heros</title>
    <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
    <div id="wrapper">
        <div id="header">
            <h1><a href="index.php">Hero Details</a></h1>
        </div> 
<ul id="menu">
    <li><a href="index.php" class='active'>Created Heros</a></li>
    <li><a href="newHero.php" >create New Hero</a></li>
</ul> 
<div id="all_blogs">
<?php while($row = $select->fetch()):?>
<div class = "hero_details">
    <h2> <?=$row['heroName']?></h2>
    <p>
        <small>
            <a href="update.php?heroID=<?=$row['heroID']?>">edit</a>
        </small>
    </p>
    <p><?=$row['mainAtt']?></p>
    <br>
    <p><?=$row['heroRole']?></p>
    <br>
    <p><?=$row['heroDescription']?></p>
    <?php endwhile?>
    


  </div>
        <div id="footer">
          Dota Heros of Tomorrow
        </div> <!-- END div id="footer" -->
    </div> <!-- END div id="wrapper" -->
</body>
</html>