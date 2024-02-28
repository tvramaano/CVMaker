<?php 
    if (session_destroy()) {
            header("location: sign-in.php");
        }
    
    
?>