<?php
    if(isset($_POST['email']) && $_POST['email'] != ''){
       
       
		
        # Sender Data
        $name = str_replace(array("\r","\n"),array(" "," ") , strip_tags(trim($_POST["name"])));
        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
        $phone = trim($_POST["phone"]);
        $message = trim($_POST["message"]);
        if ( empty($name) OR !filter_var($email, FILTER_VALIDATE_EMAIL) OR empty($phone) OR empty($message)) {
            # Set a 400 (bad request) response code and exit.
            http_response_code(400);
            echo "Popunite formu i pokušajte ponovno.";
            exit;
        }
		
		$mail_to = "mirjana.nadj@outlook.com";
		$subject = "Web kontakt forma";
		$body = "";
		
        $body = "Ime i prezime: $name\n";
        $body .= "Email: $email\n";
        $body .= "Telefon: $phone\n\n";
        $body .= "Poruka:\n$message\n";
 
        # Send the email.
        $success = mail($mail_to, $subject, $body);
        if ($success) {
            # Set a 200 (okay) response code.
            http_response_code(200);
            echo "Hvala! Vaš upit je poslan.";
        } else {
            # Set a 500 (internal server error) response code.
            http_response_code(500);
            echo "Došlo je do pogreške. Vaš upit nije poslan. Pokušajte ponovno.";
        }
    } else {
        # Not a POST request, set a 403 (forbidden) response code.
        http_response_code(403);
        echo "Vaš upit nije poslan. Pokušajte ponovno.";
    }
?>
