<?php

// Inclua o arquivo da biblioteca PHPMailer
require('mail/src/PHPMailer.php');
require('mail/src/SMTP.php');
require('mail/src/Exception.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Configuração do PHPMailer
// ********************************** lembrando antes tem que escrever o assunto e o corpor do email  e tambem a chave de envio
//$assuntoemail = 'Congresso Multiplique'; // Assunto do email
//$corpoemail = 'Segue em anexo o recibo de pagamento.'; // Corpo do email
$mail = new PHPMailer(true);

try {
	
	$mail->isSMTP();
	$mail->Host = 'smtp.gmail.com';
	$mail->SMTPAuth = true;
	$mail->Username = 'comunicacao@cbpc.org.br';
	$mail->Password = 'jqqeejfoulzgjgnd';
	$mail->Port = 587;

	$mail->setFrom('comunicacao@cbpc.org.br');
	$mail->addAddress($email);



	$mail->isHTML(true);
	$mail->Subject = $assuntoemail;
	$mail->Body = $corpoemail;
	$mail->AltBody = $corpoemail;

    // Anexar o arquivo PDF ao email
   // $mail->addAttachment($temporario, $nome_arquivo);


	if($mail->send()) {
		
        
        // Depois de enviar o email, você pode oferecer um link para baixar o PDF
        echo 'Email enviado com sucesso! <br>';
      //  echo '<a href="download_pdf.php?temporario=' . urlencode($temporario) . '&nome_arquivo=' . urlencode($nome_arquivo) . '"><button class="btn btn-primary">Clique aqui para baixar o PDF</button></a>';

        


	} else {
		echo 'Email não enviado. Erro: ' . $mail->ErrorInfo;
	}

} catch (Exception $e) {
    echo 'Erro ao enviar o email: ' . $e->getMessage();
}