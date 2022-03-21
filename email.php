<?php
if (isset($_POST['email'])) {

    // EDIT THE FOLLOWING TWO LINES;
    $email_to = "efmarcial1060@gmail.com";
    $email_subject = 'New form submission';

    function problem($error){
        echo "We're sorry, but there were error(s) found with the form you submitted";
        echo "These errors appear below.<br><br>";
        echo $error . "<br><br>";
        echo "Please go back and fix these errors.<br><br>";
        die();
    }

    // validation expected data exists
    if (
        !isset($_POST['name']) ||
        !isset($_POST['email'])||
        !isset($_POST['message'])
    ){
        problem("We're sorry, but there appears to be a problem with the form you submitted.");

    }

    $name = $_POST['name']; // required
    $email = $_POST['message']; // required
    $message = $_POST['email']; // required

    $error_message = '';
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-za-z0-9.-]+\.[A-Za-z]{2,4}$/';

    if (!preg_match($email_exp, $email)){
        $error_message .= "The email address you entered does not appear to be valid.<br><br>";
    }

    $string_exp = "/^[A-Za-z .'-]+$/";

    if(!preg_match($string_exp, $name)){
        $error_message .= 'The name you entered does not appear to be valid.<br>';

    }

    if (strlen($message) < 2) {
        $error_message .= "The message you entered does not appear to be valid.<br>";

    }

    if(strlen($error_message) > 0) {
        problem($error_message);
    }

    $email_message = "Form detail below.\n\n ";
    
    function clean_string($string){
        $bad = array("content-type", "bcc:", "to:", "cc:", "href");
        return str_replace($bad, "", $string);
    }

    $email_message .= "Name:" . clean_string($name) . "\n";
    $email_message .= "Email" . clean_string($email) . "\n";
    $email_message .= "Message" . clean_string($message) . "\n";

    // create email header
    $headers = 'From: ' . $email . "\r\n"  . 
            'Reply-To: ' . $email . "\r\n\ " .
            'X-Mailer: PHP/' . phpversion();
            @mail($email_to, $email_subject, $email_message, $headers); 
    ?>

    <!-- INCLUDE YOUR SUCCESS MESSAGE BELOW -->
    Thanks for getting in touch. We'll get back to you
<?php
}

?>