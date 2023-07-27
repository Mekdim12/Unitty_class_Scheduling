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
        $course_id =  $_POST['course_id'];
        $sql = "DELETE FROM course_information WHERE course_id='".$course_id."'";
        // $sql = "DELETE FROM employee WHERE userid='" . $_GET["userid"] . "'";
        try{
            $result = mysqlexec($sql);
            echo $result;
            if ($result) {
                echo '
                        <script type="text/JavaScript">
                            document.getElementById("form-close-btn").click()
                            document.getElementById("open-success-modal").click 
                        </script>
                    ';
            } else {
                echo "**********************************?";
                // show the failed message holder modal 
            }
        }catch(Exception $ex){
            echo $ex;
            echo ">>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>";
                // show the failed message holder modal
        }
        
        

    }
    if (isset($_POST['course_submit'])) {

        $departement = $_POST['departement'];
        $course_name = $_POST['course_name'];
        $course_credit_hour = $_POST['course_credit_hour'];
        $course_description = $_POST['course_description']; 
        
        $sql = "INSERT INTO `course_information`(`departement`, `course_name`, `course_description`, `course_credit_hour`) VALUES ('$departement','$course_name','$course_description','$course_credit_hour')";
        try{
            $result = mysqlexec($sql);
            if ($result) {
                echo '
                        <script type="text/JavaScript">
                            document.getElementById("form-close-btn").click()
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>


<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#register_student_modal">
Add New Course
</button>

<!-- Insert Course -->
<div class="modal fade " id="register_student_modal"  data-bs-backdrop="static" data-bs-keyboard="false"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Register New Course Information </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="post">

                <label for="departement">Choose Departement</label>
                <select name="departement" id="">
                    <option value="computer science" selected>Computer Science</option>
                    <option value="Buisness and Adminstration">Buisness and Adminstration</option>
                    <option value="Accounting"> Accounting </option>
                </select>
                <br>

                <label for="course_name">Course Name</label>
                <input type="text" name="course_name">
                <br>

                <label for="course_credit_hour">Credit Hour</label>
                <input type="number" name="course_credit_hour">
                <br>

                <label for="course_description">Course Description</label>
                <textarea name="course_description" id="" cols="30" rows="10" placeholder="Enter Course Description"  style="resize: none;"></textarea>
                <br>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="form-close-btn" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="course_submit"  class="btn btn-success">Save</button>
                </div>

        </form>
      </div>
      
    </div>
  </div>
</div>





    <form action="" method="post">
        <table class="table table-striped table-hover"">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Course Name</th>
            <th scope="col">Departement</th>
            <th scope="col">Credit Hour</th>
            <th scope="col">Update Action</th>
            <th scope="col">Delete Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $sql = "select * from course_information";
                try{
                    $result = mysqlexec($sql);
                    if (mysqli_num_rows($result) > 0) {

                        if ($result) {
                            $row_counter = 1;

                            foreach($result as $values){
                                
                                echo '
                                    <tr> 
                                        <td>'.(string)$row_counter.'</td>
                                        <td>'.$values["course_name"].' </td>
                                        <td>'.$values["departement"].'</td>
                                        <td>'.$values["course_credit_hour"].'</td>
                                        <td>
                                            <a href="admin_course_update_page.php?course_id='.$values["course_id"].' ">
                                                <button class="btn btn-primary"> Update </button> 
                                            </a>
                                        </td>
                                        <input type="hidden" name="to_be_delete_course_id" value="'.$values['course_id'].'">
                                        <td> <form method="POST" action=""><input  name="course_id" type="hidden" value="'.$values['course_id'].'"><input type="submit" name="delete_button" value="Delete"></form> </td>
                                    </tr>
                                    
                                    ';
                                    $row_counter+=1;
                            }
                        } else {
                            // <td><a href="admin_course_management.php?to_be_delete_course_id='.$values['course_id'].'" ><button  name="delete_button" class="btn btn-danger" > Delete </button> </a></td>
                                    
                            echo ` 
                            <tr>
                                <b>There is no course information registred </b> 
                            </tr>`;
                        }
                    }else{
                        echo ` 
                            <tr>
                                <b>There is no course information registred </b> 
                            </tr>`;
                    }
                }catch(Exception $ex){
                        echo ` 
                        <tr>
                            <b>There is no course information registred </b> 
                        </tr>`;
                }
            ?>
        </tbody>
        </table>
    </form>
<script src="https://code.jquery.com/jquery-3.7.0.slim.js" integrity="sha256-7GO+jepT9gJe9LB4XFf8snVOjX3iYNb0FHYr5LI1N5c=" crossorigin="anonymous"></script>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
</body>
</html>