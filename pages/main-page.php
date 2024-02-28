<!Doctype html>
<html lang = "en">
    <head>
        <meta charset = "UTF-8">
        <title id ="page-title-id">My Profile</title>
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
        <form action = "main-page.php" method = "post">
            <section class = "form-container">
                  <section class = "form-title">My Profile</section>
                  <section class = "form-content">
            
                        <input name = "first_name" type = "text" placeholder = "Name"/>
                        <input name = "last_name" type = "text" placeholder = "Surname"/>
                        <input name = "email_address" type = "text" placeholder = "Email address"/>
                        <textarea name = "education" rows = "10"  placeholder = "List your education here"></textarea>
                        <textarea name = "work_experience" rows = "10"  placeholder = "List your work experience here"></textarea>
                        <section class = "button-group-3">
                              <input class = "submit-button" name = "save_button" type = "submit" value = "Save"/>
                              <input class = "submit-button" name = "submit_sign_out" type="submit" value = "Sign out"/>
                        </section>
                  </section>
            </section>
        </form>
    </body>
</html>

<?php
      session_start(); 
      $error = "";
      if (isset($_POST['save_button'])) 
      {
            // get the registration details
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $email_address = $_POST['email_address'];
            $education = $_POST['education'];
            $work_experience = $_POST['work_experience'];

            // check if all registration details have been entered
            if($first_name == "" || $last_name == "" || $email_address == "" || $education == "" || $work_experience == ""){
                $error = "There are fields that are empty";
            }
            else{
                    // Get db config details to connect to the database
                    include "../configurations/config.php";

                    $sql_check = "select email_address from profileDetails where email_address='$email_address'";
                    $query_check = mysqli_query($db_connection,$sql_check);
                    $rows = mysqli_num_rows($query_check);

                    if ($rows == 1) {
                        // execute the update query
                        $sql_update = "update profileDetails set education ='$education', work_experience = '$work_experience' where email_address='$email_address'";
                        mysqli_query($db_connection,$sql_update);
                    }
                    else{
                        // execute the insert query
                        $sql_insert = "insert into profileDetails (email_address, education,work_experience) VALUES ('$email_address','$education','$work_experience')";
                        mysqli_query($db_connection,$sql_insert);
                    }
                   

                    
                    
                    // close db connection
                    mysqli_close($db_connection);
                  
            }

      }
      elseif (isset($_POST['submit_sign_out'])) {
            include "sign-out.php";
      }
?>

