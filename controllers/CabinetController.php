<?php

class CabinetController extends Controller {

    private $pageTpl = "/views/cabinet.tpl.php";

    public function __construct() {
        $this->model = new CabinetModel();
        $this->view = new View();
    }

    public function index() {

        if(!$_SESSION['user']) {
            header("Location: /");
        }

        $this->pageData['title'] = "Personal Cabinet";

        // Отримання логіну поточного користувача
        $currentUserLogin = isset($_SESSION['user']) ? $_SESSION['user'] : '';

        // Передача логіну до $this->pageData
        $this->pageData['currentUserLogin'] = $currentUserLogin;

        $polls = $this->model->getPolls($id);
        $this->pageData['polls'] = $polls;

        $users = $this->model->getUsers();
        $this->pageData['users'] = $users;

        $this->view->render($this->pageTpl, $this->pageData);
    }

    public function logout() {
        session_destroy();
        header("Location: /");
    }

    public function getPoll() {
		if(!$_SESSION['user']) {
			header("Location: /");
			return;
		}
		if(!isset($_GET['id'])) {
			echo json_encode(array("success" => false));
		} else {
			$pollId = $_GET['id'];
			$pollInfo = json_encode($this->model->getPollById($pollId));
			echo $pollInfo;
		}
	}

    public function getPollbyID() {
		if(!$_SESSION['user']) {
			header("Location: /");
			// return;
		}

        if(isset($_POST['id'])) {
			$pollId = $_POST['id'];
			if($pollInfo = $this->model->getPollById($pollId)) {
				echo json_encode($pollInfo);
				echo json_encode("qqq");
			} else {
				echo json_encode(array("success" => false, "text" => "Poll is not found"));
			}
		} else {
			echo json_encode(array("success" => false, "text" => "Error"));
		}
	}

  

	public function updatePollAction() {
		if (!$_SESSION['user']) {
			header("Location: /");
		}
	
		if (!empty($_POST) && !empty($_POST['name']) && !empty($_POST['status']) && !empty($_POST['optionNames'])) {
			$pollId = $_POST['id'];
			$pollName = $_POST['name'];
			$pollStatus = $_POST['status']; 
			$pollOptions = $_POST['optionNames']; 
	
			$this->model->updatePoll($pollId, $pollName, $pollStatus, $pollOptions);
			echo json_encode(array("success" => true, "text" => "OK"));error_log(print_r($_POST, true));
		} else {
			echo json_encode(array("success" => false, "text" => "Error"));error_log(print_r($_POST, true));
		}
	}
	
	public function deletePoll() {
		if(!$_SESSION['user']) {
			header("Location: /");
			return;
		}
	
		if(empty($_POST) || !isset($_POST['id'])) {
			echo json_encode(array("success" => false));
		} else {
			$pollId = $_POST['id'];
			if($this->model->deletePoll($pollId)) {
				echo json_encode(array("success" => true));
			} else {
				echo json_encode(array("success" => false));
			}
		}
	}
	

	
	

	
}