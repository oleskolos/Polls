<?php

class IndexController extends Controller {

    private $pageTpl = '/views/main.tpl.php';

    public function __construct() {
        $this->view = new View();
        $this->model = new IndexModel();
    }
    public function index() {
        $this->pageData['title'] = "Entrance to Personal Cabinet";
        if(!empty($_POST)) {
            $action = $_POST['action'];
            switch ($action) {
                case 'login':
                    if(!$this->login()) {
                        $this->pageData['errorLog'] = "Incorrect login or password";
                    }
                    break;
                case 'register':
                    if($this->register()) {
                        $this->pageData['msg'] = "You are successfully registered! Please login.";
                    } else {
                        $this->pageData['errorReg'] = "An error during the registration";
                    }
                    break;
            }
           
        }

        $this->view->render($this->pageTpl, $this->pageData);
    }

    public function login() {
        if(!$this->model->checkUser()) {
            return false;
        }
    }

    public function register() {
        if(!empty($_POST) && !empty($_POST['login']) && !empty($_POST['email']) && !empty($_POST['password'])) {
            $regLogin = $_POST['login'];
            $regEmail = $_POST['email'];
            $regPassword = md5($_POST['password']);
            $this->model->regNewUser($regLogin, $regEmail, $regPassword);
            return true;
        } else {
            $this->pageData['errorReg'] = "You filled in the wrong fields";
            return false;
        }
    }
}