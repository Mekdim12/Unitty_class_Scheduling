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
        $course_id =  $_POST['class_room_id'];
        $sql = "DELETE FROM class_room WHERE class_room_id='".$course_id."'";
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
    if (isset($_POST['room_infor_submit'])) {

        $room_name = $_POST['room_name'];
        $room_Capacity = $_POST['room_Capacity'];
        $room_type = $_POST['room_type'];
        $room_section = $_POST['room_section']; 
        $sql = "INSERT INTO `class_room`( `capacity`, `room_type`, `section`, `special_room_name`) VALUES ('$room_Capacity','$room_type','$room_section','$room_name')";
        try{
            $result = mysqlexec($sql);
            if ($result) {
                echo '
                        <script type="text/JavaScript">
                            document.getElementById("seome").click()
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
        <title>Admin Class Room Manage page</title>
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
                                        + Add New Class Room
                                </button>
                            </div>
                        </div>

                        <!-- Insert Course -->
                            <div class="modal fade " id="register_student_modal"  data-bs-backdrop="static" data-bs-keyboard="false"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Register New Class Room Information </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="post">
                                        

                                            <div class="form-group">
                                                <label for="room_name">Room Special Name(if any)</label>
                                                <input type="text"  name="room_name" class="form-control" id="formGroupExampleInput" placeholder="White house">
                                            </div>
                                            <br>

                                            <div class="form-group">
                                                <label for="room_Capacity">Room Capacity</label>
                                                <input type="number" min=1 max=1000  name="room_Capacity" class="form-control" id="formGroupExampleInput" placeholder="50">
                                            </div>
                                            <br>

                                            <div class="form-group">
                                                <label for="room_type">Room Type</label>
                                                <input type="text"  name="room_type" class="form-control" id="formGroupExampleInput" placeholder="Lecture Hall">
                                            </div>
                                            <br>

                                            <div class="form-group">
                                                <label for="room_section">Room Label Section</label>
                                                <input type="text"  name="room_section" class="form-control" id="formGroupExampleInput" placeholder="B-37 A">
                                            </div>
                                            <br>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" id="form-close-btn" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" name="room_infor_submit"  class="btn btn-success">Save</button>
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
                                    <th scope="col">Room Name</th>
                                    <th scope="col">Room Capacity</th>
                                    <th scope="col">Room Type</th>
                                    <th scope="col">Section</th>
                                    <th scope="col">Update Action</th>
                                    <th scope="col">Delete Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $sql = "select * from class_room";
                                    try{
                                        $result = mysqlexec($sql);
                                        if (mysqli_num_rows($result) > 0) {
                                            if ($result) {
                                                $row_counter = 1;

                                                foreach($result as $values){
                                                    
                                                    echo '
                                                        <tr> 
                                                            <td><b>'.(string)$row_counter.'</b></td>
                                                            <td>'.$values["special_room_name"].' </td>
                                                            <td>'.$values["capacity"].'</td>
                                                            <td>'.$values["room_type"].'</td>
                                                            <td>'.$values["section"].'</td>
                                                            <td>
                                                                <a href="admin_classroom_update_page.php?room_id='.$values["class_room_id"].' ">
                                                                    <button class="btn btn-success"> Update </button> 
                                                                </a>
                                                            </td>
                                                            <td> <form method="POST" action=""><input  name="class_room_id" type="hidden" value="'.$values['class_room_id'].'"><input type="submit" class="btn btn-danger" name="delete_button" value="Delete"></form> </td>
                                                        </tr>
                                                        
                                                        ';
                                                        $row_counter+=1;
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
