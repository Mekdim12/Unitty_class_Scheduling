<?php session_start(); ?>
<?php require_once("db_connection/db_conn.php"); ?>
<?php include_once("includes/basic_functions.php");?> 
<?php 
    if(isset($_SESSION['user_name']) && !empty($_SESSION['user_name'])) {
        $username = $_SESSION['user_name'];
        $sql = "SELECT * FROM user_account WHERE user_name = '$username' ";
        $result = mysqlexec($sql);
        $row = mysqli_fetch_assoc($result);
        $acc_type = $row['account_type'];
        if ($acc_type == "Admin"){
            header('Location: templates/admin_index.php');
        }else if($acc_type == "Student"){
            header('Location: templates/student_index.php');
        }


     }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        $sql = "SELECT * FROM user_account WHERE user_name = '$username' AND password = '$password' ";
        $result = mysqlexec($sql);

        if (mysqli_num_rows($result) > 0) {
            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $_SESSION['user_name'] = $row['user_name'];
                
                $acc_type = $row['account_type'];
                if ($acc_type == "Admin"){
                    header('Location: templates/admin_index.php');
                }else if($acc_type == "Student"){
                    header('Location: templates/student_index.php');
                }
     
                
            } else {
                echo "<br> <h2> Nottt Working</h2>";
                
                echo mysqli_error($conn);
            }
        }
     }

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Login</title>
    
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
        <link href="https://fonts.googleapis.com/css2?family=Ubuntu+Condensed&amp;display=swap" rel="stylesheet">
        
        <link
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
          crossorigin="anonymous"
        />
        <link rel="stylesheet" href="styles/style-1.css" />
      </head>
<body style="overflow-y: hidden;" >
    
<section id="forbackground">



    <div class="container-fluid ">
        <div class="row">
            <div class="col p-2" style="display:flex;justify-content: center;align-items: center;border: 1px solid black;">
                <img  src="assets/unitty_university.png" style="width: 80px;height: 80px; opacity: 0.8;" alt=""> 
              </div>
    
        </div>
    </div>



    <div class="container" >
        <div class="row">
            <div class="col" style="display: flex;justify-content: center;">

                <form action="" method="post" class="formHolder" enctype="multipart/form-data">
                        <div style="display: flex;justify-content: center; ">
                            <h6 style="margin-top: 50px;">To continue, log in to Unitty Scheduling Application.</h6>     
                        </div>
                        <Button class="btn btn-lg w-100 btn-light" style="border-radius: 25px; margin-top: 10px;border: 1px solid black;"><img src="https://img.icons8.com/fluency/24/null/google-logo.png"/> Continue With Google</Button>
            
                        <div class="my-3 px-2" style="opacity: 0.5;">
                            <span  class="formmiddleLiner py-5 w-100">Or</span>
                        </div>
                       

                        <label for="username" class="form-label">User Name</label>
                        <input type="text"  name="username" class="form-control">
                       

                        <label for="password" class="form-label mt-4">Password</label>
                        <input type="password"  name="password" class="form-control">


                        <div class="row mt-5">
                            <div class="col" style="display: flex;align-items: center; justify-content: flex-start;">
                                <div class="">
                                    <a href="#" class="fw-bold text-dark">Forgot your password ?</a>
                                </div>
                            </div>

                            <div class="col" style="display: flex;align-items: center; justify-content: flex-end;">
                                <div class="logingBtnHolder" >
                                    <button type="submit" style="border-radius:25px;  background-color: #1ed760;border: none; width: 120px; height: 48px;">Login</button>
                                </div>
                            </div>
                        </div>

                        
                        <div class="linerForm mt-5">
                            <hr class="w-100 ">
                        </div>

                        
                       <a href="index.php">
                         <button type="button" class="btn btn-lg w-100 btn-light" style="border-radius: 25px; margin-top: 10px;border: 1px solid black;">
                            <img src="https://img.icons8.com/material-outlined/24/null/return.png"/> Back To Home
                        </button>
                        </a> 
            
                        
                 </form>
            
                


            </div>
        </div>
    </div>



 </section>


    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
      integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
      integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
      crossorigin="anonymous"
    ></script>

</body>
</html>