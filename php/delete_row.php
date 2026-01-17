<?php
   include("connection.php");
   
   if(isset($_GET['deleteId']))
      {
         $del_id = $_GET['deleteId'];
         $del_row = "DELETE FROM med_presentation WHERE Serial_no = $del_id";
         $del_result = mysqli_query($connection, $del_row);
       
      }

  // ++++++++++++++++++++ Generic name page ++++++++++++++++++
    if(isset($_GET['rowId']))
      {
         $id = $_GET['rowId'];
         $delete_row = "DELETE FROM generic_name WHERE ID = $id ";
         $result = mysqli_query($connection, $delete_row);
      }

      if(isset($_GET['row_Id']))
         {
            $id = $_GET['row_Id'];
            $deleteRow = "DELETE FROM create_medicine WHERE ID = $id ";
            $result = mysqli_query($connection, $deleteRow);
         }
   
      if(isset($_GET['ID'])){
         $delete_row = $_GET['ID'];
         echo $delete_row;
         $del_sql = "DELETE FROM supplier WHERE ID = $delete_row";
         $res = mysqli_query($connection, $del_sql);

      }

      if(isset($_GET['delId'])){
         $inv_id = $_GET['delId'];
         $sql_del = "DELETE FROM inventory WHERE ID = $inv_id";
         $result = mysqli_query($connection, $sql_del);
      }

      // Deleting row from sales page.
      
       if(isset($_GET['del_id'])){
         $del_id = $_GET['del_id'];
        
         $sql_del = "DELETE FROM current_sales WHERE INVOICE_ID = '$del_id'";
         $result = mysqli_query($connection, $sql_del);

      }

      // Deleting staff from staff page

      if(isset($_GET['delete'])){
         $del_ID = $_GET['delete'];

         $del_staff = "DELETE FROM staff WHERE ID = '$del_ID'";
         $res = mysqli_query($connection, $del_staff);

      }










?>