<?php
$EMAIL_TO = "ventas2@grupodigsa.com";

if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['phone'])){

  $name = $_POST['name'];
  $email =  $_POST['email'];
  $phone = $_POST['phone'];
  
  $servername = "localhost";
  $username = "digsa";
  $password = "n73dXwF!fQpV";
  $dbname = "digsa";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$to = $EMAIL_TO;

$sql = "INSERT INTO contact ( `name`, `email`, `phone`, `email_to`, `created_at`) values ('".$name."','".$email."','".$phone."','".$to."', now())";

$conn->query($sql);

  $subject = "General Pardiñas 114 - Recibiste un contacto";
  $html = '
                        <html>
                        <body>
                       <p>
                            <u>Datos del contacto</u>
                            <br><br>Nombre: <b>"'.$name.'"</b>
                            <br><br>Email: <b>"'.$email.'"</b>
                            <br><br>Teléfono: <b>"'.$phone.'"</b>
                            <br><br>Tipo de consulta: <b>"'.$option.'"</b>

                            </p>
                        </body>
                        </html>
                        ';

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <noreply@digsa.com.ar>' . "\r\n";

//mail($to,$subject,$html,$headers);



}

header('Location: gracias.html');
die;