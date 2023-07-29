<?php session_start(); ?>
<?php require("../db_connection/db_conn.php"); ?>
<?php include("../includes/basic_functions.php");?> 

<?php

    $GLOBAL_FLAG = true;

    if (isloggedin()) {
        //do nothing stay here
    } else {
        header("location:../login.php");
    }
   
    $departement = $_GET['dep'];
    if (!($departement >= 1 && $departement <= 3)){
        header("Location: admin_schedule_insert_1.php");
        exit();
    } 


    if ($departement == 1){
        $departement = "computer science";
    }else if($departement == 2){
        $departement = "Buisness and Adminstration";
    }
    else if($departement == 3){
        $departement = "Accounting";
    }
    
    if (isset($_POST['schedule_save'])){
        $weekday =  $_POST['weekday'];
        $weekday_resolved = "";
        foreach($weekday as $selected_days){
            $weekday_resolved =  $selected_days."-".$weekday_resolved;
        }


        $title = $_POST['title'];
        $course = $_POST['course'];
        $room = $_POST['room'];
        $teacher = $_POST['teacher'];
        $semister = $_POST['semister'];
        $time_from = $_POST['time_from'];
        $time_to = $_POST['time_to'];

        
        $sql = "INSERT INTO `schedule`(`class_room_id`, `course_id`, `departement`, `title`, `semester`, `teacher_id`, `weekdays`, `time_from`, `time_to`) VALUES ('$room','$course','$departement','$title','$semister','$teacher','$weekday_resolved','$time_from','$time_to')";
        try{
            $result = mysqlexec($sql);
            if ($result) {
                 header("Location: admin_schedule_insert_1.php");
            } else {
                // show the failed message holder modal 
            }
        }catch(Exception $ex){
                // show the failed message holder modal
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
                       

                       <div class="row m-2 p-2">
                            <div class="col-4" style="display: flex; justify-content: start;">
                                   <a href="admin_schedule_insert_1.php"><button style="width: 200px; height: 50px;" class="btn btn-lg btn-secondary">Back</button> </a> 
                            </div>
                            <div class="col-8" style="justify-content: start; margin-top:1rem;">
                                    <h1><b>Fill the form for Scheduling</b> </h1>
                            </div>
                       </div>

                       <form  class="mt-5" action="" method="post">
                            <div class="form-group mx-5 px-5">

                                <label for="title"><b>Title for schedule</b></label>
                                <input class="form-control form-control-lg" name="title" type="text" placeholder="schedule title" >

                                <br>
                                <label for="weekday"><b>Select Weekdays</b></label>        
                                <select class="form-select" name="weekday[]" multiple aria-label="Select Weekdays">
                                        <option value="1" selected>Monday</option>
                                        <option value="2">Tuesday</option>
                                        <option value="3">Wednesday</option>
                                        <option value="4">Thursday</option>
                                        <option value="5">Friday</option>
                                        <option value="6">Saturday</option>
                                 </select>

                                 <br>
                                 
                                 <label for="course"><b>Choose Course From the list</b></label>
                                 <select class="form-select form-select-lg " name="course" aria-label="choose course">
                                    
                                     <?php
                                            $sql = "SELECT * FROM course_information WHERE departement='$departement'";
                                            $result = mysqlexec($sql);
                                            if (mysqli_num_rows($result) > 0) {
                                                if ($result) {
                                                    foreach($result as $values){
                                                        echo " <option value='".$values['course_id']."'>".$values['course_name']."</option>";
                                                    }
                                                }else{
                                                echo " <option disabled>There is No Course Registred for this department</option>";
                                                $GLOBAL_FLAG = false;
                                                }
                                            }else{
                                                echo " <option disabled>There is No Course Registred for this department</option>";
                                                $GLOBAL_FLAG = false;
                                            }
                                    
                                    ?>
                                </select>

                                <br>
                                <label for="room"><b>Choose Class Room From the list</b></label>
                                 <select class="form-select form-select-lg " name="room" aria-label="choose rooms">
                                    
                                     <?php
                                            $sql = "SELECT * FROM class_room";
                                            $result = mysqlexec($sql);
                                            if (mysqli_num_rows($result) > 0) {
                                                if ($result) {
                                                    foreach($result as $values){
                                                        echo " <option value='".$values['class_room_id']."'>".$values['special_room_name']."</option>";
                                                    }
                                                }else{
                                                echo " <option disabled>There is No Room Information Registred </option>";
                                                $GLOBAL_FLAG = false;
                                                }
                                            }else{
                                                echo " <option disabled>There is No Room Information Registred </option>";
                                                $GLOBAL_FLAG = false;
                                            }
                                    
                                    ?>
                                </select>


                                <br>
                                <label for="teacher"><b>Choose Teacher From The List</b></label>
                                 <select class="form-select form-select-lg " name="teacher" aria-label="choose teachers">
                                    
                                     <?php

                                        $sql =  "SELECT * FROM teacher_information WHERE department='$departement'";
                                       
                                        try{
                                            $result_1 = mysqlexec($sql);
                                            if (mysqli_num_rows($result_1) > 0 ) {
                                               
                                                foreach($result_1 as $values1){
                                                    $account_type = "Teacher";
                                                    $teacher_id = $values1['teacher_id'];
                                                    $mysql = "SELECT * FROM user_account WHERE account_type = '$account_type' AND student_jd = '$teacher_id' ";

                                                    $result_2 = mysqlexec($mysql);
                                                    if(mysqli_num_rows($result_2) > 0){

                                                        foreach($result_2 as $values_){
                                                            $full_name = $values_['first name'].' '.$values_['father name'];
                                                            echo " <option value='".$values_['student_jd']."'>".$full_name."</option>";
                                                        }
                                                      

                                                    }else{
                                                        echo " <option disabled>There is No Teacher Information Registred </option>";
                                                        $GLOBAL_FLAG = false;
                             
                                                    }

                                                  
                                                }

                                            }else{
                                                echo " <option disabled>There is No Teacher Information Registred </option>";
                                                $GLOBAL_FLAG = false;
                                         
                                             }
                                            
                                        }catch(Exception $ex){
                                            echo " <option disabled>There is No Teacher Information Registred </option>";
                                            $GLOBAL_FLAG = false;
                                         
                                        }

                                       
                                    
                                    ?>
                                </select>

                                <br>

                            <div class="form-group">
                                <div class="row g-3">
                                        <div class="col-md-4">
                                            <label for="semister" class="form-label">Semister</label>
                                            <select name="semister" class="form-select" aria-label="Default select example">
                                                <option value="1" selected>Semister-1</option>
                                                <option value="2">Semister-2</option>
                                            </select>
                                        </div>

                                        <div class="cs-form col-md-4">
                                            <label for="time_from"  class="form-label">Time From</label>
                                            <input type="time" name="time_from" class="form-control" value="10:05 AM" />
                                        </div> 

                                        <div class="cs-form col-md-4">
                                            <label for="time_to"  class="form-label">Time To</label>
                                            <input type="time" name="time_to" class="form-control" value="10:05 AM" />
                                        </div>       
                                </div>
                            
                            </div>
                            
                            <?php
                            
                                if ($GLOBAL_FLAG == 1){
                                    echo "<div class='row'>
                                            <div class='col'  style='display: flex; justify-content: center; margin-top:3rem; '>
                                                <button name='schedule_save' type='submit' class='btn btn-lg btn-success' style='width: 250px; height: 50px;'>Save</button>
                                            </div>
                                        </div>";
                                        
                                }else{
                                    echo "<div class='row'>
                                        <div class='col'  style='display: flex; justify-content: center; margin-top:3rem;'>
                                            <h5 style='color:red;'> <em> Make sure you have suffcient information before making an schedule </em></h5>
                                        </div>
                                    </div>";
                                }
                            ?>
                            

                       </form>
                        

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
