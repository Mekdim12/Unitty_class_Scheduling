<?php session_start(); ?>
<?php require_once("../db_connection/db_conn.php"); ?>
<?php include_once("../includes/basic_functions.php");?> 

<?php

    if (isloggedin()) {
        //do nothing stay here
    } else {
        header("location:../login.php");
    }

    $id = $_GET['course_id'];
    $sql = "SELECT * FROM course_information WHERE course_id  = $id";
    $result = mysqlexec($sql);
    if (mysqli_num_rows($result) > 0) {
        if ($result) {
            $row = mysqli_fetch_assoc($result);
        }else{
            header("Location: admin_course_management.php");
            exit();
        }
    }else{
        header("Location: admin_course_management.php");
        exit();
    }


    if (isset($_POST['course_update_submit'])) {

        $departement = $_POST['departement'];
        $course_name = $_POST['course_name'];
        $course_credit_hour = $_POST['course_credit_hour'];
        $course_description = $_POST['course_description']; 
        $sql = "UPDATE course_information SET departement='".$departement."' ,course_name='".$course_name."', course_description='".$course_description."',course_credit_hour='".$course_credit_hour."' WHERE course_id='".$id."'";
        try{
            $result = mysqlexec($sql);
            if ($result) {
             header('location: admin_course_management.php');
            } else {
                echo "Failed";
                // show the failed message holder modal 
            }
        }catch(Exception $ex){
            echo "Failed";
                // show the failed message holder modal
                echo $ex;
        }
        header("admin_course_update_page.php?course_id='.$id.' ");
    }



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Information update</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

</head>
<body>



<a href="admin_course_management.php"> <button class="btn btn-primary"> Back </button></a>
<br>
    <form action="" method="post">

            <label for="departement">Choose Departement</label>
            <select name="departement" id="">
                <?php 
                if ($row['departement'] == 'computer science'){
                        echo '<option value="computer science" selected>Computer Science</option>
                        <option value="Buisness and Adminstration">Buisness and Adminstration</option>
                        <option value="Accounting"> Accounting </option>';
                }

                if ($row['departement'] == 'Buisness and Adminstration'){
                    echo '<option value="computer science" >Computer Science</option>
                    <option value="Buisness and Adminstration" selected>Buisness and Adminstration</option>
                    <option value="Accounting"> Accounting </option>';
                }

                
                if ($row['departement'] == 'Accounting'){
                    echo '<option value="computer science" >Computer Science</option>
                    <option value="Buisness and Adminstration">Buisness and Adminstration</option>
                    <option value="Accounting" selected> Accounting </option>';
                }


                ?>
            
            </select>
            <br>

            <label for="course_name">Course Name</label>
            <input type="text" name="course_name" value="<?php echo $row['course_name'] ?>">
            <br>

            <label for="course_credit_hour">Credit Hour</label>
            <input type="number" max=35 min=1 name="course_credit_hour" value="<?php echo $row['course_credit_hour'] ?>">
            <br>

            <label for="course_description">Course Description</label>
            <textarea name="course_description" id="" cols="30" rows="10"  style="resize: none;" ><?php echo $row['course_description']  ?></textarea>
            <br>

            <div class="modal-footer">
                <button type="submit" name="course_update_submit"  class="btn btn-lg btn-success">Update</button>
            </div>

    </form>

    

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>

</body>
</html>