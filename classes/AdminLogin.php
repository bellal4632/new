<?php

    include_once "../lib/session.php";
    Session::init();

    include_once '../lib/database.php';
    include_once '../helpers/Format.php';

    class Adminlogin{

        private $db;
        private $fr;

        public function __construct()
        {
            $this->db= new Database();
            $this->fr= new Format();
        }
        

        public function LoginUser($email, $password){

            $email = $this->fr->validation($email);
            $password = $this->fr->validation($password);

            if (empty($email) || empty($password)){

                $error = "All Field Must be Filled";
                return $error;
            }

            else {

                $select = "SELECT * FROM tbl_users WHERE email='$email' AND password='$password'";
                $result = $this->db->select($select);

                if (mysqli_num_rows($result) > 0 ) {

                    $row = mysqli_fetch_assoc($result);

                    if ($row['v_status'] == 1) {
                        
                        Session::set('login', true);
                        Session::set('username', $row['username']);
                        header('location:index.php');
                        
                    } else {
                        $error = "Please Verify Your Email First.";
                        return $error;
                    }
                    

                } else {
                    $error = "Invalid Email Or Password!";
                    return $error;
                }
                
            }

        }
    }


?>