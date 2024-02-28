<!Doctype html>
<html lang = "en">
    <head>
        <meta charset = "UTF-8">
        <title id ="page-title-id">Register</title>
        <meta name = "viewport" content = "width=device-width,initial-scale=1">
        <link rel = "stylesheet" href = "../components/form-block/form-block.css">
        <link rel = "stylesheet" href = "../components/header/header.css">
        <script src = "../index.js"></script>
    </head>

    <body>
        <header>
                    <?php
                        include "../components/header/header.php";
                        CVHeader();
                        
                    ?>
        </header>
        <form action = "register.php" method = "post">
            <section class = "form-container">
                <section class = "form-title">Register for an account</section>
                <section class = "form-content">
                    <input name = "first_name" type = "text" placeholder = "Name"/>
                    <input name = "last_name" type = "text" placeholder = "Surname"/>
                    <input name = "email_address" type = "text" placeholder = "Email address"/>
                    <input name = "password" type = "password" placeholder = "Password"/>
                    <input name = "confirm_password" type = "password" placeholder = "Confirm password"/>
                    <input class = "submit-button" name="submit" type = "submit" value = "Register"/>
                    <section class = "link" onclick = "navigateToPage('sign-in.php')">I already have an account</section>
                </section>
            </section>
        </form>
      
    </body>
</html>

<?php
      session_start(); 
      $error = "";
      if (isset($_POST['submit'])) 
      {
            // get the registration details
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $email_address = $_POST['email_address'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];

            // check if all registration details have been entered
            if($first_name == "" || $last_name == "" || $email_address == "" || $password == "" || $confirm_password == ""){
                $error = "There are fields that are empty";
            }
            else{
                if($password !== $confirm_password){
                    $error = "Password does not match confirm passwword";
                }
                else{
                    // Get db config details to connect to the database
                    include "../configurations/config.php";

                    // execute the insert query
                    $sql = "insert into usertable (FirstName, LastName, Email, Password) VALUES ('$first_name', '$last_name', '$email_address', '$password')";
                    mysqli_query($db_connection,$sql);
                    
                    // close db connection
                    mysqli_close($db_connection);
                  }
            }

      }
?>