<?php

class CreatePollController extends Controller {
    private $pageTpl = "/views/createPoll.tpl.php";

    public function __construct() {
        $this->model = new CreatePollModel();
        $this->view = new View();
    }

    public function index() {
        if(!$_SESSION['user']) {
            header("Location: /");
        }

        $this->pageData['title'] = "Creating new poll";
        $this->view->render($this->pageTpl, $this->pageData);
    }

    // public function addPoll() {
	// 	if (!$_SESSION['user']) {
	// 		header("Location: /");
	// 		return;
	// 	}

    //     $postData = file_get_contents("php://input");
    //     $data = json_decode($postData);
	
	// 	if (empty($_POST) || trim($_POST['name']) == '' || trim($_POST['options']) == '' || trim($_POST['status']) == '' || trim($_POST['option_name']) == '' && trim($_POST['option_votes']) == '') {
	// 		$name = $_POST['name'];
	// 		$options = (int)$_POST['options'];
	// 		$status = (int)$_POST['status'];
	
	// 		$optionNames = $_POST['option_name'];
	// 		$optionVotes = $_POST['option_votes'];
	
	// 		$this->model->addPoll($name, $options, $status, $optionNames, $optionVotes);
	// 		echo json_encode(array("success" => true, "text" => "OK"));
			
	// 	} else {
    //         // if (empty($data) || empty($data->pollName) || empty($data->pollOptions) || empty($data->pollStatus) || empty($data->pollOptionNames) || empty($data->polloptionVotes)) {
    //         //     echo json_encode(array("success" => false));
    //         //     return;
    //         // }
            
	// 		echo json_encode(array("success" => false));
	// 	}

    // public function addPoll() {
    //     if (!$_SESSION['user']) {
    //         header("Location: /");
    //         return;
    //     }
    
    //     $postData = file_get_contents("php://input");
    //     $data = json_decode($postData);
    //     error_log("Received data: " . print_r($data, true));

    //     if (empty($data->pollName) || empty($data->pollOptions) || empty($data->pollStatus) || empty($data->pollOptionsData)) {
    //         echo json_encode(array("success" => false));
    //         return;
    //     }
    
    //     $name = $data->pollName;
    //     $options = (int)$data->pollOptions;
    //     $status = (int)$data->pollStatus;
    
    //     $optionNames = [];
    //     $optionVotes = [];
    
    //     foreach ($data->pollOptionsData as $option) {
    //         $optionNames[] = $option->name;
    //         $optionVotes[] = $option->votes;
    //     }
    
    //     $this->model->addPoll($name, $options, $status, $optionNames, $optionVotes);
    //     echo json_encode(array("success" => true, "text" => "OK"));
    // }

    public function addPoll() {
        if (!$_SESSION['user']) {
            header("Location: /");
            return;
        }
    
        $postData = file_get_contents("php://input");
        error_log("Received data: " . $postData);
    
        $data = json_decode($postData, true);
        
        error_log("Received data: " . print_r($data, true));
    
        if (empty($data['pollName']) || empty($data['pollOptions']) || empty($data['pollStatus'])) {
            echo json_encode(array("success" => false));
            return;
        }
    
        $name = $data['pollName'];
        // $options = (int)$data['pollOptions'];
        // error_log(count($data['pollOptions']));
        $options = count($data['pollOptions']);
        $status = (int)$data['pollStatus'];
    
        $optionNames = [];
        $optionVotes = [];
    
        foreach ($data['pollOptions'] as $option) {
            $optionNames[] = $option['name'];
            $optionVotes[] = $option['votes'];
        }
    
        $this->model->addPoll($name, $options, $status, $optionNames, $optionVotes);
        echo json_encode(array("success" => true, "text" => "OK"));
    }
    
}    