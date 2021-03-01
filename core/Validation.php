<?php


namespace app\core;


class Validation
{
    private $password;

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
    public function validateEmail($field)
    {
        if (empty($field)) return "Please enter Your Email";
        if (filter_var($field, FILTER_VALIDATE_EMAIL) === false) return "Email is not correct, please use correct format";
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

    public function confirmPassword($field)
    {
        if (empty($field)) return "Please repeat your password";
        if (!$this->password) return "No password found";
        if ($field !== $this->password) return "Passwords must match";
        return '';
    }

    public function validatePhone($field)
    {
        if(preg_match("/^[^0-9]*$/", $field)) return "Only numbers allowed!";
        return '';
    }

    public function validateAddress($field)
    {
        if (strlen($field)>=60) return "Maximum symbol count 60";
        return '';
    }
}