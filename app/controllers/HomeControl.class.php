<?php 
class HomeControl extends Controller{
    private $homeModel;
    public function __construct(){
        $this->homeModel = $this->model('Home');
    }
    public function index()
    {
        $users=$this->homeModel->getUsers();
        $data = [
            'users'=> $users
        ];
        $this->view('dashboadr',$data);
    }
    public function insert()
    {
        $name=$_POST['name'];
        $this->homeModel->insert($name);
        header('location:'.URLROOT.'HomeControl/getUsers');
    }
}