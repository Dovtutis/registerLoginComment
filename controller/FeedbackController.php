<?php


namespace app\controller;


use app\core\Controller;
use app\core\Validation;
use app\model\UserModel;

/**
 * This handles Feedback Page GET and POST requests
 * @return string|string[]
 */
class FeedbackController extends Controller
{
    public Validation $validation;
    protected UserModel $userModel;

    public function __construct()
    {
        $this->validation = new Validation();
        $this->userModel = new UserModel();
    }

    public function index (){
        $params = [
            'name' => "Feedback Page",
            'currentPage' => "feedback"
        ];
        return $this->render('feedback', $params);
    }
}