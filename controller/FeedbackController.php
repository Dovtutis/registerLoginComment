<?php


namespace app\controller;


use app\core\Controller;
use app\core\Request;
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

    /**
     * Index function for feedback page which gives params and returns render.
     *
     * @return string|string[]
     */
    public function index ()
    {
        $params = [
            'name' => "Feedback Page",
            'currentPage' => "feedback"
        ];
        return $this->render('feedback', $params);
    }

    /**
     * GetComments function which requests all comments from comments model.
     */
    public function getComments()
    {
        $comments = $this->commentsModel->getComments();

        header('Content-Type: application/json');
        echo json_encode($comments);
    }

    /**
     * Function which validates inputs from comment form and sends request to the comments model for comment add.
     *
     * @param Request $request
     */
    public function addComment (Request $request)
    {
        $data = $request->getBody();

        $data['errors']['nameError'] = $this->validation->validateEmpty($data['name'], 'Name cant be empty');
        $data['errors']['bodyError'] = $this->validation->validateEmpty($data['body'], 'Please enter your comment');
        $data['errors']['bodyError'] = $this->validation->bodyLength($data['body']);

        if ($this->validation->ifEmptyArray($data['errors'])) {
            $data['user_id'] = $_SESSION['user_id'];
            if ($this->commentsModel->addComment($data)) {
                $response = 'commentAddedSuccessfully';
                header('Content-Type: application/json');
                echo json_encode($response);
            } else {
                die('Something went wrong in adding user to DB');
            }
        } else {
            header('Content-Type: application/json');
            echo json_encode($data);
        }
    }
}