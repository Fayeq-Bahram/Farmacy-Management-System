<?php
   include("header.php");
   include("connection.php");
   include("delete_row.php");




?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" type="text/css" href="../css/body.css">
   <link rel="stylesheet" type="text/css" href="../css/create_style.css">
   <link rel="stylesheet" type="text/css" href="../css/sales__style.css">


   <title>dashboard</title>
</head>
<body>
   <?php
       $hideform = true;
       $sell_sheet = true;


       if(isset($_GET['deleteRow'])){
         $deleteRow = $_GET['deleteRow'];

         $sql_get = "SELECT * FROM current_sales";
         $result = mysqli_query($connection, $sql_get);
         
         if($row = mysqli_fetch_assoc($result)){
            $customer = $row['CUSTOMER_CONTACT'];
            $delete_customer = "DELETE FROM current_sales WHERE CUSTOMER_CONTACT = '$customer'";
            $result = mysqli_query($connection, $delete_customer);
         }
       }

       if(isset($_GET['cancel_btn'])){
         $cancel_btn = $_GET['cancel_btn'];
         $sql_get = "SELECT * FROM current_sales";
         $result = mysqli_query($connection, $sql_get);

         if($row = mysqli_fetch_assoc($result)){
            $customer = $row['CUSTOMER_CONTACT'];
            $delete_customer = "DELETE FROM current_sales WHERE CUSTOMER_CONTACT = '$customer'";
            $result = mysqli_query($connection, $delete_customer);
         }
      
       }

  
   ?>
   <div class="container">
      <div class='content-title'>Sales/sell Medicine</div>
      <div class="create-option-body">
         <div style="border-radius: 5px; border: 1px solid lightgrey; height: 160px;">
             <div class="top-title"><p>Sales</p></div>
             <div class="options">
               <div>
                  <img src="../photoes/medecine_presentation.png">
                  <a class="link" href="sales.php? deleteRow='sales'">Sell Medicine</a>
               </div>
                <div>
                  <img src="../photoes/medEcine_name.png">
                  <a class="link"  href="sell_statement.php">Sales Statement</a>
               </div>
         </div>
      </div>
      <div style="background-color: white; border: 1px solid lightgrey;">
         <div class="top-title">
            <p>Sell Medicine</p>
         </div style='padding: 20px 5px;'>
         <?php

          if(isset($_POST["sell_button"])){

               $sql = "SELECT * FROM CURRENT_SALES";
               $result = $connection -> query($sql);

             if($row = mysqli_fetch_assoc($result)){

               echo" <button class='print-btn'onclick='printDiv()'>Print</button><br>
               <button onclick='window.print()'>Print whole page</button>";
               echo"
               <div class='invoice_container' id='printArea'>
               <div id='top-section'>
                  <h1 id='invoice-title'>INVOICE</h1>
                  <div id='invoice_description'>
                     <div id='farmacy-info'>
                        <h4>Bahram Sons Farmaceuticals</h4>
                        <p>District 11, Kabul - Afghtanistan</p>
                        <p>+93 773601666 , +93 786668803</p>
                        <p>fayeq.bahram@gmail.com</p>
                        <p>www.bahramsonsfarceuticals.com</p>
                     </div>
                     <div id='farmacy-info'>
                        <h4>Billed to</h4>
                        <p id='index'>NAME OF CUSTOMER</p>
                        <p id='index'>Address: <span id='name'>Herat- Afghanistan</span></p>
                        <p id='index'>+93 70003434 , +93 78666434</p>
                        <p id='index'>Email:  <span id='name'>{$row['CUSTOMER_CONTACT']}</span></p>
                        <br>
                        <hr>
                        <p id='index'>Invoice No#: <span id='name'>{$row['INVOICE_ID']}</span> </p>
                        <p id='index'>Account No# :   <span id='name'>N/A</span> </p>
                        <p id='index'>Essue Date:   <span id='name'>{$row['SELL_DATE']}</span> </p>
                     </div>
                  </div>
               </div>
               <table  style='margin-bottom: 10px; width: 97%;'>
                  <tbody>
                  <tr id='outPut_row' style='height: 46px;'>
                     <td>Description</td>
                     <td>Quantity</td>
                     <td>Unit Price</td>
                     <td>Total</td>
                     <td>Discount</td>
                     <td>Amount</td>
                  </tr>";
               }
               $sql2 = "SELECT * FROM CURRENT_SALES";
               $result2 = $connection -> query($sql2);
               
               while($row2 = mysqli_fetch_assoc($result2))
               {
                  $INVOICE_ID = $row2['INVOICE_ID'];
                  $SELL_DATE = $row2['SELL_DATE'];
                  $CUSTOMER_CONTACT = $row2['CUSTOMER_CONTACT'];
                  $MEDICINE_NAME = $row2['MEDICINE_NAME'];
                  $QUANTITY = $row2['QUANTITY'];
                  $PURCHASE_PRICE = $row2['PURCHASE_PRICE'];
                  $SELLING_PRICE = $row2['SELLING_PRICE'];
                  $SUP_TOTAL = $row2['SUP_TOTAL'];
                  $DISCOUNT = $row2['DISCOUNT'];
                  $TOTAL_AMOUNT = $row2['TOTAL_AMOUNT'];

                    $sql = "INSERT INTO SALES_STATEMENT(INVOICE_ID, SELL_DATE, CUSTOMER_CONTACT, MEDICINE_NAME, QUANTITY, PURCHASE_PRICE, SELLING_PRICE, SUP_TOTAL, DISCOUNT, TOTAL_AMOUNT) VALUE('$INVOICE_ID','$SELL_DATE', '$CUSTOMER_CONTACT','$MEDICINE_NAME', '$QUANTITY', '$PURCHASE_PRICE', '$SELLING_PRICE', '$SUP_TOTAL', '$DISCOUNT', '$TOTAL_AMOUNT')";

                  $res = $connection -> query($sql);

                  echo"
                     <tr id='row_out'>
                        <td >{$row2['MEDICINE_NAME']}</td>
                        <td >{$row2['QUANTITY']}</td>
                        <td >{$row2['SELLING_PRICE']}</td>
                        <td>{$row2['SUP_TOTAL']}</td>
                        <td >$<span>{$row2['DISCOUNT']}</td>
                        <td>$<span>{$row2['TOTAL_AMOUNT']}</span></td>
                     </tr>

                  ";

                 }
                 $sup_total = mysqli_query($connection, "SELECT SUM(SUP_TOTAL) from current_sales");
                 while($row = mysqli_fetch_assoc($sup_total)){
                  echo"
                     <tr id='' style='height: 26px; border: none; border-top: 6px solid rgb(64, 64, 139);;'>
                        <td colspan='4' style='text-align:right;'>Sup-Total:</td>
                        <td id='outTotal'>$</td>
                        <td id='outTotal'>{$row['SUM(SUP_TOTAL)']}</td>
                        
                     </tr>";
                 }
               echo"<tr  style='height: 26px; border: none;'>
                     <td colspan='4' style='text-align:right;'>Tax:</td>
                     <td id='outTotal'>$</td>
                     <td id='outTotal'>00</td>  
                  </tr>";

               $discount = mysqli_query($connection, "SELECT SUM(DISCOUNT) from current_sales");

               while($row = mysqli_fetch_assoc($discount)){
                    echo" <tr  style='height: 26px; border: none;'>
                     <td colspan='4' style='text-align:right; '>Discount:</td>
                     <td id='outTotal'>$</td>
                     <td id='outTotal'>{$row['SUM(DISCOUNT)']}</td>             
                  </tr>";
               }
               $total_amount = mysqli_query($connection, "SELECT SUM(TOTAL_AMOUNT) FROM current_sales");
               while($row = mysqli_fetch_assoc($total_amount)){
                  echo"<tr  style='height: 35px; border: none; background-color: rgb(175, 175, 255);'>
                     <tH colspan='4' style='text-align:right; '>TOTAL:</tH>
                     <tH id='outTotal'>$</th>
                     <th id='outTotal'>{$row['SUM(TOTAL_AMOUNT)']}</th>             
                  </tr>";
               }
             echo"  </tbody>
              </table>
              <div style='margin-left: 10px;'>
                  <h4 style='color: brown; text-align: center;'>Thank you for your business</h4>
                  <br>
                  <h4 style='color:tomato'>Invoice Terms </h4>
                  <p style='font-size: 13px; margin-top; 4px;'>The paid amount shall not be returned.</p>
                  <hr>
              </div>
            </div>"
            ;
       }   
      
            ?>
            <form 
               action="sales.php"
               method="post" 
               class="form"
               style=" <?php 
                     if(isset($_POST["sell_button"])){
                        echo $hideform ? 'display:none;': ''; 

                        }
                  ?>
               " >
               <div>
                  <div class="grid" style='padding: 10px 10px;'>
                        <div>
                           <label>Date</label><br>
                           <input class="input" type="date" name='sell_date'> 
                        </div>
                        <div>
                           <label>Customer Contact</label><br>
                           <input class="input" name='customer_mail'  type="text"> 
                        </div>
                        <div>
                           <label for='name'>Medicine Name</label><br>
                           <select class='input' id="product" name='name' onchange="getPrice(this.value)">

                              <option align='center'>--- Select Medicine ---</option>
                              <?php
                                 $sql = "SELECT DISTINCT MEDICINE_NAME from inventory ORDER BY MEDICINE_NAME ASC";
                                 $result = $connection -> query($sql);                     
                                 while($row = $result -> fetch_assoc()){
                                    $medName = $row['MEDICINE_NAME'];
                                 echo "<option value='{$row['MEDICINE_NAME']}'>{$row['MEDICINE_NAME']}"; 
                             
                                 echo"</option>";

                                 }
                              
                               ?>
                            </select> 
                        </div>
                     </div>
                  </div>
                   <div>
                     <div class='grid2'>  
                     <div>
                        <label>Selling Price</label><br>
                        <div class='input' name='sellingPrice'  type="text" name='sell_price'> 
                         <?php
                         /*
                         $name = $_POST['name'];
                         
                         $purchase_price = "SELECT PURCHASE_PRICE WHERE MEDICINE_NAME = '$name'";
                         $result = $connection -> query($purchase_price);
                         
                         $row = mysqli_fetch_assoc($result);

*/
                        ?>
                        </div>
                     </div>
                     <div>
                        <label>Quantity</label><br>
                        <input class='input'  type="number" name='quantity' required> 
                     </div>
                      <div>
                        
                        <label>Discount</label><br>
                        <input class='input'  type="text" name='discount'> 
                     </div>
                     <div>
                        
                        <label>Total</label><br>
                        <div class='input'  type="text" name='total'> </div>
                     </div>
                      
                    
                  </div>
                  <div class='button-container' >
                     <input class='add-button' name='add_button' type="submit" value="Add">
                  </div> 
               </div>
            </form> 
         </div>
      </div>
    
   </div>
   <div class='container'>
        <div style=" margin-top: 20px; margin:auto">
          <p class="medecine-name-list">Sale Medicine</p>
          <?php

            if(isset($_POST['add_button'])){
               $sell_date = $_POST['sell_date'];
               $quantity = $_POST['quantity'];
               $customer_mail = $_POST['customer_mail'];
               $discount = $_POST['discount'];

               $selectName = $_POST['name'];
               $stmnt = $connection-> prepare("SELECT * FROM inventory WHERE MEDICINE_NAME = ?");
               $stmnt->bind_param("s", $selectName);
               $stmnt->execute();
               $result = $stmnt->get_result();

               if($row = $result->fetch_assoc())
               {
                  $medicine_name =  $row['MEDICINE_NAME'];
                  $sell_price = $row['SELLING_PRICE'];
                  $unit_price = $row['UNIT_PRICE'];

                  $sup_total =  $quantity * $sell_price;

                  $discount = $_POST['discount'];
                  $toPay =  $sup_total - $discount;
           
                  $sql_insert = "INSERT INTO CURRENT_SALES(SELL_DATE, CUSTOMER_CONTACT, MEDICINE_NAME, QUANTITY, PURCHASE_PRICE, SELLING_PRICE, SUP_TOTAL, DISCOUNT, TOTAL_AMOUNT) VALUE('$sell_date', '$customer_mail', '$medicine_name', '$quantity','$unit_price ', '$sell_price', ' $sup_total', '$discount', '$toPay')";
                  $result = $connection -> query($sql_insert);

               }
            }
            
          ?>
          <table class='table' style="
            <?php 
               if(isset($_POST["sell_button"])){
                  echo $sell_sheet ? 'display:none;': ''; 
                  }
            ?>
          ">
            <thead>
               <tr>
                  <th>No</th>
                  <th>Date</th>
                  <th>Medicine Name</th>
                  <Th>Customer Contact</Th>    
                  <th>Selling Price </th>            
                  <th>Quantity </th>
                  <th>Sup-Total</th>
                  <th>Discount</th>
                  <th>Total</th>
                  <th>Action</th>
               </tr>
                
            </thead>
            <tbody >
              <?php 
                $get_data = "SELECT * FROM current_sales";
                $result = mysqli_query($connection, $get_data);
                
                while($row = mysqli_fetch_assoc($result)){
                  $id = $row['INVOICE_ID'];
                 
                  echo"
                     <tr class='row'>
                        <td id='rtd' style='text-align: center;'>{$row['INVOICE_ID']}</td>
                        <td id='rtd'>{$row['SELL_DATE']}</td>
                        <td id='rtd'>{$row['MEDICINE_NAME']}</td>
                        <td id='rtd'>{$row['CUSTOMER_CONTACT']}</td>
                        <td id='rtd'>{$row['SELLING_PRICE']}</td>
                        <td id='rtd'>{$row['QUANTITY']}</td>                     
                        <td id='rtd'>{$row['SUP_TOTAL']}</td>
                        <td id='rtd'>{$row['DISCOUNT']}</td>
                        <td id='rtd'>{$row['TOTAL_AMOUNT']}</td>
                        <td id='rtd'>  <a class='delete_btn' href='sales.php? del_id=".$id."'>Delete</a></td>
                     </tr>
                    
                    
                  "; 
                }
               $sup_total = mysqli_query($connection, "SELECT SUM(SUP_TOTAL) from current_sales");
                 while($row = mysqli_fetch_assoc($sup_total)){
                  echo"
                     <tr id='' style='height: 26px; border: none; border-top: 6px solid rgb(137, 137, 137);;'>
                        <td colspan='4' style='text-align:right;'>Sup-Total:</td>
                        <td id='outTotal'>$</td>
                        <td id='outTotal'>{$row['SUM(SUP_TOTAL)']}</td>
                        
                     </tr>";
                 }
                  $discount = mysqli_query($connection, "SELECT SUM(DISCOUNT) from current_sales");

               while($row = mysqli_fetch_assoc($discount)){
                    echo" <tr  style='height: 26px; border: none;'>
                     <td colspan='4' style='text-align:right; '>Discount:</td>
                     <td id='outTotal'>$</td>
                     <td id='outTotal'>{$row['SUM(DISCOUNT)']}</td>             
                  </tr>";
               }
               $total_amount = mysqli_query($connection, "SELECT SUM(TOTAL_AMOUNT) FROM current_sales");
               while($row = mysqli_fetch_assoc($total_amount)){
                  echo"<tr  style='height: 35px; border: none; background-color: rgb(175, 175, 255);'>
                     <tH colspan='4' style='text-align:right; '>TOTAL:</tH>
                     <tH id='outTotal'>$</th>
                     <th id='outTotal'>{$row['SUM(TOTAL_AMOUNT)']}</th>             
                  </tr>";
               }
                echo"
                  <tr style='height: 70px;'>
                     <th colspan='4' style='text-align: right;'><a class='cancel-button' href='sales.php? cancel_btn='cancel_deal''>Cancel</a></th>
                     <th>
                        <form  action='sales.php' method='post'>
                        <input style='width: 100px; height: 30px;' name='sell_button'  class='sell-button' type='submit' value='Sell'>
                        </form>
                     </th>
                 </tr>
               
                ";
                
