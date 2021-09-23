<?php

require __DIR__ . "/db.php";

if ($_POST) {
    $name    =         $_POST['name'];
    $email  =      $_POST['email'];
    $subject =    $_POST['subject'];
    $message  =   $_POST['message'];

    if (!$name || !$email || !$subject || !$message) {
        echo "ada";
    } else {
        $mesajgonder = $db->prepare("INSERT INTO iletisim SET name=:name, 
        email=:email, subject=:subject, 
        message=:message ");
        $mesajgonder->execute([
            "name" => $name,
            "email" => $email,
            "subject" => $subject,
            "message" => $message
        ]);
        if ($mesajgonder) {
            echo "ok";
        } else {
            echo "hata";
        }
    }
}
