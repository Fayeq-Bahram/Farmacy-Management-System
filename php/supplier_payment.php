<?php
   include("header.php");
   include("connection.php");


?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" type="text/css" href="../css/body.css">
    <link rel="stylesheet" type="text/css" href="../css/create_style.css">
     <link rel="stylesheet" type="text/css" href="../css/supplier-payment.css">
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
               <p>Create Medicine Name</p>
            </div>
            <div class="form-container">
               <form class="form" action="" method="post">
                  <div>
                     <label>Supplier Company</label><br>
                     <select name='supplier_company' required>
                         <option>Select Supplier Company</option>
                        <?PHP
                           $sql = "SELECT DISTINCT SUPPLIER_COMPANY FROM inventory ORDER BY SUPPLIER_COMPANY ASC";
                           $result = $connection -> query($sql);
                           if($result -> num_rows > 0){
                              while($row = $result -> fetch_assoc()){
                              
                                 echo"<option value='{$row['SUPPLIER_COMPANY']}'>{$row['SUPPLIER_COMPANY']}</option>";
                              }
                           }
                        ?>
      
                     </select>
                    <input style="width: 90px; height: 30px; margin-top: 10px;" class="create-btn" name='searchBtn' type="submit" value="Search">
                    
                  </div>
               </form>
            </div>
         </div>
           
      </div>
        <p class="medecine-name-list">Purchase Statement</p>
      <div style="padding: 10px 20px; border: 1px solid lightgrey;  background-color: white; margin-top: 5px;">
         <form class="purchase-st-form" action='supplier_payment.php' method='post'>
            <div>
               <label>Previouse Due</label><br>
               <input id='first_input' name='pre_due_input' type='text' value='<?php
                  if(isset($_POST['searchBtn'])){
                     $supplier_company = $_POST['supplier_company'];
                     $sql  = "SELECT SUM(PURCHASE_DUE) FROM inventory 
                              WHERE SUPPLIER_COMPANY =  '$supplier_company'";

                     $result = $connection -> query($sql);
                     while($row = $result -> fetch_assoc()){
                        echo $row['SUM(PURCHASE_DUE)'];
                     }
                  }?>'  required>  
             </div>
                <div>
               <label>Pay Amount</label><br>
               <input id='second_input' name='pay_due' type="number"  oninput="calculate()" required>
            </div>
                <div>
               <label>Final Due</label><br>
               <input id='output' name='final_due' type="text" readonly required>
            </div>
           <div style="display: flex; align-items: end; width: 90px;">
            <input style="height: 26px;" class="pay-btn" type="submit" name='payBtn' value="Pay">
           </div>
         </form>
       <table class="payment-table">
           <h4 align="center" style="margin-top: 20px;">Supplier Name: 
            <?php echo"<span style='color: darkgreen;'></span> "; ?>
         </h4>
         <thead>
            <tr>
               <th>#</th>
               <th>Date</th>
               <th>Particular</th>
               <th>Supplier</th>
               <th>Total</th>
               <th>Paid</th>
               <th>Due</th>
            </tr>
            <tbody>
               <?php
                 
                  $pre_due_input = null;
                  if(isset($_POST['payBtn'])){
                    
                     if($_SERVER['REQUEST_METHOD'] == 'POST'){
                        $pre_due_input = $_POST['pre_due_input'];
                        $final_due = $_POST['final_due'];
                      
                     }
                     
                       
                       $pay_due = $_POST['pay_due'];
                 
                       $sql_insert = "INSERT INTO supplier_payment(PAY_DATE,PARTICULAR, SUPPLIER, TOTAL, PAID_AMOUNT, FINAL_DUE) VALUE(CURRENT_DATE, 'Panadol', 'Mahan Company', '$pre_due_input', '$pay_due','$final_due')";
                      
                       $sql_result = $connection->query($sql_insert);
                       
                       $get_data = "SELECT * FROM supplier_payment";
                       $result = $connection -> query($get_data);

                       if($result -> num_rows > 0){
                         while($row = $result -> fetch_assoc()){
                           echo"
                              <tr>
                                 <td>{$row['ID']}</td>
                                 <td>{$row['PAY_DATE']}</td>
                                 <td>S{$row['PARTICULAR']}</td>
                                 <td>{$row['SUPPLIER']}</td>
                                 <td>{$row['TOTAL']}</td>
                                 <td>{$row['PAID_AMOUNT']}</td>
                                 <td>{$row['FINAL_DUE']}</td>
                              </tr>
                             
                           ";
                         }
                       }
  
                     /*
                        $paid = $pay_due - $pre_due_input;
                        $enter_due = "UPDATE TABLE inventory SET PURCHASE_DUE = '$paid' WHERE SUPPLIER_COMPANY= '$supplier_company'";
                        $res = $connection -> query($enter_due);   
                       */

                  }
               ?>
            </tbody>
         </thead>
       </table>
      </div>
   </div>
      <script>
         if(window.history.replaceState){
            window.history.replaceState(null, null, window.location.href)
         }

         function calculate(){
            let first_input = document.getElementById('first_input').value;
            let second_input = document.getElementById('second_input').value;
            let output = document.getElementById('output');

            let result = second_input - first_input;
            output.value = result;
   
         }
          let first_input = document.getElementById('first_input').value;

      </script>



    <div class="footer">
      <hp>@fayeqbahram - PHP Developer - 2025</hp>
   </div>
   

</body>
</html>