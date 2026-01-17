<?php
   include("header.php");
   include("connection.php");
   include("delete_row.php");
  
      
   if(isset($_POST["btn-create"])){

     $create_input = $_POST["create_input"];

     $insert_data = "INSERT INTO med_presentation(MEDICINE_NAME)VALUE('$create_input')";
      mysqli_query($connection, $insert_data);
      //Data retrieve from database;
   }

   
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" type="text/css" href="../css/dashboard.css">
   <link rel="stylesheet" type="text/css" href="../css/create_style.css">
   <link rel="stylesheet" type="text/css" href="../css/medecine_presentationss.css">
   <title>dashboard</title>
</head>
<body>

   <div class="container">
      <div class="content-title">
         <p>Create Option</p>
      </div>
      <div class="create-option-body">
         <div style="border-radius: 5px; border: 1px solid lightgrey; height: 160px;">
            <div class="top-title"><p>Create Option</p></div>
            <div class="options">
               <div>
                  <img src="../photoes/medecine_presentation.png">
                  <a class="link" href="medicine_presentation.php">Medicine Presentation</a>
               </div>
                <div>
                  <img src="../photoes/generic_name.png">
                  <a class="link" href="generic_name.php">Generic Name</a>
               </div>
                <div>
                  <img src="../photoes/medecine_name.png">
                  <a class="link" href="create_option.php">Medecine Name</a>
               </div>
                <div>
                  <img src="../photoes/supplier.png">
                  <a class="link" href="supplier.php">Supplier</a>
               </div>
            </div>
         </div>
         <div style="border-radius: 5px; border: 1px solid lightgrey;">
             <div class="top-title"><p>Create Medicine Presentation</p></div>
            <div>
               <div class="form-container">
                  <form 
                  class="form" 
                  action='medicine_presentation.php'

                  method="post">
                     <label>Medicine Presentation</label><br>
                     <input class="input-create"  type="text" name='create_input' placeholder="Medecine name" required><br>
                     <input class="button-submit" type="submit" value="Create" name="btn-create">  
                   </form>
               </div>
            </div>
            <div style="padding: 5px 10px;">
               <p class="medicine-list">Medicine Presentation List</p>
               <table class="table" style="margin-top: 6px; margin-bottom: 15px">
                  <thead>
                     <tr>
                        <th>#</th>
                        <th>Medicine Presentation</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody >
                    <?php
                    
                       $data_retrieve ="SELECT * FROM  med_presentation";
                       $result = mysqli_query($connection, $data_retrieve);

                        while($rows= mysqli_fetch_assoc($result)){
                       
                        $id = $rows['Serial_no'];
                        echo "
                           <tr class='row'>
                              <td id='centered'>{$rows['Serial_no']} </td>
                              <td> {$rows['MEDICINE_NAME']} </td>
                              <td id='centered'><a class='delete_btn' name='del_btn' href='medicine_presentation.php? deleteId=".$id."'>Delete</a></td>
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
    <div class="footer">
      <hp>@fayeqbahram - PHP Developer - 2025</hp>
   </div>
   
   <script>
      
      if (window.history.replaceState)
      {
         window.history.replaceState(null, null, window.location.href)
      }

   </script>

</body>
</html>

<?php mysqli_close($connection);?>