<?php

session_start();

include('config.php'); 



if(isset($_POST['add'])){

    $entry = mysqli_real_escape_string($connection, $_POST['entry']);
    

    $query = "INSERT INTO diary (entry) 
                VALUES 
                ('$entry')";
    $query_run = mysqli_query($connection,$query);

    if($query_run)

    {

    $_SESSION['success'] = "Added Successfully";
    header('Location: index.php');

    }else{

    $_SESSION['failed'] = "Error Adding Data!";
    header('Location: index.php');
    }
}


//code for deleting customer data
if(isset($_POST['delete_btn'])){

    $rid = $_POST['delete_id'];
    

    $query = "DELETE FROM diary WHERE id ='$rid' LIMIT 1";


    $query_run = mysqli_query($connection,$query);

    if($query_run){
           
        $_SESSION['success'] = "Data Deleted Successfully";
        header("Location: index.php");

    }else{
        $_SESSION['failed'] = "Error Deleting Data";
        header("Location: index.php");
    }
}





//code for updating resident data
if(isset($_POST['update_bt'])){

    $id = $_POST['edit_id'];
    $entry = mysqli_real_escape_string($connection, $_POST['entry']);
    

        $query = "UPDATE diary SET entry='$entry' WHERE id ='$id' LIMIT 1";

        $query_run = mysqli_query($connection,$query);

        if($query_run)
        {
            $_SESSION['success'] = "Data Updated Successfully";
            header('Location: index.php');
        }
        else
        {
            $_SESSION['failed'] = "Error Updating Data";
            header('Location: index.php');

        }   
}



?>