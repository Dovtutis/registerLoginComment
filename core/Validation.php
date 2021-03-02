<?php


namespace app\core;


class Validation
{
    private $password;

    /**
     * Checks if every array value is empty
     * @param array $arr
     * @return bool
     */
    public function ifEmptyArray($arr)
    {
        foreach ($arr as $value){
            if (!empty($value)) return false;
        }
        return true;
    }

    /**
     * Checks if given field is empty. Returns given message if empty.
     *
     * @param string $field
     * @param string $msg
     * @return string
     */
    public function validateEmpty($field, string $msg)
    {
        return empty($field) ? $msg : '';
    }

    /**
     * Validates Name or Surname field
     *
     * @param $field
     * @return string
     */
    public function validateNameSurname($field)
    {
        if (empty($field)) return "Please enter your Name";
        if (!preg_match("/^[a-z ,.'-ĄČĘĖĮŠŲŪŽ]+$/i", $field)) return "Name must only contain Name characters";
        if (preg_match('/[0-9]+/', $field)) return "Name must contain only letters";
        if (strlen($field)>40) return "Max symbol count 40";
        return '';
    }

    /**
     * Validates email field
     *
     * @param $field
     * @return string
     */
    public function validateEmail($field, &$userModel = null)
    {
        if (empty($field)) return "Please enter Your Email";
        if (filter_var($field, FILTER_VALIDATE_EMAIL) === false) return "Email is not correct, please use correct format";
        if ($userModel !== null) :
            if ($userModel->findUserByEmail($field)) return "Email already taken, use another email";
        endif;

        return '';
    }

    /**
     * Validates password field
     *
     * @param $field
     * @return string
     */
    public function validatePassword($field)
    {
        if (empty($field)) return "Please enter Your Password";
        if (strlen($field) < 6) return "Password must be minimum 6 characters long";
        if (strlen($field) > 40) return "Password must be maximum 40 characters long";
        if(!preg_match("#[0-9]+#", $field)) return "Password must include at least one number!";
        if(!preg_match("#[a-z]+#", $field)) return "Password must include at least one letter!";
        if(!preg_match("#[A-Z]+#", $field)) return "Password must include at least one capital letter!";
        $this->password = $field;
        return '';
    }

    /**
     * Validates confirm password field.
     *
     * @param $field
     * @return string
     */
    public function confirmPassword($field)
    {
        if (empty($field)) return "Please repeat your password";
        if (!$this->password) return "No password found";
        if ($field !== $this->password) return "Passwords must match";
        return '';
    }

    /**
     * Validate phone field.
     *
     * @param $field
     * @return string
     */
    public function validatePhone($field)
    {
        if(strlen($field)>0 && preg_match("/^[^0-9]*$/", $field)) return "Only numbers allowed!";
        return '';
    }

    /**
     * Validates address field.
     *
     * @param $field
     * @return string
     */
    public function validateAddress($field)
    {
        if (strlen($field)>=60) return "Maximum symbol count 60";
        return '';
    }

    /**
     * Validates login email field.
     *
     * @param $field
     * @param $userModel
     * @return string
     */
    public function validateLoginEmail($field, &$userModel)
    {
        if (empty($field)) return "Please enter Your Email";
        if (filter_var($field, FILTER_VALIDATE_EMAIL) === false) return "Email is not correct, please use correct format";
        if (!$userModel->findUserByEmail($field)) return "Email not found";
        return '';
    }

    /**
     * Validates comentar length.
     *
     * @param $field
     * @return string
     */
    public function validateBody($field)
    {
        if (empty($field)) return "Comment cannot be empty";
        if (strlen($field)>500) return "Max characters count 500!";
        return '';
    }
}