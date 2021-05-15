<?php
    if(isset($_POST['login'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        if(isset($_POST['login_checkbox'])){
            // Do something
            // echo $_POST['login_checkbox'];
        }
        echo $email = strtolower($email);
        echo $password;
        echo $password_error_msg = "<script>
                                document.getElementById('pass-validate').style.display ='block';    
                                document.getElementById('pass-validate').innerHTML='Hiii';
                                </script>";
        
    }
?>