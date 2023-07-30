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
   
    $schedule_id = $_GET['schedule_id'];
    $sqls = "SELECT * FROM schedule WHERE schedule_id  = $schedule_id";
    
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

    $departement  = $rows['departement'];

    if (isset($_POST['schedule_update_submit'])) {

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


        $sql = "UPDATE schedule SET time_from='".$time_from."' ,time_to='".$time_to."' ,semester='".$semister."' ,teacher_id='".$teacher."' ,weekdays='".$weekday_resolved."' ,class_room_id='".$room."' ,course_id='".$course."', departement='".$departement."',title='".$title."' WHERE schedule_id='".$schedule_id."'";
        try{
            $result = mysqlexec($sql);
            if ($result) {
             header('location: admin_schedule_mgt.php');
            } else {
                echo "Failed";
                // show the failed message holder modal 
            }
        }catch(Exception $ex){
            echo "Failed";
                // show the failed message holder modal
                echo $ex;
        }
        header("admin_schedule_update_page.php?schedule_id='.$schedule_id.' ");
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
                                   <a href="admin_schedule_mgt.php"><button style="width: 200px; height: 50px;" class="btn btn-lg btn-secondary">Back</button> </a> 
                            </div>
                            <div class="col-8" style="justify-content: start; margin-top:1rem;">
                                    <h1><b>Update Schedule </b> </h1>
                            </div>
                       </div>

                       <form  class="mt-5" action="" method="post">
                            <div class="form-group mx-5 px-5">

                                <label for="title"><b>Title for schedule</b></label>
                                <input class="form-control form-control-lg" name="title" type="text" value="<?php echo $rows['title']; ?>" >

                                <br>
                                <label for="weekday"><b>Select Weekdays</b></label>        
                                <select class="form-select" name="weekday[]" multiple aria-label="Select Weekdays">
                                    <?php
                                            $weekdays = $rows['weekdays'];
                                            $weekdays =explode('-', $weekdays);
                                        
                                            $monday = false;
                                            $tuseday = false;
                                            $wednesday = false;
                                            $thursday = false;
                                            $friday = false;
                                            $saturday = false;

                                            foreach($weekdays as $day){
                                                echo $day;
                                                if( $day == 1 ||  $day == '1'){
                                                    $monday = true;
                                                }else if( $day == 2 ||  $day == '2'){
                                                    $tuseday = true;
                                                }else if( $day == 3 ||  $day == '3'){
                                                    $wednesday = true;
                                                }else if( $day == 4 ||  $day == '4'){
                                                    $thursday = true;
                                                }else if( $day == 5 ||  $day == '5'){
                                                    $friday = true;
                                                }else if( $day == 6 ||  $day == '6'){
                                                    $saturday = true;
                                                }


                                            }
                                            if ($monday){
                                                echo '<option value="1" selected>Monday</option>';
                                            }else{
                                                echo '<option value="1" >Monday</option>';
                                            }
                                            if ($tuseday){
                                                echo '<option value="2" selected>Tuesday</option>';
                                            }else{
                                                echo '<option value="2" >Tuesday</option>';
                                            }
                                            if ($wednesday){
                                                echo '<option value="3" selected>Wednesday</option>';
                                            }else{
                                                echo '<option value="3">Wednesday</option>';
                                            }
                                            if ($thursday){
                                                echo '<option value="4" selected>Thursday</option>';
                                            }else{
                                                echo '<option value="4">Thursday</option>';
                                            }
                                            if ($friday){
                                                    echo '<option value="5" selected>Friday</option>';
                                            }else{
                                                echo '<option value="5">Friday</option>';
                                            }
                                            if ($saturday){
                                                echo '<option value="6" selected>Saturday</option>';
                                            }else{
                                                echo '<option value="6">Saturday</option>';
                                            }

                                    ?>
                                        
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
                                                        if ($values['course_id'] == $rows['course_id']){
                                                            echo " <option value='".$values['course_id']."' selected>".$values['course_name']."</option>";
                                                        }else{
                                                            echo " <option value='".$values['course_id']."'>".$values['course_name']."</option>";
                                                        }
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
                                                        if ($values['class_room_id'] == $rows['class_room_id']){
                                                            echo " <option value='".$values['class_room_id']."' selected>".$values['special_room_name']."</option>";
                                                        }else{
                                                            echo " <option value='".$values['class_room_id']."'>".$values['special_room_name']."</option>";
                                                        }
                                                        
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
                                                            if($values_['student_jd'] == $rows['teacher_id']){
                                                                echo " <option value='".$values_['student_jd']."'>".$full_name."</option>";
                                                            }else{
                                                                echo " <option value='".$values_['student_jd']."'>".$full_name."</option>";
                                                            }
                                                            
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
                                                <?php  
                                                    if($rows['semester']  == 1 || $rows['semester']  == '1'){
                                                        echo '<option value="1" selected>Semister-1</option>';
                                                    }else{
                                                        echo '<option value="1">Semister-1</option>';
                                                    }

                                                    if($rows['semester']  == 2 || $rows['semester']  == '2'){
                                                        echo '<option value="2" selected>Semister-2</option>';
                                                    }else{
                                                        echo '<option value="2">Semister-2</option>';
                                                    }
                                                ?>
                                              
                                                
                                            </select>
                                        </div>

                                        <div class="cs-form col-md-4">
                                            <label for="time_from"  class="form-label">Time From</label>
                                            <input type="time" name="time_from" class="form-control" value="<?php echo $rows['time_from'] ?>" />
                                        </div> 

                                        <div class="cs-form col-md-4">
                                            <label for="time_to"  class="form-label">Time To</label>
                                            <input type="time" name="time_to" class="form-control" value="<?php echo $rows['time_to'] ?>" />
                                        </div>       
                                </div>
                            
                            </div>
                            
                            <?php
                            
                                if ($GLOBAL_FLAG == 1){
                                    echo "<div class='row'>
                                            <div class='col'  style='display: flex; justify-content: center; margin-top:3rem; '>
                                                <button name='schedule_update_submit' type='submit' class='btn btn-lg btn-success' style='width: 250px; height: 50px;'>Update</button>
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
