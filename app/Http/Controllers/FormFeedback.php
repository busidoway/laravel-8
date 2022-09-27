<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use ReCaptcha;
use Illuminate\Http\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FormFeedback extends Controller
{
    public function index(Request $request){

        // if( Request::isMethod('post') ) {

            $secret = '';
			$host = '';
			$domain = '';
			$secure = '';
			$mailer = '';
			$port = '';

            $username = '';
			$password = '';
            $mail_to = "";

            $mail = new PHPMailer;
            $mail->CharSet = 'UTF-8';

            // Настройки SMTP
            $mail->isSMTP();
            $mail->SMTPAuth = true;
            $mail->SMTPDebug = 0;

            $mail->Host = $host;
            $mail->Username = $username;
            $mail->Password = $password;
            $mail->SMTPSecure = $secure;
            $mail->Port = $port;
            $mail->Mailer = $mailer;

            if(isset($_POST['header']))
                $header = $_POST['header'];
            else
                $header = "";

            // return $header;

            if(isset($_POST['title'])){
                $title = "\nТема: ".$_POST['title'];
            }else{
                $title = "";
            }

            $response = array();

            $response['status'] = '';

            $field_text = "";

            if(isset($_POST['field'])){
                $field_arr = $_POST['field'];
                foreach($field_arr as $key=>$val){
                    $field_text .= "<p>". $key . ": " . $val . "</p>";
                }
            }

            $field_req_text = "";

            if(isset($_POST['field_req'])){
                $field_req_arr = $_POST['field_req'];
                foreach($field_req_arr as $key=>$val){
                    if(empty($val)){
                        $response['status'] = 'error';
                        $response['error_input'] = 'field_req['.$key.']';
                    }else $field_req_text .= "<p>". $key . ": " . $val . "</p>";
                }
            }

            if(isset($_POST['phone'])){
                if(empty($_POST['phone'])) {
                    $response['status'] = 'error';
                    $response['error_input'] = 'phone';
                }else{
                    $phone = "<p>Телефон: ".$_POST['phone']."</p>";
                }
            }else $phone = "";

            if(isset($_POST['email'])){
                if(empty($_POST['email'])) {
                    $response['status'] = 'error';
                    $response['error_input'] = 'email';
                }else{
                    $email = "<p>E-mail: ".$_POST['email']."</p>";
                }
            }else $email = "";

            if(isset($_POST['middle_name'])){
                if(empty($_POST['middle_name'])) {
                    $response['status'] = 'error';
                    $response['error_input'] = 'middle_name';
                }else{
                    $middle_name = "<p>Отчество: " . $_POST['middle_name']."</p>";
                }
            }else $middle_name = "";

            if(isset($_POST['first_name'])){
                if(empty($_POST['first_name'])) {
                    $response['status'] = 'error';
                    $response['error_input'] = 'first_name';
                }else{
                    $first_name = "<p>Имя: " . $_POST['first_name']."</p>";
                }
            }else $first_name = "";

            if(isset($_POST['last_name'])){
                if(empty($_POST['last_name'])) {
                    $response['status'] = 'error';
                    $response['error_input'] = 'last_name';
                }else{
                    $last_name = "<p>Фамилия: " . $_POST['last_name']."</p>";
                }
            }else $last_name = "";

            if(isset($_POST['name'])){
                if(empty($_POST['name'])) {
                    $response['status'] = 'error';
                    $response['error_input'] = 'name';
                }else{
                    $name = "<p>Ф.И.О.: " . $_POST['name']."</p>";
                }
            }else $name = "";

            if(isset($_FILES['myfile']))
                $file = $_FILES['myfile'];
            else
                $file = "";

            if (!empty($file['name'][0])) {
                for ($ct = 0; $ct < count($file['tmp_name']); $ct++) {
                    $uploadfile = tempnam(sys_get_temp_dir(), sha1($file['name'][$ct]));
                    $filename = $file['name'][$ct];
                    if (move_uploaded_file($file['tmp_name'][$ct], $uploadfile)) {
                        $mail->addAttachment($uploadfile, $filename);
                    } else {
                        $response['status'] = 'error';
                        $response['error_input'] = "Не удалось прикрепить файл $filename";
                    }
                }   
            }

            if (isset($_POST['g-recaptcha-response'])) {

                $recaptcha = new \ReCaptcha\ReCaptcha($secret);

                $resp = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);

                if ($resp->isSuccess()){

                    if($response['status'] != 'error'){

                        $message = $title . $name . $last_name . $first_name . $middle_name . $phone . $email . $field_req_text . $field_text;

                        // От кого
                        $mail->setFrom($mail_to, $domain);
                        // Кому
                        $mail->addAddress($mail_to);

                        // Тема письма
                        $mail->Subject = $header;
                        // Тело письма
                        $mail->msgHTML($message);

                        if($mail->send()){
                            $response['status'] = 'success';
                        } else {
                            $response['status'] = 'error';
                            $response['error_info'] = $mail->ErrorInfo;
                        }

                    }

                    $response['captcha'] = 'success';

                }else{
                    $errors = $resp->getErrorCodes();
                    $response['error-captcha'] = $errors;
                    $response['msg'] = 'Код капчи не прошёл проверку на сервере';
                    $response['captcha'] = 'error';
                }

            }else{
                $response['msg'] = 'Ошибка проверки';
                $response['captcha'] = 'error';
            }

            return response()->json($response, 200);
			
    }

    // }
}
