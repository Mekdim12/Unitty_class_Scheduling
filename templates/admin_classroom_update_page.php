<?php session_start(); ?>
<?php require("../db_connection/db_conn.php"); ?>
<?php include("../includes/basic_functions.php");?> 

<?php

    if (isloggedin()) {
        //do nothing stay here
    } else {
        header("location:../login.php");
    }

    $id = $_GET['room_id'];
    $sqls = "SELECT * FROM class_room WHERE class_room_id  = $id";
    
    $result = mysqlexec($sqls);
    if (mysqli_num_rows($result) > 0) {
        if ($result) {
            $rows = mysqli_fetch_assoc($result);
        }else{
            header("Location: admin_classroom_management.php");
            exit();
        }
    }else{
        header("Location: admin_classroom_management.php");
        exit();
    }


    if (isset($_POST['room_update_submit'])) {

        $room_name = $_POST['room_name'];
        $room_Capacity = $_POST['room_Capacity'];
        $room_type = $_POST['room_type'];
        $room_section = $_POST['room_section']; 

        $sql = "UPDATE class_room SET capacity='".$room_Capacity."' ,room_type='".$room_type."', section='".$room_section."',special_room_name='".$room_name."' WHERE class_room_id='".$id."'";
        try{
            $result = mysqlexec($sql);
            if ($result) {
             header('location: admin_classroom_management.php');
            } else {
                echo "Failed";
                // show the failed message holder modal 
            }
        }catch(Exception $ex){
            echo "Failed";
                // show the failed message holder modal
                echo $ex;
        }
        header("admin_classroom_management.php?room_id='.$id.' ");
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
        <title>Admin class Room Information update</title>
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
                                <a href="admin_classroom_management.php"> <button class="btn btn-secondary"> <- Back </button></a>
                            </div>
                        </div>
                        <div class="row mx-5">
                            <div class="col">
                                <form action="" method="post">

                                        <div class="form-group">
                                            <label for="room_name">Room Special Name(if any)</label>
                                            <input type="text"  name="room_name" class="form-control" id="formGroupExampleInput" value="<?php echo $rows['special_room_name'] ?>">
                                        </div>
                                        <br>

                                        <div class="form-group">
                                            <label for="room_Capacity">Room Capacity</label>
                                            <input type="number" min=1 max=1000  name="room_Capacity" class="form-control" id="formGroupExampleInput" value="<?php echo $rows['capacity'] ?>">
                                        </div>
                                        <br>

                                        <div class="form-group">
                                            <label for="room_type">Room Type</label>
                                            <input type="text"  name="room_type" class="form-control" id="formGroupExampleInput" value="<?php echo $rows['room_type'] ?>">
                                        </div>
                                        <br>


                                        <div class="form-group">
                                            <label for="room_section">Room Label Section</label>
                                            <input type="text"  name="room_section" class="form-control" id="formGroupExampleInput"  value="<?php echo $rows['section'] ?>">
                                        </div>
                                        <br>


                                        <div class="modal-footer my-3" style="display: flex;justify-content: center;">
                                            <button type="submit" name="room_update_submit"  class="btn btn-lg btn-success">Update</button>
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