/*
               $get_sell_price = "SELECT UNIT_PRICE FROM inventory
                                    WHERE MEDICINE_NAME = ''";
               $result = $connection -> query($get_sell_price);
               if($result -> num_rows > 0){
                  while($row = $result -> fetch_assoc()){
                     $row['UNIT_PRICE'];
                  }
                  
            
               }
            */

              ?>
            </tbody>
          </table>

      </div>           
   </div>          
    <div class="footer">
      <hp>@fayeqbahram - PHP Developer - 2025</hp>
   </div>
   <style>
      .output-form div{
         text-align: center;
         align-items: center;
         justify-content: center;
      }
   

   </style>
   
   <script>
       if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href)
         }

     const myForm = document.querySelector(".form");

     function hidForm(){
      myForm.style.display = "none";
       }

     function printDiv(){
      var divContents = document.getElementById("printArea").innerHTML;

         var printWindow = window.open('', '','height=600, width=800');
      //  printWindow.document.write('<html><head><title>Print</title></head><body>');
         printWindow.document.write(divContents);
      // printWindow.document.write('</body></html>');
         printWindow.document.close();
         printWindow.print();

      }

// gettin selling price while selecting medicine name from dropdown menue.

     

      function getPrice(productId){

         if(productId == ""){
             document.getElementById('sellingPrice').innerHTML = "";

             return;
         }

          //AJAX request

          var xhr = new XMLHttpRequest();
          xhr.open("GET", "sales.php?id=" + productId, true);
          
          xhr.onload = function(){
            if(this.status == 200){
               document.getElementById('sellingPrice').innerHTML = this.responseText;
            }
          };
          xhr.send();
        
      }



   </script>
   
</body>
</html>

<?php
   mysqli_close($connection);
   
?>