<?php


namespace app\core;


class Validation
{
    /**
     * validates empty field
     *
     * @param array $data
     * @param string $field
     * @param string $fieldDisplayName
     * @return void
     */

    public function validateName($field)
    {
        if (empty($field)) return "Please enter your Name";
        if (!preg_match("/^[a-z ,.'-ĄČĘĖĮŠŲŪŽ]+$/i", $field)) return "Name must only contain Name characters";
        if (preg_match('/[0-9]+/', $field)) return "Name must contain only letters";
        if (strlen($field)>40) return "Max symbol count 40";
        return '';
    }
}