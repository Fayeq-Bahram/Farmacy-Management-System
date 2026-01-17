<?php
   $server = "localhost";
   $user = "root";
   $password = "";
   $db_name = "farmacy_db";


   $connection = mysqli_connect(
      $server,
      $user,
      $password,
      $db_name
   );

   try{
      $connection = mysqli_connect(
      $server,
      $user,
      $password,
      $db_name
   );
    //  echo "<h2>Connection exists! </h2>";
   }
      catch(mysqli_sql_exception){
      echo "<h3>Connection problem!!!";
      die();
   }