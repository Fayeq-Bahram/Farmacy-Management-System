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
   <link rel="stylesheet" type="text/css" href="../css/sales_style.css">
   <link rel="stylesheet" type="text/css" href="../css/sell_statement.css">
   <title>dashboard</title>
</head>
<body>
   <div class="container">
      <div class='content-title'>Sales/sell Medicine</div>
      <div class="create-option-body">
         <div style="border-radius: 5px; border: 1px solid lightgrey; height: 160px;">
             <div class="top-title"><p>Sales</p></div>
             <div class="options">
               <div>
                  <img src="../photoes/medecine_presentation.png">
                  <a class="link" href="sales.php">Sell Medicine</a>
               </div>
                <div>
                  <img src="../photoes/medEcine_name.png">
                  <a class="link"  href="sell_statement.php">Sales Statement</a>
               </div>
         </div>
      </div>
      <div style="background-color: white; border: 1px solid lightgrey;">
         <div class="top-title">
            <h5 style="color: white;">Sell Statement</h5>
         </div>
         <div  style="padding: 5px 10px;">
            <form 
               action="sell_statement.php"
               method="post" 
               class="form" >
              <div>
                <label for='from_date'>Date From</label><br>
                <input type="date" id='js_fromDate'  name='from_date' max="<?php  echo date("Y-m-d"); ?>" onchange="get_date();">
              </div>
               <div>
                  <label for='to_date'>Date From</label><br>
                  <input type="date" id='js_toDate' name='to_date' min="<?php echo date("Y-m-d"); ?>">
              </div>
              <input class='btn_submit' name='search_button' type="submit" value="Search">
            </form> 
         </div>
      </div>
    
   </div>
    <button class='print_button' onclick="printContent()">Print</button>
   <div  class='salesSheet'>
     <div style="margin-top: 20px; border: 1px solid lightgrey; padding: 5px 10px;">
          <p class='title' style='display: inline-block;'>Sales Statement</p>
            <h4>
               <?php 
                  if($_SERVER['REQUEST_METHOD'] == 'POST'){
                     $from_date = $_POST['from_date'];
                      $to_date = $_POST['to_date'];

                       echo"<p align='center' style='color: tomato;'>Report from: ". $from_date ." - ". $to_date . "</p>";
                  }
               ?>
            </h4>
         <div style='background-color: white;'>
            </div>
            <table class='sales_table' style='width: 100%;'>
               <thead>
                  <tr>
                     <th>#</th>
                     <th>Date</th>
                     <th>Customer Contact</th>
                     <th>Medicine</th>
                     <th>Unit Price</th>
                     <th>Quantity</th>
                     <th>Sup-Total</th>
                     <th>Discount</th>
                     <th>Total Amount</th>
                  </tr>
               </thead>
               <tbody>
        <?php
         
          if(isset($_POST['search_button'])){
            $from_date = $_POST['from_date'];
            $to_date = $_POST['to_date'];
            
            $sale_report = "SELECT * FROM sales_statement WHERE SELL_DATE BETWEEN '$from_date' AND '$to_date'";

            $result = mysqli_query($connection, $sale_report);

            if(mysqli_num_rows($result)){
               while($row = mysqli_fetch_assoc($result)){
                  echo" 
                     <tr>
                        <td>{$row['INVOICE_ID']}</td>
                        <td>{$row['SELL_DATE']}</td>
                        <td>{$row['CUSTOMER_CONTACT']}</td>
                        <td>{$row['MEDICINE_NAME']}</td>
                        <td>{$row['SELLING_PRICE']}</td>
                        <td>{$row['QUANTITY']}</td>
                        <td>{$row['SUP_TOTAL']}</td>
                        <td>{$row['DISCOUNT']}</td>
                        <td>{$row['TOTAL_AMOUNT']}</td>
                     </tr>
                           
                     ";
                   }
               }
//    Discount ............................
               $dis_query= "SELECT SUM(DISCOUNT) FROM sales_statement WHERE SELL_DATE BETWEEN '$from_date' AND '$to_date'";
               $dis_result = mysqli_query($connection, $dis_query);
               
              $row1 = mysqli_fetch_assoc($dis_result);
              $discount = $row1['SUM(DISCOUNT)'];
// paid discount ........................................

               $sql= "SELECT SUM(SUP_TOTAL) FROM sales_statement WHERE SELL_DATE BETWEEN '$from_date' AND '$to_date'";
               $results = mysqli_query($connection, $sql);
               
              $row3 = mysqli_fetch_assoc($results);
              $SUP_total = $row3['SUM(SUP_TOTAL)'];
// paid discount ........................................

               $sum= "SELECT SUM(TOTAL_AMOUNT) FROM sales_statement WHERE SELL_DATE BETWEEN '$from_date' AND '$to_date'";
               $sum_result = mysqli_query($connection, $sum);
               
              $row = mysqli_fetch_assoc($sum_result);
              $total = $row['SUM(TOTAL_AMOUNT)'];



               echo"
                  <tr style='background-color: lightgrey'>
                     <th style='padding: 10px 5px; ' colspan='6'>Total</th>
                     <th>$$SUP_total</th>
                     <th>$$discount</th>
                     <th>$$total</th>
                  </tr>
               ";

            }
          ?>
           </tbody>
         </table>
      </div>

    
      <div class="footer">
      <hp>@fayeqbahram - PHP Developer - 2025</hp>
   </div>
   </div>
   <script>
      printContent = function(){
         var salesSheet = document.querySelector(".salesSheet").innerHTML;
         var printWindow = window.open('', '','height=600, width=800');
         printWindow.document.write('<html><head><title></title></head><body>');
         printWindow.document.write(salesSheet);
         printWindow.document.write('</body></html>');
         printWindow.document.close();
         printWindow.print();
      
      }

      const js_fromDate = document.getElementById("js_fromDate").value;
      const js_toDate = document.getElementById("js_toDate").value;



      function get_date(){
         const js_fromDate = document.getElementById("js_fromDate").value;
         const js_toDate = document.getElementById("js_toDate");

         js_toDate.setAttribute("min", js_fromDate);
       //  console.log(js_fromDate, js_toDate);
      }

      


   </script>
   
</body>
</html>