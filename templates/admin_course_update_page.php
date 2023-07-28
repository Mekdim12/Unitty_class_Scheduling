<?php session_start(); ?>
<?php require("../db_connection/db_conn.php"); ?>
<?php include("../includes/basic_functions.php");?> 

<?php

    if (isloggedin()) {
        //do nothing stay here
    } else {
        header("location:../login.php");
    }

    $id = $_GET['course_id'];
    $sqls = "SELECT * FROM course_information WHERE course_id  = $id";
    
    $result = mysqlexec($sqls);
    if (mysqli_num_rows($result) > 0) {
        if ($result) {
            $rows = mysqli_fetch_assoc($result);
        }else{
            header("Location: admin_course_management.php");
            exit();
        }
    }else{
        header("Location: admin_course_management.php");
        exit();
    }


    if (isset($_POST['course_update_submit'])) {

        $departement = $_POST['departement'];
        $course_name = $_POST['course_name'];
        $course_credit_hour = $_POST['course_credit_hour'];
        $course_description = $_POST['course_description']; 
        $sql = "UPDATE course_information SET departement='".$departement."' ,course_name='".$course_name."', course_description='".$course_description."',course_credit_hour='".$course_credit_hour."' WHERE course_id='".$id."'";
        try{
            $result = mysqlexec($sql);
            if ($result) {
             header('location: admin_course_management.php');
            } else {
                echo "Failed";
                // show the failed message holder modal 
            }
        }catch(Exception $ex){
            echo "Failed";
                // show the failed message holder modal
                echo $ex;
        }
        header("admin_course_update_page.php?course_id='.$id.' ");
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
        <title>Admin Course Information update</title>
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
                        <div class="row m-5">
                            <div class="col">
                                <a href="admin_course_management.php"> <button class="btn btn-secondary"> <- Back </button></a>
                            </div>
                        </div>
                        <div class="row mx-5">
                            <div class="col">
                                <form action="" method="post">

                                        <div class="form-group">
                                            <label for="departement">Choose Departement</label>
                                            <select id="inputState"  name="departement" class="form-control">
                                                    <?php 
                                                    if ($rows['departement'] == 'computer science'){
                                                            echo '<option value="computer science" selected>Computer Science</option>
                                                            <option value="Buisness and Adminstration">Buisness and Adminstration</option>
                                                            <option value="Accounting"> Accounting </option>';
                                                    }

                                                    if ($rows['departement'] == 'Buisness and Adminstration'){
                                                        echo '<option value="computer science" >Computer Science</option>
                                                        <option value="Buisness and Adminstration" selected>Buisness and Adminstration</option>
                                                        <option value="Accounting"> Accounting </option>';
                                                    }

                                                    
                                                    if ($rows['departement'] == 'Accounting'){
                                                        echo '<option value="computer science" >Computer Science</option>
                                                        <option value="Buisness and Adminstration">Buisness and Adminstration</option>
                                                        <option value="Accounting" selected> Accounting </option>';
                                                    }

                                            ?>
                                            </select>
                                        </div>
                                        <br>

                                        <div class="form-group">
                                            <label for="course_name">Course Name</label>
                                            <input type="text"  name="course_name" class="form-control" id="formGroupExampleInput" value="<?php echo $rows['course_name'] ?>">
                                        </div>
                                        <br>

                                        <div class="form-group">
                                            <label for="course_credit_hour">Credit Hour</label>
                                            <input type="number" max=35 min=1  name="course_credit_hour" class="form-control" id="formGroupExampleInput" value="<?php echo $rows['course_credit_hour'] ?>">
                                        </div>
                                        <br>

                                        <div class="form-group">
                                            <label for="course_description">Course Description</label>
                                            <textarea  name="course_description" id=""  class="form-control" id="exampleFormControlTextarea1" placeholder="Enter Course Description" rows="3" style="resize: none;"><?php echo $rows['course_description']  ?></textarea>
                                        </div>
                                        <br>


                                        <div class="modal-footer my-3" style="display: flex;justify-content: center;">
                                            <button type="submit" name="course_update_submit"  class="btn btn-lg btn-success">Update</button>
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
