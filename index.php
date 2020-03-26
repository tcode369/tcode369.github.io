<?php

if(isset($_POST['contact_me_by_fax_only']) && $_POST['contact_me_by_fax_only'] !="" )
   die();
$statusMsg = '';
$msgClass = '';
if(isset($_POST['submit'])){
    // Get the submitted form data
    $email = $_POST['email'];
    $name = $_POST['name'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    
    // Check whether submitted data is not empty
    if(!empty($email) && !empty($name) && !empty($subject) && !empty($message)){
        
        if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
            $statusMsg = 'momimo unesite valjanu email adresu';
            $msgClass = 'errordiv';
        }else{
            // Recipient email
            $toEmail = 'tcode369@gmail.com.';
            $emailSubject = 'Primljeni upit od '.$name;
            $htmlContent = '<h2>Primljena poruka</h2>
                <h4>Ime</h4><p>'.$name.'</p>
                <h4>Email</h4><p>'.$email.'</p>
                <h4>Predmet</h4><p>'.$subject.'</p>
                <h4>Poruka</h4><p>'.$message.'</p>';
            
            // Set content-type header for sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            
            // Additional headers
            $headers .= 'From: '.$name.'<'.$email.'>'. "\r\n";
            
            // Send email
            if(mail($toEmail,$emailSubject,$htmlContent,$headers)){
                $statusMsg = 'Hvala Vam. Javimo se uskoro!';
                $msgClass = 'succdiv';
            }else{
                $statusMsg = 'Nije uspjelo, molimo Vas probajte ponovno';
                $msgClass = 'errordiv';
            }
        }
    }else{
        $statusMsg = 'Please fill all the fields.';
        $msgClass = 'errordiv';
    }
}
?>
