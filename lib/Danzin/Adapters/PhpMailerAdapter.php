<?php 
namespace Dan\Adapters;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class PhpMailerAdapter
{
    private $mail; // Propriedade para a instância do PHPMailer. Só pode ser acessada de dentro desta classe.

    public function __construct()
    { 
        $this->mail = new PHPMailer(true);
        $this->serverConfiguracoes();

    }

    private function serverConfiguracoes(){
        //Configurações do servidor
        $this->mail->SMTPDebug = SMTP::DEBUG_SERVER;                //Habilita o output de debug detalhado
        $this->mail->isSMTP();                                      //Define o envio como SMTP
        $this->mail->Host       = MAIL_HOST;               //Define o servidor SMTP para envio
        $this->mail->SMTPAuth   = true;                             //Habilita a autenticação SMTP
        $this->mail->Username   = MAIL_USERNAME;               //Usuário do SMTP
        $this->mail->Password   = MAIL_PASSWORD;                         //Senha do SMTP
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;      //Habilita a criptografia TLS implícita
        $this->mail->Port       = MAIL_PORT;                              //Porta TCP para se conectar; use 587 se `SMTPSecure` for `PHPMailer::ENCRYPTION_STARTTLS`
        $this->mail->CharSet    = 'UTF-8';
    
    
    }
    public function setFrom($email, $nome = null)
    {
        if(is_null($nome)){
             $this->mail->setFrom($email);
        }
        else{
            $this->mail->setFrom($email,$nome);
        }
    }
    
    public function addAddress($email , $nome){
         $this->mail->addAddress($email, $nome);  
    }

    public function addReplyTo($email, $nome)
    {
        $this->mail->addReplyTo($email, $nome);
    }
    public function addAttachment($caminhoArquivo , $displayName = null){
        if(is_null($displayName)){ //se for null o display name
             $this->mail->addAttachment($caminhoArquivo);
        }
        else{
            $this->mail-> addAttachment($caminhoArquivo, $displayName);
        }    
    }
    public function montarConteudo($subject, $body,$altBody = null)//parametros
    {
        $this->mail->isHTML(true);//Define o formato do e-mail para HTML
        $this->mail->Subject = $subject;//'Aqui está o assunto';
        $this->mail->Body = $body;//'Este é o corpo da mensagem HTML 
        if(is_null($altBody)){
             $this->mail->AltBody = $altBody;//'Este é o corpo em texto simples para clientes de e-mail que não sejam HTML';
        }
    }

    public function send(){
        $this->mail->send();
    }

    /* $this->mail->addCC('cc@example.com');
    $this->mail->addBCC('bcc@example.com'); */

}
