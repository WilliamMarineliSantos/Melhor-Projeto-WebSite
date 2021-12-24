<?php
$Nome		= $_POST["Nome"];
$Email		= $_POST["Email"];	
$Mensagem	= $_POST["Mensagem"];



$Vai 		= "Nome: $Nome\n\nE-mail: $Email\n\nMensagem: $Mensagem\n";

require_once("PHPMailer/class.phpmailer.php");

define('GUSER', 'seuEmail@gmail.com');
define('GPWD', 'suaSenha');	

function smtpmailer($para, $de, $de_nome, $assunto, $corpo) { 
	global $error;
	$mail = new PHPMailer();
	$mail->IsSMTP();		// Ativar SMTP
	$mail->SMTPDebug = 1;		// Debugar: 1 = erros e mensagens, 2 = mensagens apenas
	$mail->SMTPAuth = true;		// Autenticação ativada
	$mail->SMTPSecure = 'tls';	// REQUERIDO pelo GMail (Se não funcionar, pode ser substituído por'ssl' mas nesse caso a configuração PORT abaixo deverá ser trocada para 465)
	$mail->Host = 'smtp.gmail.com';	// SMTP utilizado
	$mail->Port = 587;  		// A porta 587 deverá estar aberta em seu servidor (Deverá ser mudado para 465 caso o SMTPSecure seja 'ssl')
	$mail->Username = GUSER;
	$mail->Password = GPWD;
	$mail->SetFrom($de, $de_nome);
	$mail->Subject = $assunto;
	$mail->Body = $corpo;
	$mail->AddAddress($para);
	if(!$mail->Send()) {
		$error = header("Location: https://LinkDoSeuSite/erro.html");  
		return false;
	} else {
		$error = header("Location: https://LinkDoSeuSite/sucesso.html"); //Pode ser substituído por mensagem confirmando o envio do E-mail --> $error = header("Seu E-Mail foi enviado com sucesso!");
		return true;
	} 
}

// Insira abaixo o email que irá receber a mensagem, o email que irá enviar (o mesmo da variável GUSER), 
//o nome do email que envia a mensagem, o Assunto da mensagem e por último a variável com o corpo do email.

 if (smtpmailer('seuEmail@gmail.com', 'seuEmail@gmail.com', 'Nome do Enviador', 'Assunto', $Vai)) {

	//Header("Mensagem Enviada"); // Redireciona para uma página de obrigado.

}
if (!empty($error)) echo $error;
?>