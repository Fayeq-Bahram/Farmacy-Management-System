
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
   <link rel="stylesheet" type="text/css" href="../css/header-style.css">
   <title>Farmacy Management System</title>

</head>
<body>
   <div class="header">
       <div class="bottom-title-container">
         <div style="height: 60px;">
            <img  class="img" src="../icons/Home_24.png">
            <h1>Farmacy Management System</h1>
             <div id="menuBtn">
                   &#9776
            </div>
         </div>
      </div>

       <div class='nav-container' >
         <nav class="Nav-bar" id="navBar">
           <ul class="nav-links">
               <li ><a class="nav-link "  id="Link" href="Dashboard.php">Dashboard</a></li>
               <li><a class="nav-link"  href="create_option.php">Create Options</a></li>
               <li><a class="nav-link" href="inventory.php">Inventory</a></li>
               <li><a class="nav-link" href="sales.php? deleteRow='sales'">Sales</a></li>
               <li ><a class="nav-link" href="accounting.php">Accounting</a></li>
               <li id="manage_staff"><a class="nav-link"  id="link" href="manage_staff.php">Manage Staffs</a></li>
               <li><a class="nav-link " id="link" href="wellcome.php">Wellcome Page</a></li>
               <li id="logout"><a id="logoutBtn" href="index.php">Log out</a></li>
           </ul>
         </nav>
      </div>
   </div>
   <script src="../js/script.js"> </script>

</body>
</html>