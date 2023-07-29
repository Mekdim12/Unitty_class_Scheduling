<?php session_start(); ?>
<?php require("../db_connection/db_conn.php"); ?>
<?php include("../includes/basic_functions.php");?> 

<?php

    if (isloggedin()) {
        //do nothing stay here
    } else {
        header("location:../login.php");
    }

    $id = $_GET['empl_id'];
    $sqls = "SELECT * FROM user_account WHERE student_jd  ='$id' ";
    $sqls2 = "SELECT * FROM teacher_information WHERE teacher_id  = '$id' ";
    $result1 = mysqlexec($sqls);
    $result2 = mysqlexec($sqls2);
    if ( mysqli_num_rows($result1) > 0 and  mysqli_num_rows($result2) > 0) {
        if ($result1) {
            $rows = mysqli_fetch_assoc($result1);
            if($result2){
                $rows2 = mysqli_fetch_assoc($result2);
            }
        }else{
            header("Location: admin_teacher_management.php");
            exit();
        }
    }else{
        header("Location: admin_teacher_management.php");
        exit();
    }


    if (isset($_POST['teacher_update_submit'])) {
       
        $departement = $_POST['departement'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name']; 
        $email = $_POST['email']; 
        $phonenumber = $_POST['phonenumber']; 
        $username = $_POST['username']; 
        $password_1 = $_POST['password_1']; 
        $password_2 = $_POST['password_2']; 


        if ($password_1 == $password_2){
            $sql_update= "UPDATE user_account SET `first name`='".$first_name."',`father name`='".$last_name."',phone_number='".$phonenumber."',email='".$email."',password='".$password_1."' ,user_name='".$username."' WHERE student_jd='".$id."'";
            $sql_update2 = "UPDATE teacher_information SET department='".$departement."' WHERE teacher_id='".$id."'";
           
            try{

                $result = mysqlexec($sql_update);
                if ($result) {
                    $result2 = mysqlexec($sql_update2);
                    if($result2){
                         header('location: admin_teacher_management.php');
                    }
                   
                } else {
                    // show the failed message holder modal 
                }
            }catch(Exception $ex){
                    // show the failed message holder modal
                    echo $ex;
            }
        }

        header("admin_teacher_update_page.php?empl_id='.$id.' ");
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
        <title>Admin Teacher Information update</title>
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
                                <a href="admin_teacher_management.php"> <button class="btn btn-secondary"> <- Back </button></a>
                            </div>
                        </div>
                        <div class="row mx-5">
                            <div class="col">
                                <form action="" method="post">

                                        <div class="form-group">
                                            <label for="departement">Choose Departement</label>
                                            <select id="inputState"  name="departement" class="form-control">
                                                    <?php 
                                                    if ($rows2['department'] == 'computer science'){
                                                            echo '<option value="computer science" selected>Computer Science</option>
                                                            <option value="Buisness and Adminstration">Buisness and Adminstration</option>
                                                            <option value="Accounting"> Accounting </option>';
                                                    }

                                                    if ($rows2['department'] == 'Buisness and Adminstration'){
                                                        echo '<option value="computer science" >Computer Science</option>
                                                        <option value="Buisness and Adminstration" selected>Buisness and Adminstration</option>
                                                        <option value="Accounting"> Accounting </option>';
                                                    }

                                                    
                                                    if ($rows2['department'] == 'Accounting'){
                                                        echo '<option value="computer science" >Computer Science</option>
                                                        <option value="Buisness and Adminstration">Buisness and Adminstration</option>
                                                        <option value="Accounting" selected> Accounting </option>';
                                                    }

                                            ?>
                                            </select>
                                        </div>
                                        <br>

                                        
                                        <div class="form-group">
                                                <label for="first_name">First Name</label>
                                                <input type="text"  name="first_name" class="form-control" id="formGroupExampleInput" value="<?php echo $rows['first name'] ?>">
                                        </div>
                                        <br>

                                        <div class="form-group">
                                                <label for="last_name">Last Name</label>
                                                <input type="text"  name="last_name" class="form-control" id="formGroupExampleInput" value="<?php echo $rows['father name'] ?>">
                                        </div>
                                        <br>

                                        <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email"  name="email" class="form-control" id="formGroupExampleInput" value="<?php echo $rows['email'] ?>">
                                        </div>
                                        <br>

                                        <div class="form-group">
                                            <label for="phonenumber">Phone Number</label>
                                            <input type="tel"  name="phonenumber" class="form-control" id="formGroupExampleInput" value="<?php echo $rows['phone_number'] ?>">
                                        </div>
                                        <br>

                                        <div class="form-group">
                                                <label for="username">user name</label>
                                                <input type="text"  name="username" class="form-control" id="formGroupExampleInput" value="<?php echo $rows['user_name'] ?>">
                                        </div>
                                        <br>

                                        <div class="form-group">
                                                <label for="password_1">Password</label>
                                                <input type="password"  name="password_1" class="form-control" id="formGroupExampleInput" value="<?php echo $rows['password'] ?>">
                                        </div>
                                        <br>

                                        <div class="form-group">
                                                <label for="password_2">Password Again</label>
                                                <input type="password"  name="password_2" class="form-control" id="formGroupExampleInput" placeholder="password">
                                        </div>
                                        <br>
                                        

                                      

                                        <div class="modal-footer my-3" style="display: flex;justify-content: center;">
                                            <button type="submit" name="teacher_update_submit"  class="btn btn-lg btn-success">Update</button>
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
