<?php
   include("header.php");
   include("connection.php");

   $fromDate = null; 
   $toDate =  null;

   // list all allowed columns for dropdown.

     $columns = [
      "ID","PURCHASE_DATE", "MEDICINE_NAME", "GENERIC_NAME", "PRESENTATION", 
       "SUPPLIER_COMPANY", "TOTAL_QUANTITY", "UNIT_PRICE", "TOTAL_AMOUNT",
      "SELLING_PRICE", "VOLUME", "PURCHASE_PAID", "PURCHASE_DUE", "EXPIRY_DATE"];

   


?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" type="text/css" href="../css/body.css">
    <link rel="stylesheet" type="text/css" href="../css/create_style.css">
     <link rel="stylesheet" type="text/css" href="../css/purchase_statements.css">
      
   <title>dashboard</title>
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
               <p>Medicine Purchase Statement</p>
            </div>
            <div class="form-container" style="height: 200px;">
               <form  class="form" 
               action="purchase_statement.php" 
               method="post">
                  <div>
                     <label>Date From</label><br>
                     <input type="date" name='fromDate' id='js_fromDate' max="<?php echo date('Y-m-d'); ?>" onchange="get_date();">
                     <br>
                     <label>Medicine Name</label><br>
                        <select name='medicine_name' required>
                           <option>Select Medicine Name</option>
                        <?php
                              $MED_name = "SELECT DISTINCT MEDICINE_NAME FROM inventory ORDER BY MEDICINE_NAME ASC";
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
                     <label>Date To</label><br>
                     <input type="date" name="toDate"  id='js_toDate'  max="<?php echo date('Y-m-d'); ?>" >
                     <br>
                     <label>Supplier Company</label><br>
                     <select name='supplier_company'>
                        <option>Select Supplier Company</option>
                            <?php
                              $MED_name = "SELECT DISTINCT SUPPLIER_COMPANY FROM inventory ORDER BY SUPPLIER_COMPANY ASC";
                              $result = $connection -> query($MED_name);
                              if($result -> num_rows > 0){
                                 while($row = $result -> fetch_assoc()){
                                    $name = $row['SUPPLIER_COMPANY'];
                                    echo"<option value='$name'>$name</option>";
                                 }
                             
                              }
                        ?>
                     </select>
                  </div>
                   <input style="width: 70px;" name='search_btn' class="create-btn" type="submit" value="Search" >
               </form>
            </div>
           
         </div>
          <p class="medecine-name-list">Purchase Statement</p>
         
      </div>
       <div class="statement-container">
          
           <table class="table">
               <thead>
                  <tr>
                     <th>#</th>
                     <th>Purchase Date </th>
                     <th>Details</th>
                     <th>Supplier Name</th>
                     <th>Unit Price</th>
                     <th>Quantity</th>
                     <th>Total Amount</th>
                     <th>Paid</th>
                     <th>Due</th>
                     <th>Expiry Date</th>
                  </tr>
               </thead>
              <tbody>
               <?php
            
                  if(isset($_POST['search_btn'])){
                     $medicine_name = $_POST['medicine_name'];
                     $supplier_company = $_POST['supplier_company'];
                     $fromDate = $_POST['fromDate'];
                     $toDate = $_POST['toDate'];

                     $query = "SELECT * FROM inventory WHERE 
                              MEDICINE_NAME  = '$medicine_name'
                              AND
                              SUPPLIER_COMPANY = '$supplier_company'
                              AND PURCHASE_DATE
                              BETWEEN
                              '$fromDate'
                              AND
                              '$toDate'
                              ";

                        $result = $connection -> query($query);

                        if($result -> num_rows > 0){
                           while($row = $result -> fetch_assoc()){

                              echo"
                              <tr>
                                 <td>{$row['ID']}</td>
                                 <td>{$row['PURCHASE_DATE']}</td>
                                 <td>
                                    <b>Name:</b> {$row['MEDICINE_NAME']}<br>
                                    <b>Generic:</b> {$row['GENERIC_NAME']}<br>
                                    <b>Presentaion:</b>  {$row['PRESENTATION']}
                                 </td>
                                 <td>{$row['SUPPLIER_COMPANY']}</td>
                                 <td>{$row['UNIT_PRICE']}</td>
                                 <td>{$row['TOTAL_QUANTITY']}</td>
                                 <td>{$row['TOTAL_AMOUNT']}</td>
                                 <td>{$row['PURCHASE_PAID']}</td>
                                 <td>{$row['PURCHASE_DUE']}</td>
                                 <td>{$row['EXPIRY_DATE']}</td>
                              </tr>
                              ";
                                 echo $row['MEDICINE_NAME'];
                           }
                        }else{
                           echo "<tr><h5 style='color: red; padding: 7px 5px;'>No Records Found</h5></tr>";
                        }
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
         function get_date(){
             const js_fromDate = document.getElementById("js_fromDate").value;
             const js_toDate = document.getElementById("js_toDate");

            js_toDate.setAttribute("min", js_fromDate);
           
         }

      </script>
      
</body>
</html>

