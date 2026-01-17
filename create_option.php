<?php
   include("header.php");
   include("connection.php");
   include("delete_row.php");

   if(isset($_POST['create_btn']))
   {
     $generic_name = $_POST['generic_name'];
     $medname_input = $_POST['medname_input'];
     $insert = "INSERT INTO create_medicine(GENERIC_NAME, MEDICINE_NAME)
                        VALUE('$generic_name','$medname_input')";
      $result = mysqli_query($connection, $insert);
   }
  
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" type="text/css" href="../css/dashboard.css">
   <link rel="stylesheet" type="text/css" href="../css/create_style.css">
   <title>dashboard</title>
</head>
<body>
   <div class="container">
      <div class="content-title">
         <p>Create Option</p>
      </div>
      <div class="create-option-body">
         <div style="border-radius: 5px; border: 1px solid lightgrey; height: 170px;">
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
                  <img src="../photoes/medEcine_name.png">
                  <a class="link"  href="create_option.php">Medicine Name</a>
               </div>
                <div>
                  <img src="../photoes/supplier.png">
                  <a class="link" href="supplier.php">Supplier</a>
               </div>
            </div>
         </div>
         <div style="border-radius: 5px; border: 1px solid lightgrey;">
             <div class="top-title">
               <p>Create Medicine Name</p>
            </div>
            <div class="form-container">
               <form class="form" action="create_option.php" method="post">
                     <div class="input-container">
                        <div> 
                           <label>Generic Name</label><br>
                           <select name='generic_name'  class="styled-input" >
                              <option style="height: 100%; text-align: center; color: aliceblue;">- - - Generic Name - - -</option>
                              <?php
                                 $sql = "SELECT MEDICINE_NAME FROM generic_name";
                                 $result = $connection->query($sql);

                                 if($result->num_rows > 0){
                                    while ($row = $result->fetch_assoc()){
                                       $select_value = $row['MEDICINE_NAME'];
                                       echo "<option value='$select_value'>$select_value</option>"; 
                                    }  
                                 } 
                              ?>
                           </select>
                        </div>
                        <div>
                           <label>Medicine Name</label><br>
                           <input class="styled-input" type="text" name="medname_input" placeholder="Enter medecine name!">
                        </div>
                     </div>
                     <div class="button-container">
                        <input class="create-btn"  type="submit" value="Create" name="create_btn">
                     </div>
               </form>
            </div>
            <p class="medecine-name-list">Medicine Name List</p>
            <div class="table-container">
             <table class="table">
               <thead>
                  <tr>
                     <th style="width: 25px;">#</th>
                     <th>Generic Name</th>
                     <th>Medicine Name</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody class="table-body">
                  <?php
  
                     $get_row = "SELECT * FROM create_medicine";
                     $result = mysqli_query($connection, $get_row);
                 
                     while($row = mysqli_fetch_assoc($result)){
                       
                        $rowId = $row["ID"];
                        echo"
                           <tr class='row'>
                              <td id='centered'>{$row['ID']}</td>
                              <td>{$row['GENERIC_NAME']}</td>
                              <td>{$row['MEDICINE_NAME']}</td>
                              <td id='centered'>
                                  <a class='delete_btn' href='create_option.php? row_Id=".$rowId."'>Delete</a>
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
    <div class="footer">
      <hp>@fayeqbahram - PHP Developer - 2025</hp>
   </div>

   <script>
      if(window.history.replaceState){
         window.history.replaceState(null, null, window.location.href);
      }
   </script>

</body>
</html>

<?php mysqli_close($connection) ?>