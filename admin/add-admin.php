<?php include("partials/menu.php"); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br/><br/>


                    <?php
                        if(isset($_SESSION['add'])) //cheking wheter the session is set of not
                        {
                            echo $_SESSION['add'];    //displaying session message if set
                            unset($_SESSION['add']);   //remeving session message
                        }
                    ?>


        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full Name</td>
                    <td><input type="text" name="full_name" placeholder="enter your name"> </td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" placeholder="Your username">
                    </td>
                </tr>

                <tr>
                    <td>Password: </td>
                    <td>
                        <input type="password" name="password" placeholder="Your Password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
    </div>
</div>

<?php include("partials/footer.php");   ?>


<?php
    //Process the value from form and save it in database

    //Check whether the submit button is clicked or not

    if(isset($_POST['submit']))
    {
        //button clicked
        //echo "Button Clicked";

        //1. get the data from form
        $full_name = mysqli_real_escape_string($conn, $_POST["full_name"]);
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, md5($_POST['password']));//md5 pou kripte password la

        //2. SQL Query to save the data into database
        $sql = "INSERT INTO tbl_admin SET
            full_name='$full_name',
            username='$username',
            password='$password'
        ";
        
        //3. Executing Query and saving data into database
        $res = mysqli_query($conn, $sql) or die(mysql_error());

        //4. Check wheter the (query is executed) data is inserted or not and display appropriate message
        if($res==TRUE)
        {
            //data inserted
            //echo "Data inserted";
            //create a session variable to display message
            $_SESSION['add'] ="<div class='success'>Admin added Succesfully</div>";
            //redirect page to manage admin
            header("location:".SITEURL.'admin/manage-admin.php');
        }
        else
        {
            //Failed to insert data
            //echo "Faile to insert data";
                        //create a session variable to display message
                        $_SESSION['add'] = "<div class='error'>Failed to add admin</div>";
                        //redirect page to manage admin
                        header("location:".SITEURL.'admin/add-admin.php');
        }
    }
?>