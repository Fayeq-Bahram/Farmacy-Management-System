<?php
   include("header.php");
   include("connection.php");
   include("delete_row.php");

   if(isset($_POST['create-btn']))
   {
      $input_name = $_POST['input_name'];
      $input_password = $_POST['input_password'];

      $sql = "INSERT INTO STAFF(NAME, PASSWORD) VALUE('$input_name', '$input_password')";
      $result = mysqli_query($connection, $sql);

   }

  

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" type="text/css" href="../css/body.css">
   <link rel="stylesheet" type="text/css" href="../css/create_style.css">
   <link rel="stylesheet" type="text/css" href="../css/manage_staffs.css">
   <title>dashboard</title>
</head>
<body>
   <div class="container">
      <div class='content-title'>Manage Staffs</div>
      <div class="create-option-body">
         <div style="border-radius: 5px; border: 1px solid lightgrey; height: 50px;">
             <div class="top-title"><p>Account</p></div>
             <div class="options" style='height: 40px;'>
               <div>
                  <img src="../photoes/medecine_presentation.png">
                  <a class="link" href="manage_staff.php">Manage Staffs</a>
               </div>
                
         </div>
      </div>
      <div style="background-color: white; border: 1px solid lightgrey;">
         <div class="top-title">
            <p>Create new Staff</p>
         </div>
            <form 
               action="manage_staff.php"
               method="post" 
               class="form">
               <div>
                  <label>Username</label><br>
                  <input type="text" name='input_name' required>
               </div>
                <div>
                  <label>Password</label><br>
                  <input type="Text"  name='input_password' required>
               </div>
               <div style='width: 70px;'>
                  <input class='search-btn' name='create-btn' type='submit'value="Create">
               </div>
            </form> 
            <div style='background-color: aliceblue; height: 30px;'>
          
            </div>
            <div style='background-color: aliceblue; border: 1px solid lightgrey;'>
               <h5 style='margin-top: 10px;margin-bottom: 10px; margin-left: 10px;'>Staff List</h5>
            </div>
            <div style="padding: 8px 20px;">
         
               <table class='staff_table' style='margin-top: 5px;'>
                  <thead>
                     <tr>
                        <th>#</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                  <?php 

                   $get_data = "SELECT * FROM staff";
                   $result = mysqli_query($connection, $get_data);

                   while($row = mysqli_fetch_assoc($result)){
                     $id = $row['ID'];
                     echo"
                     <tr class='row'>
                        <td>{$row['ID']}</td>
                        <td style='text-align: start;'>{$row['NAME']}</td>
                        <td>{$row['PASSWORD']}</td>
                        <td>
                           <a class='delete_btn' href='manage_staff.php? delete=".$id."'>Delete</a>
                           <a class='edit-button'>Edit</a>
                        </td>
                      </tr>
                     ";
                   }
                    
                  ?>

                  </tbody>
               </table>
            </div>
         </div>
      </div>
    
   </div>
   <div class='container' >
  
   </div>          
    
    <div class="footer">
      <hp>@fayeqbahram - PHP Developer - 2025</hp>
   </div>
   
   <script>
       if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href)
         }
   </script>
   
</body>
</html>