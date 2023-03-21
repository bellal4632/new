<?php

    include_once '../lib/database.php';
    include_once '../helpers/Format.php';

    include_once '../PHPmailer/PHPMailer.php';
    include_once '../PHPmailer/SMTP.php';
    include_once '../PHPmailer/Exception.php';


    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;


    class Register{

        public $db;
        public $fr;

        public function __construct() {
            $this->db = new Database();
            $this->fr = new Format();
        }


        public function AddUser($data){
            function sendemail_verifi($name, $email, $v_token){
                $mail = new PHPMailer(true);
                $mail->isSMTP(); 
                $mail->SMTPAuth   = true;

                $mail->Host = 'smtp.gmail.com';
                $mail->Username = 'codewithredbox@gmail.com';
                $mail->Password = 'rmmaqztcrltibccl';
                
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                $mail->setFrom('codewithredbox@gmail.com','Code With Red Box');
                $mail->addAddress($email);

                $mail->isHTML(true);
                $mail->Subject = 'Verify Your Registration On Code With Red Box';
                
                $email_template = "
                
                Hello Sir, <br>

                Thanks for getting registered with <b>Code With Red Box</b><br>

                We need one more step to complete your registration, including a confirmation of your email address.<br>

                Click below to confirm your email address:<br>

                <a href='http://localhost/dashboard/Project-1/admin/verify-email.php?token=$v_token'>Click Here</a>

                <br>If you have problems, please paste the above URL into your web browser.                
                ";

                $mail->Body = $email_template;
                 
                $mail->send ();

            }

            

            $name = $this->fr->validation($data['name']);
            $phone = $this->fr->validation($data['phone']);
            $email = $this->fr->validation($data['email']);
            $password = $this->fr->validation (md5($data['password']));
            $v_token = md5(rand());
            
            

            if (empty($name) || empty($phone) || empty($email) || empty($password)){
                $error = "All Field Must Be Filled.";
                return $error;
            }

            else{
                $e_query = "SELECT * FROM tbl_users WHERE email='$email'";
                $check_email = $this->db->select($e_query) ;

                if ($check_email > 0){ 
                    $error = "This Email Is Already Exist";
                    return $error;
                    header ("location:register.php");
                }

                else{
                    $insert_query = "INSERT INTO tbl_users(username, email, phone, password, v_token) VALUES ('$name', '$email', '$phone', '$password', '$v_token')";

                    $insert_row = $this->db->insert($insert_query);

                    if ($insert_query) {
                        sendemail_verifi($name, $email, $v_token);
                        $success = "Registration Successfull, Before Login Please Verify Your Email";
                        return $success;
                    }

                    else {
                        $error = "Registration Failed";
                        return $error;
                    }
                }
            }

        }
    }
?>