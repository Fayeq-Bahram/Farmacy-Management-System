<?php
   include("header.php");
   include("connection.php");
   include("delete_row.php");
   
   if(isset($_POST["register_btn"])){
      $supplier_name = $_POST['supplier_name'];
      $phone_no = $_POST['phone_no'];
      $address = $_POST['address'];
      $pre_dues = $_POST['pre_dues'];

      $sql_insert = "INSERT INTO SUPPLIER(SUPPLIER_NAME, PHONE_NO, ADDRESS, PRE_DUES)
                     value('$supplier_name', '$phone_no', '$address', '$pre_dues');";
      $result = mysqli_query($connection, $sql_insert);

   }

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" type="text/css" href="../css/dashboard.css">
   <link rel="stylesheet" type="text/css" href="../css/create_style.css">
    <link rel="stylesheet" type="text/css" href="../css/supplier.css">
   <title>dashboard</title>
</head>
<body>
   <div class="container">
      <div class="content-title">
         <p>Create Option</p>
      </div>
      <div class="create-option-body">
         <div style="border-radius: 5px; border: 1px solid lightgrey; height: 170px;">
            <div class="top-title">
               <p>Create Option</p>
            </div>
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
             <div class="top-title"><p>Supplier</p></div>
            <div>
               <div class="container-form">
                  <form class="form" action="supplier.php" method="post">
                     <div>
                        <label>Supplier Name</label><br>
                         <input type="text" name='supplier_name' required placeholder='Supplier name'>
                     </div>
                     <div>
                        <label>Phone No:</label><br>
                        <input type="text" name='phone_no' required placeholder='Phone number'> 
                     </div>
                     <div>
                        <label>Address</label><br>
                        <input type="text" name='address' required placeholder='Address'>
                     </div>
                     <div>
                        <label>Previous Dues</label><br>
                        <input type="text" name='pre_dues' required placeholder='Previous Dues'>
                     </div>
                     <input class="button-btn" name='register_btn' type="submit" value="Create">
                  </form>
               </div>
             
            </div>
         </div>
      </div>
      <div class='container' style=' margin-top: 20px; padding: 20px 10px;'>
         <table class='table' style='width: 100%'>
            <thead>
               <tr style='background-color: red;'>
                  <th id='th'>#</th>
                  <th id='th'>Supplier Name</th>
                  <th id='th'>Contact No</th>
                  <th id='th'>Address</th>
                  <th id='th'>Previous Dues</th>
                  <th id='th'>Action</th>
               </tr>
               <tbody>
                  <?php 
                  $get_row = "SELECT * FROM SUPPLIER";
                  $res = mysqli_query($connection, $get_row);
                  while($row = mysqli_fetch_assoc($res))
                  {
                     $id = $row['ID'];
                  echo "
                     <tr id='row'>
                        <td >{$row['ID']}</td>
                        <td>{$row['SUPPLIER_NAME']}</td>
                        <td>{$row['PHONE_NO']}</td>
                        <td>{$row['ADDRESS']}</td>
                        <td>{$row['PRE_DUES']}</td>
                        <td id='centered'>
                           <a class='delete_btn' href='supplier.php? ID=".$id."'>Delete</a>
                        </td>
                     </tr>
                     ";
                  }

             
                   
                  ?>
               </tbody>
            </thead>
         </table>
      </div>
   </div>
    <div class="footer">
      <hp>@fayeqbahram - PHP Developer - 2025</hp>
   </div>
   
   <script>
      if(window.history.replaceState){
         window.replaceState(null, null, window.location.href);
      }
   </script>

</body>
</html>