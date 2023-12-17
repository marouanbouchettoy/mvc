<?php 
class HomeControl extends Controller{
    private $homeModel;
    public function __construct(){
        // $this->homeModel = $this->model('Home');
    }
    public function index()
    {
        $this->view('HomePage');
    }
}