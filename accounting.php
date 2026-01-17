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
   <link rel="stylesheet" type="text/css" href="../css/accounting.css">
   <title>dashboard</title>
   <style>
      .head-title{
         background-color: rgb(224, 242, 250);
         padding: 8px 10px;
         text-align: center;
         border: 0.5px solid lightgrey;
         color: brown;
      }
   </style>


</head>
<body>
   <div class="container">
      <div class='content-title'>Sales/sell Medicine</div>
      <div class="create-option-body">
         <div style="border-radius: 5px; border: 1px solid lightgrey; height: 160px;">
             <div class="top-title"><p>Account</p></div>
             <div class="options">
               <div>
                  <img src="../photoes/medecine_presentation.png">
                  <a class="link" href="accounting.php">Profit and Loss</a>
               </div> 
         </div>
      </div>
      <div style="background-color: white; border: 1px solid lightgrey;">
         <div class="top-title">
            <p>Profit & Loss</p>
         </div>
            <form 
               action="accounting.php"
               method="post" 
               class="form">
               <div>
                  <label>Medecine Name</label>
                  <select class='option' name='medicine_name'>
                     <?php
                        $sql = "SELECT DISTINCT MEDICINE_NAME from sales_statement ORDER BY MEDICINE_NAME ASC";
                        $res = mysqli_query($connection, $sql); 
                        while($row = mysqli_fetch_assoc($res)){
                           echo"<option>{$row['MEDICINE_NAME']}</option>";
                        }
                                            
                     ?>
                  </select>
               </div>
               <div>
                  <label>Date From</label><br>
                  <input type="date" name='date_from' id="js_fromDate"  max="<?php echo date('Y-m-d'); ?>" onchange="get_date();">
               </div>
                <div>
                  <label>Date To</label><br>
                  <input type="date" name='date_to' id="js_toDate" max="<?php echo date('Y-m-d'); ?>">
               </div>
                
               <div style='width: 60px;'>
                  <input class='search-btn' name='search_button' type='submit' value='Search'>
               </div>
            </form> 
         </div>
      </div>
    
   </div>
   <div class='container' >
      <div id='container'>
  
         <h4 class='head-title'>
            <?php 
               if(isset($_POST['search_button'])){
                     $date_from = $_POST['date_from'];
                     $date_to= $_POST['date_to'];

                     echo "<h3 style='text-align: center; display: inline-block;'>Profit/Loss report: From <span>$date_from -  $date_to </span></h3>";
               }
               ?>
         </h4>
         <input  class='print_button' type='submit' value='Print' >
         <table class='table'style='margin-top: 10px;'>
            <thead>
               <tr class='row'>
                  <th>#</th>
                  <th>Sell Date</th>
                  <th>Medicine Name</th>
                  <th>Customer Contact</th>
                  <th>Purchase Price</th>
                  <th>Selling Price</th>
                  <th>Sold Quantity</th>
                  <th>Total Amount</th>
                  <th>Profit / Loss per Unit</th>
               </tr>
            <thead>
            <tbody id='tbody'>
               <?php 
                   
                  if(isset($_POST['search_button'])){
                     $medicine_name = $_POST['medicine_name'];
                     $date_from = $_POST['date_from'];
                     $date_to= $_POST['date_to'];
                     
                     $sql = "SELECT * FROM sales_statement
                              WHERE MEDICINE_NAME = '$medicine_name'
                              AND SELL_DATE
                              BETWEEN '$date_from'
                              AND '$date_to'"
                           ;                   
                     $result = $connection -> query($sql);
                     if($result -> num_rows > 0){
                        while($row = $result -> fetch_assoc()){
                            $med_name = $row['MEDICINE_NAME'];
                           $quantity = $row['QUANTITY'];
                           $purchase_price = $row['PURCHASE_PRICE'];
                           $sell_price = $row['SELLING_PRICE'];

                           $TOTAL = $quantity * $sell_price;

                           $profit = $sell_price - $purchase_price;
                           $loss =  $sell_price < $purchase_price;
                          
                        echo"<tr>
                              <td>{$row['INVOICE_ID']}</td>
                              <td>{$row['SELL_DATE']}</td>
                              <td>{$row['MEDICINE_NAME']}</td>
                              <td>{$row['CUSTOMER_CONTACT']}</td>
                              <td>{$row['PURCHASE_PRICE']}</td>
                              <td>{$row['SELLING_PRICE']}</td>    
                              <td>{$row['QUANTITY']}</td>
                              <td>$TOTAL</td>
                              <td>$profit / $loss</td>
                              </tr>";
                        }
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
       
       if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href)
         }

 
   </script>
   
</body>
</html>