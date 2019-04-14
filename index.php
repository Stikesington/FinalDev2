<?php

require "connect.php";
require "authenticate.php";
$whereClause ='';
$search='';

if(isset($_GET['search']))
{

    $search= $_GET['search'];
    $whereClause = "WHERE heroName LIKE '%$search%' OR mainAtt LIKE '%$search%' OR heroRole LIKE '%$search%'";
}

$query= "SELECT heroID, heroName, mainAtt, heroRole, heroDescription
         FROM dota_hero" . $whereClause .
         "ORDER BY heroID DESC";
         $statement= $db-> prepare($query);
         $statement->execute();
         $heros=$statement-> fetchAll();

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dota Hero</title>
    <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
    <div id="wrapper">
        <div id="header">
            <h1><a href="index.php">Community Created Heros</a></h1>
        </div> 
<ul id="menu">
    <li><a href="index.php" class='active'>Created Heros</a></li>
    <li><a href="newHero.php" >Create New Hero</a></li>
    ​ <form action="index.php" method="GET">
      <input type="text" placeholder="Search..." name="search">
      <button type="submit">Submit</button>
    </form>
</ul> 
<div id="all_Heros">
<?php foreach ($heros as $post):?>
<div class = "heros_post">
    <h1>Hero Name:<?=$post['heroName']?></h1>
    <p>Hero role:<?=$post['heroRole']?></p>
    <p>Main Attribute: <?=$post['mainAtt']?></p>
    <div class='hero_description'>
    <?php if(strlen($post['heroDescription'])>150){?>
    <?=substr($post['heroDescription'],0,150)?>
    <a href= "hero_details.php?heroID=<?=$post['heroID']?>">Full Overview</a>
    <?php } else { ?>
        <?= $post['heroDescription']?>
    <?php }?>
    </div>
    <?php endforeach?>
  
    <div id="footer">
        Dota Heros of Tomorrow
        </div> <!-- END div id="footer" -->
    </div> <!-- END div id="wrapper" -->
</body>
</html>