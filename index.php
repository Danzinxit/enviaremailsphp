<?php 
require_once 'config.php';
require_once 'vendor/autoload.php';

use Dan\Adapters\PhpMailerAdapter;

//new PhpMailerAdapter;

$body = '<h1>Olá Danzin!</h1><p>Este é um e-mail de teste enviado com sucesso usando PHPMailer.</p>';
$assunto = 'E-mail de Teste via PHP';

$mail = new PhpMailerAdapter();

// Define quem está enviando o e-mail. É uma boa prática usar o mesmo e-mail do config.php
$mail->setFrom('danielvieiraxbh30@gmail.com', 'Danzin Remetente');

// Define para quem o e-mail será enviado
$mail->addAddress('daniel.vieira3d9@gmail.com', 'Daniel Destinatário');

// (Opcional) Define um endereço para o qual as respostas serão enviadas. Use um nome apropriado.
$mail->addReplyTo('danielvieiraxbh30@gmail.com', 'Responder para Danzin');

// Define o conteúdo do e-mail e o envia
$mail->montarConteudo($assunto, $body);
$mail->addAttachment('cruzeiro.png');
$mail->send();

?>