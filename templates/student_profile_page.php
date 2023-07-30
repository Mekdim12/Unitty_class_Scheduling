<?php session_start(); ?>
<?php require("../db_connection/db_conn.php"); ?>
<?php include("../includes/basic_functions.php");?> 

<?php

    if (!isloggedin()) {
        header("location:../login.php");
    } 

    $username = $_SESSION['user_name'];
    $sql = "SELECT * FROM user_account WHERE user_name = '$username' ";


    $result1 = mysqlexec($sql);
    if ($result1 && mysqli_num_rows($result1) > 0){
        $rows = mysqli_fetch_assoc($result1);
    }else{
         header("Location: student_index.php");
         exit();
    }
   


    if (isset($_POST['student_update_submit'])) {
       
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name']; 
        $email = $_POST['email']; 
        $phonenumber = $_POST['phonenumber']; 
        $username_new = $_POST['username']; 
        $password_1 = $_POST['password_1']; 
        $password_2 = $_POST['password_2']; 


        if ($password_1 == $password_2){
            $sql_update= "UPDATE user_account SET `first name`='".$first_name."',`father name`='".$last_name."',phone_number='".$phonenumber."',email='".$email."',password='".$password_1."',user_name='".$username_new."' WHERE user_name='".$username."'";
            try{

                $result = mysqlexec($sql_update);
                if ($result) {
                    header("Location: student_profile_page.php");
                } else {
                    // show the failed message holder modal 
                }
            }catch(Exception $ex){
                    // show the failed message holder modal
                    echo $ex;
            }
        }

        header("Location: student_profile_page.php");
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
        <title> Student Information update</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="../styles/style-2.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../styles/style-1.css" />
    </head>
    <body class="sb-nav-fixed">
    <div class="row">
        <div class="col">
        <nav class="navbar navbar-expand-lg stroke fixed-top navbar-light bg-light">
                    <a class="navbar-brand" href="#"></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                        <ul class="navbar-nav">
                            <li class="nav-item active">
                                <a class="nav-link" href="student_index.php">Home</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="student_table_schedule.php">Table Schedule</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="student_calander_schedule.php">Calander Schedule</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="student_profile_page.php">Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../logout.php">Logout</a>
                            </li>

                        </ul>
                    </div>
                </nav>
        </div>
    </div>

    <div class="container px-4 my-5" style="margin-top: 150px !important;"> 
                        <div class="row m-5">
                            <div class="col" style=" display: flex; justify-content: center;">
                                    <h2><b> Profile Page </b> </h2>
                            </div>
                        </div>
                        <div class="row mx-5">
                            <div class="col">
                                <form action="" method="post">

                                        <div class="row">
                                            <div class="col">  
                                                <div class="form-group">
                                                        <label for="first_name"><strong>  First Name </strong></label>
                                                        <input type="text"  name="first_name" class="form-control" id="formGroupExampleInput" value="<?php echo $rows['first name'] ?>">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="last_name"><strong>Last Name</strong></label>
                                                    <input type="text"  name="last_name" class="form-control" id="formGroupExampleInput" value="<?php echo $rows['father name'] ?>">
                                                </div>
                                            </div>
                                        </div>
                                       
                                        <br>

                                        

                                        <div class="form-group">
                                                <label for="email"><strong> Email </strong> </label>
                                                <input type="email"  name="email" class="form-control" id="formGroupExampleInput" value="<?php echo $rows['email'] ?>">
                                        </div>
                                        <br>

                                        <div class="form-group">
                                            <label for="phonenumber"> <strong> Phone Number </strong> </label>
                                            <input type="tel"  name="phonenumber" class="form-control" id="formGroupExampleInput" value="<?php echo $rows['phone_number'] ?>">
                                        </div>
                                        <br>
                                        <br>

                                        <div class="form-group">
                                                <label for="username"><strong> user name <span style="color: dodgerblue;">Credential</span> </strong> </label>
                                                <input type="text"  name="username" class="form-control" id="formGroupExampleInput" value="<?php echo $rows['user_name'] ?>">
                                        </div>
                                        <br>

                                        <div class="form-group">
                                                <label for="password_1"><strong> Password <span style="color: dodgerblue;">Credential</span> </strong> </label>
                                                <input type="password"  name="password_1" class="form-control" id="formGroupExampleInput" value="<?php echo $rows['password'] ?>">
                                        </div>
                                        <br>

                                        <div class="form-group">
                                                <label for="password_2"><strong> Password Again <span style="color: dodgerblue;">Credential</span> </strong> </label>
                                                <input type="password"  name="password_2" class="form-control" id="formGroupExampleInput" placeholder="password">
                                        </div>
                                        <br>
                                        

                                      

                                        <div class="modal-footer my-3" style="display: flex;justify-content: center;">
                                            <button type="submit" name="student_update_submit"  class="btn btn-lg btn-success" style="width: 250px; margin-top: 30px;">Update</button>
                                        </div>

                                </form>
                            </div>
                        </div>

                    </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../scripts/script-2.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="../scripts/script-3.js"></script>
    </body>
</html>
