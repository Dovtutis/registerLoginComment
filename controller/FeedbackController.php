<?php


namespace app\controller;


use app\core\Controller;
use app\core\Validation;
use app\model\CommentsModel;
use app\model\UserModel;

/**
 * This handles Feedback Page GET and POST requests
 * @return string|string[]
 */
class FeedbackController extends Controller
{
    public Validation $validation;
    private CommentsModel $commentsModel;
    protected UserModel $userModel;

    public function __construct()
    {
        $this->validation = new Validation();
        $this->userModel = new UserModel();
        $this->commentsModel = new CommentsModel();
    }

    public function index (){
        $params = [
            'name' => "Feedback Page",
            'currentPage' => "feedback"
        ];
        return $this->render('feedback', $params);
    }

    public function getComments() {
        $comments = $this->commentsModel->getComments();

        header('Content-Type: application/json');
        echo json_encode($comments);
    }
}