<?php
class php_mailer extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->library('My_PHPMailer');
    }

    public function send_mail() {
        $mail = new PHPMailer();
        $mail->IsSMTP(); // we are going to use SMTP
        $mail->SMTPAuth   = true; // enabled SMTP authentication
        $mail->SMTPSecure = "ssl";  // prefix for secure protocol to connect to the server
        $mail->Host       = "smtp.gmail.com";      // setting GMail as our SMTP server
        $mail->Port       = 465;                   // SMTP port to connect to GMail
        $mail->Username   = "redhabayuanggara@gmail.com";  // user email address
        $mail->Password   = "imthebest6537RH";            // password in GMail
        $mail->SetFrom('', 'Firstname Lastname');  //Who is sending the email
        $mail->AddReplyTo("ibgf.azurewebsites.net","Redha Anggara");  //email address that receives the response
        $mail->Subject    = "Wellcome";
        $mail->Body      = "HTML message";
        $mail->AltBody    = "Plain text message";
        $destino = "redhabayuanggara@yahoo.co.id"; // Who is addressed the email to
        $mail->AddAddress($destino, "John Doe");

        $mail->AddAttachment("images/phpmailer.gif");      // some attached files
        $mail->AddAttachment("images/phpmailer_mini.gif"); // as many as you want
        if(!$mail->Send()) {
            $data["message"] = "Error: " . $mail->ErrorInfo;
        } else {
            $data["message"] = "Message sent correctly!";
        }
       // $this->load->view('sent_mail',$data);
        echo "masuk";
    }

}
?>