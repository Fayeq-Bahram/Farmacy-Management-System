<?php
   include("header.php");
   include("connection.php");
   include("delete_row.php");

  if(isset($_POST["create_btn"]))
      {
         $MED_name = $_POST['MED_name'];
         $generic_name = $_POST['generic_name'];
         $med_presentation = $_POST['med_presentation'];
         $supply_com = $_POST['supply_com'];
         $total_quantity = $_POST['total_quantity'];
         $unit_price = $_POST["unit_price"];
         $total_amount = $_POST['total_amount'];
         $selling_price = $_POST['selling_price'];
         $volume = $_POST['volume'];
         $purchase_paid = $_POST['purchase_paid'];
         $purchase_due =  $total_amount - $purchase_paid;
         $date = $_POST['date'];

         $sql_insert = "INSERT INTO INVENTORY(MEDICINE_NAME, GENERIC_NAME, PRESENTATION, SUPPLIER_COMPANY, TOTAL_QUANTITY, UNIT_PRICE, TOTAL_AMOUNT, SELLING_PRICE, VOLUME, PURCHASE_PAID, PURCHASE_DUE, EXPIRY_DATE)
            value('$MED_name', '$generic_name', '$med_presentation', '$supply_com', '$total_quantity', '$unit_price', '$total_amount', '$selling_price', '$volume', '$purchase_paid', '$purchase_due', '$date')";

            $result = mysqli_query($connection, $sql_insert);
         
      }
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" type="text/css" href="../css/body.css">
   <link rel="stylesheet" type="text/css" href="../css/create_style.css">
   <link rel="stylesheet" type="text/css" href="../css/inventory_style.css">
   <title>dashboard</title>
   <style>
      #option{
         padding: 5px 5px;
      }
     #row th{
      font-size: 11px;
     }
    #output_row td{
      font-size: 11px;
      text-align: center;
    }

   </style>
