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


    if (isset($_POST['delete_button'])){
        $schedule_id =  $_POST['schedule_id'];
        $sql = "DELETE FROM schedule WHERE schedule_id='".$schedule_id."'";
         try{
            $result = mysqlexec($sql);

            if ($result) {

                echo '
                <script type="text/JavaScript">
                    document.getElementById("open-success-modal").click 
                </script>
            ';
                
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
                       

                       <div class="row m-3 p-2">
                            <div class="col text-center" style="justify-content: centers; margin-top:3rem;">
                                    <h1><u><em><strong> Schedule's List </strong></em> </u></h1>
                            </div>
                       </div>

                       

                        <div class="card mb-4">
                            <div class="card-header bg-secondary text-light">
                                <i class="fas fa-table me-1"></i>
                                DataTable Example
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Class Room Name</th>
                                            <th>Class Room Type</th>
                                            <th>Departement</th>
                                            <th>Assinged Teacher</th>
                                            <th>scheduled Time</th>
                                            <th>Weekday</th>
                                            <th>Action Update</th>
                                            <th>Action Update</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Class Room Name</th>
                                            <th>Class Room Type</th>
                                            <th>Departement</th>
                                            <th>Assinged Teacher</th>
                                            <th>scheduled Time</th>
                                            <th>Weekday</th>
                                            <th>Action Update</th>
                                            <th>Action Update</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>

                                    <?php 


                                            


                                            $sql = "SELECT * FROM schedule";

                                            try{
                                                $result_1 = mysqlexec($sql);

                                                if (mysqli_num_rows($result_1) > 0 ) {
                                                    $row_counter = 1;

                                                    foreach($result_1 as $values1){
                                                        $room_name = "";
                                                        $room_type = "";
                                                        $teacher_full_name = "";

                                                        $weekdays = explode('-',$values1['weekdays']);
                                                        $resolved_weekday = array();

                                                        foreach($weekdays as $day){

                                                            if ($day == 1 || $day == '1'){
                                                                array_push($resolved_weekday, "Monday");
                                                            }else if ($day == 2 || $day == '2'){
                                                                array_push($resolved_weekday, "Tuesday");
                                                            }else if ($day == 3 || $day == '3'){
                                                                array_push($resolved_weekday, "Wednesday");
                                                            }else if ($day == 4 || $day == '4'){
                                                                array_push($resolved_weekday, "Thursday");
                                                            }else if ($day == 5 || $day == '5') {
                                                                array_push($resolved_weekday, "Friday");
                                                            }else if ($day == 6 || $day == '6'){
                                                                array_push($resolved_weekday, "Saturday");
                                                            }

                                                        }


                                                        $room_id =  $values1['class_room_id'];
                                                        $class_room_sql = "SELECT * FROM class_room WHERE class_room_id='$room_id'";
                                                        $roomresult = mysqlexec($class_room_sql);
                                                        foreach($roomresult as $room_information){
                                                            $room_name = $room_information['special_room_name'];
                                                            $room_type = $room_information['room_type'];
                                                        }

                                                        $teacher_id = $values1['teacher_id'];
                                                        $teacher_sql = "SELECT * FROM user_account WHERE student_jd='$teacher_id'";
                                                        $teacher_result = mysqlexec($teacher_sql);
                                                        foreach($teacher_result as $teacher_info){
                                                           $teacher_full_name = $teacher_info['first name'].' '.$teacher_info['father name']; 
                                                        }


                                                        echo '
                                                            <tr>
                                                                <td>'.$room_name.'</td>
                                                                <td>'.$room_type.'</td>
                                                                <td>'.$values1['departement'].'</td>
                                                                <td>'.$teacher_full_name.'</td>
                                                                <td>'.$values1['time_from'].' to '.$values1['time_to'].'</td>
                                                                <td> <select class="form-control">';
                                                                foreach($resolved_weekday as $row){
                                                                    echo '<option>'.$row.' </option>';
                                                                }
                                                             echo ' </select>
                                                                </td>   
                                                                <td><a href="admin_schedule_update_page.php?schedule_id='.$values1['schedule_id'].'"> <button class="btn btn-success"> Update </button> </a></td>
                                                                <td> <form method="POST" action=""><input  name="schedule_id" type="hidden" value="'.$values1['schedule_id'].'"><input type="submit" class="btn btn-danger" name="delete_button" value="Delete"></form> </td>
                                                             </tr>';   

                                                    }

                                                }

                                            }catch(Exception $ex){

                                            }


                                            ?>
                                    </tbody>
                                </table>
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
