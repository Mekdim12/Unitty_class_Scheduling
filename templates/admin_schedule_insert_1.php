<?php session_start(); ?>
<?php require("../db_connection/db_conn.php"); ?>
<?php include("../includes/basic_functions.php");?> 

<?php

    if (isloggedin()) {
        //do nothing stay here
    } else {
        header("location:../login.php");
    }
   
    if (isset($_POST['departement_choose'])){
        $departement_option =  $_POST['departement'];

        header("Location: admin_schedule_insert_main.php?dep=$departement_option");  

    }
    
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Admin Teacher Management Page</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="../styles/style-2.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
       
            <?php include('admin_header.php') ?>

        <div id="layoutSidenav">
            
            <?php include('admin_side_bar2.php') ?>

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4"> 
                       

                       <div class="row m-5 p-2">
                            <div class="col text-center" style="justify-content: centers; margin-top:3rem;">
                                    <h1><b>Choose Departement For Scheduling</b> </h1>
                            </div>
                       </div>
                       <div class="row mt-2 mx-5 px-5">
                            <div class="col">
                                <form action="" method="post">
                                         <div class="form-group">
                                                <label for="departement"><b>Choose Departement</b></label>
                                                <select id="inputState"  name="departement" class="form-control form-select-lg">
                                                    <option value="1" selected>Computer Science</option>
                                                    <option value="2">Buisness and Adminstration</option>
                                                    <option value="3"> Accounting </option>
                                                </select>
                                            </div>

                                            <div class="row">
                                                <div class="col"  style="display: flex; justify-content: center; margin-top:3rem;">
                                                    <button name="departement_choose" type="submit" class="btn btn-lg btn-success">GO</button>
                                                </div>
                                            </div>
                                </form>
                            </div>
                       </div>
                        

                    </div>
                </main>
            </div>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../scripts/script-2.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="../scripts/script-3.js"></script>
    </body>
</html>
