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


        <br>



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
                                           
                                        </tr>
                                    </tfoot>
                                    <tbody>



                                    <?php 

                                            $username_from_session = $_SESSION['user_name'];
                                            $dep = "SELECT * FROM user_account WHERE user_name='$username_from_session'";
                                            $res_dep = mysqlexec($dep);
                                            $student_id = mysqli_fetch_assoc($res_dep);
                                            $student_id = $student_id['student_jd'];


                                            $student_info = "SELECT * FROM student_information WHERE student_id='$student_id'";
                                            $res_dep_student = mysqlexec($student_info);
                                            $departement = mysqli_fetch_assoc($res_dep_student);
                                            $departement_student_id = $departement['enrolled_departement'];

                                            


                                            $sql = "SELECT * FROM schedule WHERE departement='$departement_student_id'" ;

                                            try{
                                                $result_1 = mysqlexec($sql);

                                                if (mysqli_num_rows($result_1) > 0 ) {
                                                    $row_counter = 1;

                                                    foreach($result_1 as $values1){
                                                        $room_name = "";
                                                        $room_type = "";
                                                        $teacher_full_name = "";

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

                                                        echo '
                                                            <tr>
                                                                <td>'.$room_name.'</td>
                                                                <td>'.$room_type.'</td>
                                                                <td>'.$values1['departement'].'</td>
                                                                <td>'.$teacher_full_name.'</td>
                                                                <td>'.$values1['time_from'].' to '.$values1['time_to'].'</td>
                                                                <td>
                                                                <select class="form-control">';
                                                      
                                                                        foreach($resolved_weekday as $row){
                                                                                echo '<option>'.$row.' </option>';
                                                                        }
                                                                    
                                                        echo '  </select>
                                                                </td>
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



        
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../scripts/script-2.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="../scripts/script-3.js"></script>
    </body>
</html>