</head>
<body>
   <div class="container">
      <div class='content-title'>Inventory</div>
          <div class="create-option-body">
         <div style="border-radius: 5px; border: 1px solid lightgrey; height: 160px;">
            <div class="top-title"><p>Inventory</p></div>
            <div class="options">
               <div>
                  <img src="../photoes/medecine_presentation.png">
                  <a class="link" href="inventory.php">Insert Medicine Info</a>
               </div>
                <div>
                  <img src="../photoes/generic_name.png">
                  <a class="link" href="purchase_statement.php">Purchase Statement</a>
               </div>
                <div>
                  <img src="../photoes/medEcine_name.png">
                  <a class="link"  href="supplier_payment.php">Supplier Payment</a>
               </div>
            </div>
         </div>
         <div style="border-radius: 5px; border: 1px solid lightgrey;">
             <div class="top-title">
               <p>Insert Medicine Purchase Information</p>
            </div>
            <div class="form-container" style="height: 225px;">
               <form  class="form" action="inventory.php" method="post">
                  <div class='form-element'>
                     <div>
                        <label>Medicine Name</label><br>
                        <select name='MED_name' class='input-element' required>
                           <option> Select Medicine Name </option>
                           <?php
                              $MED_name = "SELECT MEDICINE_NAME FROM create_medicine";
                              $result = $connection -> query($MED_name);
                              if($result -> num_rows > 0){
                                 while($row = $result -> fetch_assoc()){
                                    $name = $row['MEDICINE_NAME'];
                                    echo"<option value='$name'>$name</option>";
                                 }
                             
                              }
                           ?>
                        </select>
                     </div>
                     <div>
                        <label>Generic Name</label><br>
                        <select name='generic_name' class='input-element'>
                           <option> Generic Name </option>
                           <?php
                              $gen_name = "SELECT GENERIC_NAME FROM create_medicine";
                              $res = $connection -> query($gen_name);
                              if($res -> num_rows > 0){
                                 while($row = $res -> fetch_assoc()){
                                    $generic_name = $row['GENERIC_NAME'];
                                    echo "<option value='$generic_name'>$generic_name</option>";
                                 }
                              }
                           ?>
                          
                        </select>
                     </div>
                     <div>
                        <label>Presentation</label><br>
                        <select name='med_presentation' class='input-element'>
                           <option>Medicine Type</option>

                        <?php
                           $get_presentation = "SELECT MEDICINE_NAME FROM med_presentation";
                           $result = $connection -> query($get_presentation);
                           if($result -> num_rows > 0){
                              while($row = $result -> fetch_assoc()){
                                 $med_pre = $row['MEDICINE_NAME'];
                                 echo "<option value='$med_pre'>$med_pre</option>";
                              }
                           }
                        
                        ?>
                        </select>
                     </div>
                     <div>
                           <label>Supplier Company</label><br>
                           <select name='supply_com' class='input-element'>
                              <option> Supplier Name </option>
                              <?php 
                                 $get_supplier = "SELECT SUPPLIER_NAME FROM supplier";
                                 $res = $connection -> query($get_supplier);
                                 if($res -> num_rows > 0){
                                    while($row = $res -> fetch_assoc()){
                                       $supplier = $row['SUPPLIER_NAME'];
                                       echo "<option value='$supplier'>$supplier</option>";
                                    }
                                 }

                              ?>
                              <option>Supplier</option>
                           </select>
                     </div>
                  </div>
                  <div class='form-element'>
                     <div>
                        <label>Total Quantity:</label><br>
                        <input class='input-type'  type="numeric" name='total_quantity'  required>
                     </div>
                     <div>
                        <label>Unit Price</label><br>
                         <input class='input-type' type="text" name='unit_price'  required>
                     </div>
                     <div>
                        <label>Total Amount</label><br>
                        <input class='input-type'  type="text" name='total_amount'  required> 
                     </div>
                     <div>
                        <label>Selling Price</label><br>
                        <input class='input-type'  type="numeric" name='selling_price'  required>
                     </div>
                    
                  </div>
                  <div class='form-element'>
                     <div>
                         <label>Volume</label><br>
                         <input class='input-type'  type="text" name='volume'  required>
                     </div>
                     <div>
                        <label>Purchase Paid</label><br>
                        <input class='input-type' type="numeric" name='purchase_paid'   required>
                     </div>
                     <div>
                        <label>Purchase Due</label><br>
                         <input class='input-type' type="text" name='purchase_due' >
                     </div>
                     <div>
                        <label>Expiry Date</label>
                        <input class='input-type'  type="date" name='date'  required>
                     </div>
                  </div>
                  <div>
                     <input class="submit-button" name='create_btn' type="submit" value="Create"> 
                  </div> 
               </form>
            </div>
         </div>
         
      </div>

        <div class="table-container" style="width: 103%; margin-top: 20px;">
          <p class="medecine-name-list">Medicine Name List</p>
             <table class="table">
               <thead>
                  <tr id='row'>
                     <th style="width: 25px;">#</th>
                     <th>Purchase Date </th>
                     <th>Details</th>
                     <th>Generic Name</th>
                     <th >Presentation</th>
                     <th>SUPPLIER COMPANY</th>
                     <th>TOTAL QUANTITY</th>
                     <th id='with'>UNIT PRICE</th>
                     <th>TOTAL AMOUNT</th>
                     <th id='with'>SELLING PRICE</th>
                     <th>VOLUME</th>
                     <th>PURCHASE PAID</th>
                     <th>PURCHASE Due</th>
                     <th>EXPIRY DATE</th>
                     <th >
                        ACTION
                     </th>
                  </tr>
                
               </thead>
               <tbody class="table-body">
                  <?php
                     $get_data = "SELECT * FROM inventory";
                     $result = mysqli_query($connection, $get_data);

                     while($row = mysqli_fetch_assoc($result)){
                        $invent_id = $row['ID'];
                     echo"
                        <tr id='output_row'>
                           <td id='centered'>{$row['ID']}</td>
                           <td id='centered'>{$row['PURCHASE_DATE']}</td>
                           <td>{$row['MEDICINE_NAME']}</td>
                           <td>{$row['GENERIC_NAME']}</td>
                           <td>{$row['PRESENTATION']}</td>
                           <td>{$row['SUPPLIER_COMPANY']}</td>
                           <td>{$row['TOTAL_QUANTITY']}</td>
                           <td>{$row['UNIT_PRICE']}</td>
                           <td>{$row['TOTAL_AMOUNT']}</td>
                           <td>{$row['SELLING_PRICE']}</td>
                           <td>{$row['VOLUME']}</td>
                           <td>{$row['PURCHASE_PAID']}</td>
                           <td style='color: tomato;'>{$row['PURCHASE_DUE']}</td>
                           <td>{$row['EXPIRY_DATE']}</td>
                           <td id='centered'>
                              <a class='delete_btn' href='inventory.php? delId=".$invent_id."'>Delete</a>
                           </td>
                        </tr>
                        ";  
                     }
                  ?>
               </tbody>
             </table>
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
  

mysqli_close($connection); ?>