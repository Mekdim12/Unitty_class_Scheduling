<?php session_start(); ?>
<?php require("../db_connection/db_conn.php"); ?>
<?php include("../includes/basic_functions.php");?> 


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Student Page</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="../styles/style-2.css" rel="stylesheet" />
        <link rel="stylesheet" href="../styles/style-1.css" />
    </head>

    <body class="sb-nav-fixed">

      



        
        <div class="TopHolder">
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
            <br>
            <div class="topGreetingHolder">
                <div class="row">
                    <div class="col greetingTextHolder_" >
                        <div class="greetingTextHolder" style="margin-left: 25px;">
                            <img src="../assets/unitty_university.png" class="img-fluid" style="width: 150px; height: 150px;" alt="">
                           <h2>Welcome 
                                <span style="color: #FFB52E;" id="to_be_animated">

                                    <?php
                                        $username = $_SESSION['user_name'];
                                        $sql = "SELECT * FROM user_account WHERE user_name='$username'";
                                        $result_1 = mysqlexec($sql);
                                        $row = mysqli_fetch_assoc($result_1);

                                        $full_name = $row['first name'].' '.$row['father name'];

                                        echo $full_name;

                                    ?>
                        
                        
                                </span>
                            </h2> 
                            <br/>
                            <p>
                                <q>
                                The rich fruit of spontaneity grows in the garden that is well tended by the discipline of schedule. - John Piper
                                </q>
                            </p>
                           <a href="login.php">  <button class="btn btn-lg btn-light mt-5 gettingstarted" style="width: 200px; border: 2px solid #FFB52E;">Go to Schedule</button> </a>

                        </div>
                    </div>

                    <div class="col rightSideTextHolder_">
                        <div class="rightSideTextHolder">
                        </div>
                    </div>
                </div>
            </div>

        </div>


        
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../scripts/script-2.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="../scripts/script-3.js"></script>
    </body>
</html>
