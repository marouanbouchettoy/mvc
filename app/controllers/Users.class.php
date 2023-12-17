<?php 
class Users extends Controller{

    private $userModel;
    public function __construct(){
        $this->userModel = $this->model('User');
    }
    public function register()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST= filter_input_array(INPUT_POST ,FILTER_SANITIZE_STRING);
            $data = [
                'name' => $_POST['userName'],
                'email' => $_POST['userEmail'],
                'password' => $_POST['userPassword'],
                'confirm-password' => $_POST['userConfirmPassword'],
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm-password_err' => ''
            ];
            if(empty($data['name'])) $data['name_err'] = 'Please enter name';
            if(empty($data['email'])) $data['email_err'] = 'Please enter email';
            if(empty($data['password'])) $data['password_err'] = 'Please enter password';
            if($data['confirm-password'] !== $data['password']) $data['confirm-password_err'] = 'Passwords don\'t match';
            if(empty($data['confirm-password'])) $data['confirm-password_err'] = 'Please enter confirm password';
            // check if email exist
            if($this->userModel->getUserByEmail($data['email'])){
                $data['email_err'] = 'Email exist';
            }
            if(empty($data['name_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm-password_err'])){
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                // user register success
                if ($this->userModel->register($data['name'],$data['email'],$data['password'])) {
                    // user added successfully
                    redirect('users/login');
                }else {
                    // user not added successfully
                    die('something went wrong!!');
                }

            }else{
                // user register failed
                $this->view('users/register', $data);
            }
        }else
        {
            $data = [
                'name' => '',
                'email' => '',
                'password' => '',
                'confirm-password' => '',
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm-password_err' => ''
            ];

            // load the register
            $this->view('users/register',$data);
        }
    }
    public function login()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST= filter_input_array(INPUT_POST ,FILTER_SANITIZE_STRING);
            $data = [
                'email' => $_POST['userEmail'],
                'password' => $_POST['userPassword'],
                'email_err' => '',
                'password_err' => ''
            ];
            // check if email exist
            if(!$this->userModel->getUserByEmail($data['email'])){
                $data['email_err'] = 'User not exist';
            }
            if(empty($data['email'])) $data['email_err'] = 'Please enter email';
            if(empty($data['password'])) $data['password_err'] = 'Please enter password';
            
            if(empty($data['email_err']) && empty($data['password_err'])){
                $user = $this->userModel->login($data['email'],$data['password']);
                if($user){
                    // set The sessions
                    $_SESSION['user_id'] = $user->id_u;
                    $_SESSION['user_name'] = $user->userName;
                    redirect('');
                }else {
                    // password incorrect
                    $data['password_err'] = 'Password Incorrect';
                    $this->view('users/login', $data);
                }
            }else{
                // user register failed
                $this->view('users/login', $data);
            }
        }else
        {
            $data = [
                'name' => '',
                'email' => '',
                'password' => '',
                'confirm-password' => '',
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm-password_err' => ''
            ];

            // load the register
            $this->view('users/login',$data);
        }
    }
    // logout
    public function logout()
    {
        $_SESSION['users_id'] = null;
        $_SESSION['name'] = null;
        session_destroy();
        redirect('');
    }
}