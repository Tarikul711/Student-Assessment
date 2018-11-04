<?php
function imageUpload($fileName, $path)
{
    $errors = array();
    $file = $_FILES[$fileName];
    $file_name = $file['name'];
    $file_size = $file['size'];
    $file_tmp = $file['tmp_name'];
    $file_type = $file['type'];
    $file_ext = strtolower(end(explode('.', $file_name)));
    $expensions = array("jpeg", "jpg", "png","pdf","PDF");
    if (in_array($file_ext, $expensions) === false) {
        $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
    }

    if ($file_size > 2097152) {
        $errors[] = 'File size must be excately 2 MB';
    }

    if (empty($errors) == true) {
        $uploadPath = $path . $file_name;
        move_uploaded_file($file_tmp, $uploadPath);
        return $uploadPath;
    } else {
        return false;
    }
}


//function sendMail($mail_form,$mail_to,$subject,$mail_main_body){
//    require 'houseRent/PHPMailer/PHPMailerAutoload.php';
//    require 'houseRent/PHPMailer/class.phpmailer.php';
//    if (empty($errors)) {
//        $mail = new PHPMailer(true); //defaults to using php "mail()"; the true param means it will throw exceptions on errors, which we need to catch
//        try {
//            $mail->SMTPDebug = 4;                               // Enable verbose debug output
//            $mail->isSMTP();                                    // Set mailer to use SMTP
//            $mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
//            $mail->SMTPAuth = true;                             // Enable SMTP authentication
//            $mail->Username = 'test.tarikul711@gmail.com';           // SMTP username
//            $mail->Password = 'Torikul711';                       // SMTP password
//            $mail->SMTPSecure = 'ssl';                          // Enable TLS encryption, `ssl` also accepted
//            $mail->Port = 465;                                  // TCP port to connect, tls=587, ssl=465
//
//
//            $mail->From = $mail_form;
//            $mail->FromName = 'Tarikul [Test]';
//            $mail->addAddress($mail_to);     // Add a recipient
////        $mail->addReplyTo($fields['email'], $fields['name']);
//            $mail->addReplyTo($mail_to);
//            $mail->WordWrap = 50;                                 // Set word wrap to 50 characters
//            $mail->isHTML(false);                                  // Set email format to HTML
//            $mail->Subject = $subject;
//            $mail->Body    = $mail_main_body;
//            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
//            if(!$mail->send()) {
////                echo 'Message could not be sent.';
////                echo 'Mailer Error: ' . $mail->ErrorInfo;
//            } else {
////                echo 'Message has been sent';
//            }
////            $errors[] = "Send mail sucsessfully";
//        } catch (phpmailerException $e) {
////            $errors[] = $e->errorMessage(); //Pretty error messages from PHPMailer
//        } catch (Exception $e) {
////            $errors[] = $e->getMessage(); //Boring error messages from anything else!
//        }
//    }
//
//}


?>