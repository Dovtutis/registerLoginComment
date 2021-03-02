<?php


namespace app\core;

use app\model\UserModel;

/**
 * Handles registration and login
 *
 * Class AuthController
 * @package app\core
 */
class AuthController extends Controller
{
    public Validation $validation;
    protected UserModel $userModel;

    public function __construct()
    {
        $this->validation = new Validation();
        $this->userModel = new UserModel();
    }

    /**
     * Register function will handle both registration GET and POST requests
     *
     * @param Request $request
     * @return string|string[]
     */
    public function register(Request $request)
    {
        if ($request->isGet()) :
            return $this->render('register');
        endif;

        if ($request->isPost()) :
            $data = $request->getBody();

            $data['errors']['nameError'] = $this->validation->validateNameSurname($data['name']);
            $data['errors']['surnameError'] = $this->validation->validateNameSurname($data['surname']);
            $data['errors']['emailError'] = $this->validation->validateEmail($data['email'], $this->userModel);
            $data['errors']['passwordError'] = $this->validation->validatePassword($data['password']);
            $data['errors']['passwordConfirmError'] = $this->validation->confirmPassword($data['passwordConfirm']);
            $data['errors']['phoneError'] = $this->validation->validatePhone($data['phone']);
            $data['errors']['addressError'] = $this->validation->validateAddress($data['address']);

            if ($this->validation->ifEmptyArray($data['errors'])) {
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                if ($this->userModel->register($data)) {
                    $response = 'registrationSuccessful';
                    header('Content-Type: application/json');
                    echo json_encode($response);
                } else {
                    die('Something went wrong in adding user to DB');
                }
            } else {
                header('Content-Type: application/json');
                echo json_encode($data);
            }
        endif;
    }


    /**
     * This function handles user login GET and POST requests
     * @param Request $request
     * @return string|string[]
     */
    public function login(Request $request)
    {

        if ($request->isGet()) :
            if (\app\core\Session::isUserLoggedIn()){
                $params = [
                    'name' => "Sporto Klubas",
                    'currentPage' => "home"
                ];
                return $this->render('index', $params);
            }else{
                return $this->render('login');
            }

        endif;

        if ($request->isPost()) :
            $data = $request->getBody();

            $data['errors']['emailError'] = $this->validation->validateLoginEmail($data['email'], $this->userModel);
            $data['errors']['passwordError'] = $this->validation->validateEmpty($data['password'], 'Please Enter Your Password');

            if ($this->validation->ifEmptyArray($data['errors'])) {
                $loggedInUser = $this->userModel->login($data['email'], $data['password']);
                if ($loggedInUser) {
                    $this->createUserSession($loggedInUser);
                    $response = 'loginSuccessful';
                    header('Content-Type: application/json');
                    echo json_encode($response);
                } else {
                    $data['errors']['passwordError'] = "Wrong password";
                    header('Content-Type: application/json');
                    echo json_encode($data);
                }
            }else{
                header('Content-Type: application/json');
                echo json_encode($data);
            }

        endif;
    }

    /**
     * Stores user ID, user email and user name in SESSION
     *
     * @param $userRow
     */
    public function createUserSession($userRow)
    {
        $_SESSION['user_id'] = $userRow->id;
        $_SESSION['user_email'] = $userRow->email;
        $_SESSION['user_name'] = $userRow->name;
    }

    /**
     * Logout function handles logout and unsets destroys session.
     *
     * @param Request $request
     */
    public function logout(Request $request)
    {
        if (\app\core\Session::isUserLoggedIn()){
            unset($_SESSION['user_id']);
            unset($_SESSION['user_email']);
            unset($_SESSION['user_name']);

            session_destroy();
            $request->redirect('/');
        }else{
            $request->redirect('/');
        }
    }
}