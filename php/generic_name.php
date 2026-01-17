<?php
   include("header.php");
   include("connection.php");
   include("delete_row.php");

   if(isset($_POST["btn-create"]))

      {
         $gn_input = $_POST['gn_input'];
        $sql_insert = "INSERT INTO GENERIC_NAME(MEDICINE_NAME)VALUE('$gn_input')";
        mysqli_query($connection,  $sql_insert);
      }

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" type="text/css" href="../css/dashboard.css">
   <link rel="stylesheet" type="text/css" href="../css/create_style.css">
   <link rel="stylesheet" type="text/css" href="../css/generic_name.css">
   <link rel="stylesheet" type="text/css" href="../css/medecine_presentationss.css">
   <title>dashboard</title>
</head>
<body>
   <div class="container">
      <div class="content-title">
         <p>Create Option</p>
      </div>
      <div class="create-option-body">
         <div style="border-radius: 5px; border: 1px solid lightgrey;">
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
             <div class="top-title"><p>Create Generic Name</p></div>
             <div class="form-conatiner">
                  <form class="form" action="generic_name.php" method='post'>
                     <label>Generic Name</label><br>
                     <input class="input-create" name='gn_input' type="input" placeholder="Generic name"><br>
                     <input class="button-submit" type="submit" value="Create" name="btn-create">  
                   </form>
               </div>
            <div style="padding: 5px 10px;">
               <p class="medicine-list">Generic Name List</p>
               <table class="table" style="margin-top: 6px;">
                  <thead>
                     <tr>
                        <th>#</th>
                        <th>Generic Name</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php
                        $get_data = "SELECT * FROM generic_name";
                        $result = mysqli_query($connection, $get_data);

                        while($rows = mysqli_fetch_assoc($result)){
                        
                           $row_id = $rows['ID'];
                           echo "
                           <tr class='row'>
                              <td id='centered'>{$rows['ID']}</td>
                              <td>{$rows['MEDICINE_NAME']}</td>
                              <td id='centered'>
                                 <a class='delete_btn' href='generic_name.php? rowId=".$row_id."'>Delete</a>
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
             window.history.replaceState(null, null, window.location.href)
            
         }
   </script>

</body>
</html>

<?php
   mysqli_close($connection);
?>