<?php session_start(); ?>
<?php require_once("../db_connection/db_conn.php"); ?>
<?php include_once("../includes/basic_functions.php");?> 

<?php

    if (isloggedin()) {
        //do nothing stay here
    } else {
        header("location:../login.php");
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
        <title>Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="../styles/style-2.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
       
            <?php include('admin_header.php') ?>

        <div id="layoutSidenav">
            
            <?php include('admin_side_bar.php') ?>

            <div id="layoutSidenav_content">
                <main>

                    <div class="container-fluid px-4">
                        <h1 class="mt-3">Admin Dashboard</h1>
                        <div class="row">
                            <div class="col" style="display: flex; justify-content: center;">
                                <img  class="img-fluid" style="width: 200px;" src="../assets/unitty_university.png" alt="">
                            </div>
                        </div>
                        
                        <div class="row my-3" style="margin-top: 100px !important;">
                            <div class="col-xl-4 col-md-6"  >
                                <div class="card text-white mb-4" id="custome_box_shadow">
                                    <div class="card-header bg-secondary "> <strong>Total Student</strong></div>
                                    <div class="card-body text-primary fw-bold fs-1" style="display:flex; justify-content: center;" >
                                        <?php
                                            $sql = "SELECT  * FROM student_information";
                                            $result_1 = mysqlexec($sql);
                                            if ($result_1){
                                                echo mysqli_num_rows($result_1) ;
                                            }else{
                                                echo 0;
                                            }
                                        ?>
                                </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6">
                                <div class="card text-white mb-4" id="custome_box_shadow">
                                    <div class="card-header bg-secondary "> <strong>Total Course</strong></div>
                                    <div class="card-body text-danger fw-bold fs-1" style="display:flex; justify-content: center;" >
                                        <?php
                                            $sql = "SELECT  * FROM course_information";
                                            $result_1 = mysqlexec($sql);
                                            if ($result_1){
                                                echo mysqli_num_rows($result_1) ;
                                            }else{
                                                echo 0;
                                            }
                                        ?>    
                                
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6">
                                <div class="card  text-white mb-4" id="custome_box_shadow">
                                    <div class="card-header bg-secondary"> <strong>Total Class Rooms </strong></div>
                                    <div class="card-body text-success fw-bold fs-1" style="display:flex; justify-content: center;" >
                                        <?php
                                            $sql = "SELECT  * FROM class_room";
                                            $result_1 = mysqlexec($sql);
                                            if ($result_1){
                                                echo mysqli_num_rows($result_1) ;
                                            }else{
                                                echo 0;
                                            }
                                        ?> 
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row my-5" style="margin-top: 150px !important;">
                            <div class="col-xl-6 col-md-6">
                                <div class="card  text-white mb-4" id="custome_box_shadow">
                                    <div class="card-header bg-secondary">Total Teacher</div>
                                    <div class="card-body text-danger fw-bold fs-1" style="display:flex; justify-content: center;" >
                                        <?php
                                            $sql = "SELECT  * FROM teacher_information";
                                            $result_1 = mysqlexec($sql);
                                            if ($result_1){
                                                echo mysqli_num_rows($result_1) ;
                                            }else{
                                                echo 0;
                                            }
                                        ?> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-6">
                                <div class="card  text-white mb-4" id="custome_box_shadow">
                                    <div class="card-header bg-secondary">Total Schedules</div>
                                    <div class="card-body text-success fw-bold fs-1" style="display:flex; justify-content: center;" >
                                        <?php
                                            $sql = "SELECT  * FROM schedule";
                                            $result_1 = mysqlexec($sql);
                                            if ($result_1){
                                                echo mysqli_num_rows($result_1) ;
                                            }else{
                                                echo 0;
                                            }
                                        ?>
                                    </div>
                                </div>
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
