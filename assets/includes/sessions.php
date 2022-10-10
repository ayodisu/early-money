<?php
    session_start();

    // $_SESSION['error'] = null;
   function errorMsg() {
    if (isset($_SESSION['error_msg'])) {
        $output = "<div class=\"alert bg-danger text-white alert-dismissible fade show\" role=\"alert\" id='messageAlert'>
            <strong>";
        $output .= htmlentities($_SESSION['error_msg']);
        $output .= "</strong>
            <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>
        </div>
        ";
    
       $_SESSION['error_msg'] = null;
        return $output;
     }
   }

   function successMsg() {
    if (isset($_SESSION['success_msg'])) {
        $output = "<div class=\"alert bg-success text-white alert-dismissible fade show\" role=\"alert\" id='messageAlert'>
            <strong>";
        $output .= htmlentities($_SESSION['success_msg']);
        $output .= "</strong>
            <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>
        </div>
        ";
    
        $_SESSION['success_msg'] = null;
        return $output;
     }
   }

   function isLoggedIn(){
    if (!isset($_SESSION['user'])) {
       header("Location: ../login");
    }
   }