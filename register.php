<?php

require "connect.php";

$valid = false;

$query= "INSERT INTO heroauthor (heroAuthor, password, admin) values (:heroAuthor, :password, :admin)";
$statement = $db-> prepare($query);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Create New Hero</title>
    <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
<h1>Welcome to DOTA2:Heros of Tomorrow</h1>
   
<div id="userTable">
  <form method="post">
  <p>Please Create an account to enter</p>
    <p>
        <label for="hero_author">Username</label>
        <input name="heroAuthor" id="heroAuthor" />
    </p>
    <p>
        <label for="password">Password</label>
        <input name="password" id="password"/>
    </p>

    
   
     <p>
        <input type="submit" name="command" value="Sign up" />
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
