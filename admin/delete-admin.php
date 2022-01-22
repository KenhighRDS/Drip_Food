<?php
        //include constants.php file here
        include('../config/constants.php');

        //1. get the ID of admin to be deleted
        $id = $_GET['id'];

        //2. create SQL query to delete Admin
        $sql = "DELETE FROM tbl_admin WHERE id=$id";

        //execute the query
        $res = mysqli_query($conn, $sql);

        //check whether the query executed succesfully or not
        if($res==true)
        {
            //query executed succesfully and admin deleted
            //echo "admin deleted";
            //create session variable to display message
            $_SESSION['delete'] ="<div class='success'>Admin deleted Successfully.</div>";
            //Redirect to manage Admin Page
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
        else
        {
            //failed to delete admin
            //echo "failed to delete admin";

            $_SESSION['delete'] ="<div class='error'>Failed to Delete Admin. Try again later.</div>";
            header('location:'.SITEURL.'admin/manage-admin.php');
        }

        //3. redirect to manage admin page with message (succes/error)

?>