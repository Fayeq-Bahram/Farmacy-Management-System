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
   <link rel="stylesheet" type="text/css" href="../css/style-dashboard.css">

   <title>dashboard</title>
</head>
<body>
   <div class="container">
      <div class="dashboard-content">
         <div class="content-title">
            <p>Inventory Overview</p>
         </div>
         <div class="dashboard-body">
            <div class="db-box">
                <div>
                   <img class="img-size" src="../photoes/medecine.png">
                   <?php
                     $sql="SELECT * FROM med_presentation";
                     $res = $connection -> query($sql);
                     $count_medicine = mysqli_num_rows($res);
                     echo"<h2>$count_medicine</h2>";

                   ?>
                </div>
                <div> <h5>Medecine Type</h5></div>
            </div>
            <div class="db-box">
                 <div>
                   <img class="img-size" src="../photoes/cart.png">
               
                   <h2>
                     <?php 
                        $date = date('Y-m-d');

                        $sql = "SELECT SUM(PURCHASE_PAID) FROM inventory WHERE PURCHASE_DATE = '$date'";
                        $result = $connection -> query($sql);
                       
                        if($result -> num_rows > 0){
                           $row = $result -> fetch_assoc();
                           
                           echo "$". $row['SUM(PURCHASE_PAID)'];
                        }
                     ?>
                   </H2>
                </div>
                <div> <h5>Today's Purchase Amount</h5></div>
            </div>
            <div class="db-box">
             <div>
                <img class="img-size" src="../photoes/dollor.png">
                   <h2>
                      <?php 
                        $date = date('Y-m-d');

                        $sql = "SELECT SUM(PURCHASE_DUE) FROM inventory WHERE PURCHASE_DATE = '$date'";
                        $result = $connection -> query($sql);
                       
                        if($result -> num_rows > 0){
                           $row = $result -> fetch_assoc();
                           
                           echo "$". $row['SUM(PURCHASE_DUE)'];
                        }
                     ?>
                   </h2>
                </div>
                <div> <h5>Today's Purchase Due</h5></div>
            </div>
            <div class="db-box">
                <div>
                   <img class="img-size" src="../photoes/sales.png">
                   <h2>
                     <?php 
                        $sql = "SELECT SUM(TOTAL_AMOUNT) FROM sales_statement WHERE
                                                          MONTH(SELL_DATE) = MONTH(CURRENT_DATE())
                                                          AND YEAR(SELL_DATE) = YEAR(CURRENT_DATE())";
                        $result = $connection -> query($sql);
                       
                        if($result -> num_rows > 0){
                           $row = $result -> fetch_assoc();
                           echo "$".$row['SUM(TOTAL_AMOUNT)'];
                        }
                     ?>
                   </h2>
                </div>
                <div> <h5>Sales of the Month</h5></div>
            </div>
            <div class="db-box">
                <div>
                   <img class="img-size" src="../photoes/todays_sales.png">
                   <h2>
                        <?php 

                        $sql = "SELECT SUM(TOTAL_AMOUNT) FROM sales_statement WHERE
                                                          SELL_DATE = '$date'";

                        $result = $connection -> query($sql);
                       
                        if($result -> num_rows > 0){
                           $row = $result -> fetch_assoc();
                           echo "$". $row['SUM(TOTAL_AMOUNT)'];
                        }
                     ?>
                   </h2>
                </div>
                <div> <h5>Today's Sale</h5></div>
            </div>
            <div class="db-box">
             <div>
                   <img class="img-size" src="../photoes/expired.png">
                   <h2>
                     <?php
                        $expired_products = "SELECT COUNT(*) AS expired_count FROM inventory where EXPIRY_DATE < CURDATE()";
                        $result = $connection -> query($expired_products);

                        if($result -> num_rows > 0){
                           while($row = $result -> fetch_assoc()){
                              echo $row['expired_count'];
                           }
                        }

                     ?>
                   </h2>
                </div>
                <div> <h5>Expired Products</h5></div>
            </div>
            <div class="db-box">
                  <div>
                   <img class="img-size" src="../photoes/generic.png">
                  <?php
 //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++                  
                     $sql = "SELECT * FROM generic_name";
                     $result = $connection -> query($sql);
                     $rows_count = mysqli_num_rows($result);
                     echo" <h2>{$rows_count}</h2>";
                   ?>
                </div>
                <div> <h5>Medicine Generic</h5></div>
            </div>
            <div class="db-box">
              <div>
               <img class="img-size" src="../photoes/medics.png">
                   <?php
                     $sql = "SELECT * FROM inventory";
                     $query = $connection -> query($sql);
                     $countRow = mysqli_num_rows($query);
                     echo"<h2>$countRow</h2>";
                   ?>
               </div>
               <div> <h5>Medicines</h5></div>
            </div>
            <div class="db-box">
               <div>
                  <img class="img-size" src="../photoes/staffs.png">
                  <?php
                     $sql = "SELECT * FROM staff";
                     $result = $connection -> query($sql);
                     $rowCount = mysqli_num_rows($result);
                     echo"<h2>$rowCount</h2>";
                  ?>
               </div>
               <div> <h5>Staffs</h5></div>
            </div>
         </div>
      </div>
   </div>
    <div class="footer">
      <hp>@fayeqbahram - PHP Developer - 2025</hp>
   </div>
   

</body>
</html>
<?php mysqli_close($connection); ?>