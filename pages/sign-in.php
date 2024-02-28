<!Doctype html>
<html lang = "en">
    <head>
        <meta charset = "UTF-8">
        <title id ="page-title-id">Sign in</title>
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
        <form action = "sign-in.php" method = "post">
            <section class = "form-container">
                  <section class = "form-title">Sign in to your account</section>
                  <section class = "form-content">
            
                        <input name = "name_email_address" type = "text" placeholder = "Email address"/>
                        <input name = "name_password" type = "password" placeholder = "Password"/>
                        <input class = "submit-button" name="submit" type="submit" value="Sign in">
                        <section class = "link" onclick = "navigateToPage('register.php')">I don't yet have an account</section>
                  </section>
            </section>
      </form>
      
    </body>
</html>

<?php
session_start(); 
if (isset($_POST['submit'])) 
{
      if ($_POST['name_email_address'] == "") 
      { 
            $error  = "Username has not been entered";
      }
      elseif (empty($_POST['name_password'])) {
            $error = "Password has not been entered";
      }

      else
      {
            $email_address=$_POST['name_email_address'];
            $pass=$_POST['name_password'];

            $db_server = "localhost";
            $db_user = "root";
            $db_password = "";
            $db_name = "usersdb";

            $db_connection = mysqli_connect($db_server, $db_user, $db_password,$db_name);

            $query = mysqli_query($db_connection,"select * from userTable where Password='$pass' AND Email='$email_address'");
            
            $rows = mysqli_num_rows($query);
            $sql = "select FirstName, LastName from userTable where Password='$pass' AND Email='$email_address'";
            $result = $db_connection->query($sql);

            $row = $result->fetch_assoc();

            $first_name = $row["FirstName"];
            $last_name = $row["LastName"];
            if ($rows == 1) {
                  $_SESSION['first_name']=$first_name; 
                  $_SESSION['last_name']=$last_name; 
                  $_SESSION['email_address']=$email_address; 
                  header("location: main-page.php"); 
            } 
            else {
                  $error = "Username or Password is invalid";
            }
            mysqli_close($db_connection); 
      }
}


?>
