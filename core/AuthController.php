<?php


namespace app\core;

/**
 * Handles registration and login
 *
 * Class AuthController
 * @package app\core
 */
class AuthController extends Controller
{
    public Validation $validation;

    public function __construct()
    {
        $this->validation = new Validation();
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
            $data['errors']['emailError'] = $this->validation->validateEmail($data['email']);
            $data['errors']['passwordError'] = $this->validation->validatePassword($data['password']);
            $data['errors']['passwordConfirmError'] = $this->validation->confirmPassword($data['confirmPassword']);
            $data['errors']['phoneError'] = $this->validation->validatePhone($data['phone']);
            $data['errors']['addressError'] = $this->validation->validateAddress($data['address']);

            header('Content-Type: application/json');
            echo json_encode($data);
        endif;
    }
}