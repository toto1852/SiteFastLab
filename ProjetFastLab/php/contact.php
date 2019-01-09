<?php

if(isset($_POST['email'])) {

    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "toto1852@gmail.com";
    $email_subject = "Your email subject line";

    function died($error) {
        // your error code can go here
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
        die();
    }

    echo ("ça maaaaarche");
    // validation expected data exists
    if(!isset($_POST['nom']) ||
        !isset($_POST['fonction']) ||
        !isset($_POST['raison']) ||
        !isset($_POST['politique']) ||
        !isset($_POST['prenom']) ||
        !isset($_POST['email']) ||
        !isset($_POST['telephone'])) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');
    }



    $nom = $_POST['nom']; // required
    $fonction = $_POST['fonction']; // required
    $raison = $_POST['raison']; // required
    $politique = $_POST['politique']; // required
    $prenom = $_POST['prenom']; // required
    $email_from = $_POST['email']; // required
    $telephone = $_POST['telephone']; // not required

    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

    if(!preg_match($email_exp,$email_from)) {
        $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
    }

    $string_exp = "/^[A-Za-z .'-]+$/";

    if(!preg_match($string_exp,$prenom)) {
        $error_message .= 'The First Name you entered does not appear to be valid.<br />';
    }

    if(!preg_match($string_exp,$nom)) {
        $error_message .= 'The Last Name you entered does not appear to be valid.<br />';
    }


    if(strlen($error_message) > 0) {
        died($error_message);
    }

    $email_message = "Form details below.\n\n";


    function clean_string($string) {
        $bad = array("content-type","bcc:","to:","cc:","href");
        return str_replace($bad,"",$string);
    }



    $email_message .= "First Name: ".clean_string($prenom)."\n";
    $email_message .= "Last Name: ".clean_string($nom)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "Telephone: ".clean_string($telephone)."\n";
    $email_message .= "Comments: ".clean_string($raison)."\n";

// create email headers
    $headers = 'From: '.$email_from."\r\n".
        'Reply-To: '.$email_from."\r\n" .
        'X-Mailer: PHP/' . phpversion();
    mail($email_to, $email_subject, $email_message, $headers);

    echo ("ça maaaaarche2");
}
?>