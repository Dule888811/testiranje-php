<?php

include_once 'core/init.php';


    $required_fields = array('password','name','email');
    foreach($required_fields as $field){
        if(!isset($_POST[$field]) || empty(trim($_POST[$field]))){
            switch($field){
                case 'password': $f = 'Lozinka'; break;
                case 'name': $f = 'Ime'; break;
                case 'email': $f = 'E-mail adresa'; break;
            }
            $errors[] = 'Polje <b>' . $f . '</b> mora biti upisano.';
        }else{
            $$field = trim($_POST[$field]);
        }
    }
    if(isset($email)){
        if(User::email_exists($email)) $errors[] = 'Već postoji korisnik sa ovom E-mail adresom.';
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Unesite validnu E-mail adresu.';
    }
    if(count($errors) == 0){
        User::register_new_user($name, $email, $password);
        header('Location: index.php');
    }

if(!empty($errors)){
    ?>
<h1>Registracija neuspešna!</h1>
<ul><li><?php echo implode('</li><li>', $errors) ?></li></ul>
    <?php
}else{
    //   header('Location: index.php');
};
?>