<?php 
  if(isset($_POST['submit_btn'])) 
   {
      $country = $_POST["country"];
      $food = $_POST["food"];
      echo "Your country is:".$country;
      echo "Your favourite food is:".$food ;
      
   }

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
</head>
<body>
   <form action='PRACTICE.PHP' method="post">
      <label for='country'>Select Country of Birth:</label><br>
      <select name='country' required>
         <option value='Afghanistan'>Afghanistan</option>
         <option value='Iran'>Iran</option>
         <option value='Pakistan'>Pakistan</option>
      </select>
      <br>
        <label for='food'>Select Favourite food:</label><br>
      <select name='food' required>
         <option value='Meatball'>Meatball</option>
         <option value='Rice'>Rice</option>
         <option value='Soup'>Soup</option>
      </select>
      <br>
      <input type="submit" v3alue="Send" name='submit_btn'>
   </form>
</body>
</html>