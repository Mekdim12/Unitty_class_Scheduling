<?php session_start(); ?>
<?php require("../db_connection/db_conn.php"); ?>
<?php include("../includes/basic_functions.php");?> 

<?php

    if (isloggedin()) {
        //do nothing stay here
    } else {
        header("location:../login.php");
    }
   
    if (isset($_POST['delete_button'])){
        $student_id =  $_POST['student_id'];
        $sql = "DELETE FROM user_account WHERE student_jd='".$student_id."'";
        $sql2 = "DELETE FROM student_information WHERE student_id='".$student_id."'";
        try{
            $result = mysqlexec($sql);

            if ($result) {

              $result2 = mysqlexec($sql2);

              if($result2){
                    echo '
                    <script type="text/JavaScript">
                        document.getElementById("open-success-modal").click 
                    </script>
                ';
            
              }
                
            } else {
               // show the failed message holder modal 
            }
        }catch(Exception $ex){
            // show the failed message holder modal
        }
        
        

    }
    if (isset($_POST['student_info_submit'])) {

        $departement = $_POST['departement'];
        $schoold_id = $_POST['schoold_id'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name']; 
        $email = $_POST['email']; 
        $phonenumber = $_POST['phonenumber']; 
        $username = $_POST['username']; 
        $password_1 = $_POST['password_1']; 
        $password_2 = $_POST['password_2']; 

        if ($password_1 == $password_2){
        $sql = "INSERT INTO `user_account`(`first name`, `father name`, `phone_number`, `email`, `password`, `student_jd`, `account_type`, `user_name`) VALUES ('$first_name', '$last_name', '$phonenumber', '$email', '$password_1', '$schoold_id', 'Student', '$username') ";
        $sql2 = "INSERT INTO `student_information`(`enrolled_departement`, `student_id`) VALUES ('$departement','$schoold_id')";
        try{
            $result = mysqlexec($sql);
            
            if ($result) {
              $result2 = mysqlexec($sql2);
              if ($result2) {
                  echo '
                  <script type="text/JavaScript">
                      document.getElementById("seome").click()
                  </script>
              ';
              }    
            } else {
                // show the failed message holder modal 
            }
        }catch(Exception $ex){
                // show the failed message holder modal
        }
    }
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
        <title>Admin Student Management Page</title>
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
                        <!-- Button trigger modal -->
                        <div class="row my-4">
                            <div class="col" style="display: flex; justify-content: end;">
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#register_student_modal">
                                        + Register New Student
                                </button>
                            </div>
                        </div>

                        <!-- Insert Course -->
                            <div class="modal fade " id="register_student_modal"  data-bs-backdrop="static" data-bs-keyboard="false"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Register Student Information </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="post">
                                            
                                            <div class="form-group">
                                                <label for="departement">Choose Departement</label>
                                                <select id="inputState"  name="departement" class="form-control">
                                                    <option value="computer science" selected>Computer Science</option>
                                                    <option value="Buisness and Adminstration">Buisness and Adminstration</option>
                                                    <option value="Accounting"> Accounting </option>
                                                </select>
                                            </div>
                                            <br>

                                            <div class="form-group">
                                                <label for="schoold_id">Student school id number</label>
                                                <input type="text"  name="schoold_id" class="form-control" id="formGroupExampleInput" placeholder="Schoold Id">
                                            </div>
                                            <br>

                                            <div class="form-group">
                                                <label for="first_name">Student First Name</label>
                                                <input type="text"  name="first_name" class="form-control" id="formGroupExampleInput" placeholder="First Name">
                                            </div>
                                            <br>

                                            <div class="form-group">
                                                <label for="last_name">Student Last Name</label>
                                                <input type="text"  name="last_name" class="form-control" id="formGroupExampleInput" placeholder="Last Name">
                                            </div>
                                            <br>

                                            <div class="form-group">
                                                <label for="email">Student Email</label>
                                                <input type="email"  name="email" class="form-control" id="formGroupExampleInput" placeholder="student@example.com">
                                            </div>
                                            <br>


                                            <div class="form-group">
                                                <label for="phonenumber">Student Phone Number</label>
                                                <input type="tel"  name="phonenumber" class="form-control" id="formGroupExampleInput" placeholder="+2519XXXXXXXX">
                                            </div>
                                            <br>


                                            <div class="form-group">
                                                <label for="username">Student user name</label>
                                                <input type="text"  name="username" class="form-control" id="formGroupExampleInput" placeholder="User Name">
                                            </div>
                                            <br>

                                            <div class="form-group">
                                                <label for="password_1">Password</label>
                                                <input type="password"  name="password_1" class="form-control" id="formGroupExampleInput" placeholder="password">
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <label for="password_2">Password Again</label>
                                                <input type="password"  name="password_2" class="form-control" id="formGroupExampleInput" placeholder="password">
                                            </div>
                                            <br>

                                            


                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" id="form-close-btn" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" name="student_info_submit"  class="btn btn-success">Save</button>
                                            </div>

                                    </form>
                                </div>
                                
                                </div>
                            </div>
                            </div>



                        <table class="table table-striped table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Full Name</th>
                                    <th scope="col">Departement</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone Number</th>
                                    <th scope="col">Update Action</th>
                                    <th scope="col">Delete Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                    $account_type = "Student";
                                    $mysql = "SELECT * FROM user_account WHERE account_type = '$account_type' ";
                                   
                                    
                                    try{
                                        
                                        $result_1 = mysqlexec($mysql);
                                
                                        if (mysqli_num_rows($result_1) > 0 ) {

                                            if ($result_1) {
                                               $row_counter = 1;

                                                foreach($result_1 as $values1){
                                            
                                                  $student_id = $values1['student_jd'];
                                                  $full_name =$values1['first name']." ".$values1['father name'];
                                                  $email = $values1['email'];
                                                  $phonenumber = $values1['phone_number'];
                                                  
                                                
                                                  $sql22 =  "SELECT * FROM student_information WHERE student_id='$student_id'";
                                                  $result_2 = mysqlexec($sql22);
                                                  

                                                  if(mysqli_num_rows($result_2) > 0){
                                                    if ($result_2){
                                                      foreach($result_2 as $values_){
                                                    
                                                        echo '
                                                            <tr> 
                                                                <td><b>'.(string)$row_counter.'</b></td>
                                                                <td>'.$full_name.' </td>
                                                                <td>'.$values_['enrolled_departement'].' </td>
                                                                <td>'.$email.'</td>
                                                                <td>'.$phonenumber.'</td>
                                                                <td>
                                                                    <a href="admin_student_update_page.php?student_id='.$values_["student_id"].' ">
                                                                        <button class="btn btn-success"> Update </button> 
                                                                    </a>
                                                                </td>
                                                                <td> <form method="POST" action=""><input  name="student_id" type="hidden" value="'.$values_['student_id'].'"><input type="submit" class="btn btn-danger" name="delete_button" value="Delete"></form> </td>
                                                            </tr>
                                                            
                                                            ';
                                                        $row_counter+=1;
  
                                                      }
                                                    }
                                                    
                                                  }

                                                }
                                            } else {
                                                echo '
                                                <tr>
                                                    <td colspan="7" style="text-align:center !important; height:80px !important; vertical-align: middle; !important;  font-size:21px; color:#FFB52E"> <b >There is no course information registred </b>  </td> 
                                                </tr>';
                                            }
                                        }else{
                                            echo '
                                            <tr>
                                                <td colspan="7" style="text-align:center !important; height:80px !important; vertical-align: middle; !important;  font-size:21px; color:#FFB52E"> <b >There is no course information registred </b>  </td> 
                                            </tr>';
                                        }
                                    }catch(Exception $ex){
                                      echo $ex;
                                        echo '
                                            <tr>
                                                <td colspan="7" style="text-align:center !important; height:80px !important; vertical-align: middle; !important;  font-size:21px; color:#FFB52E"> <b >There is no course information registred </b>  </td> 
                                            </tr>';
                                    }
                                ?>
                            </tbody>
                        </table>
                        

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
