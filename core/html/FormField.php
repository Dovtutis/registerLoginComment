<?php


namespace app\core\html;


class FormField
{
    private string $id;
    private string $name;
    private string $class;
    private string $labelName;
    private string $required;
    private array $params;
    private string $type = 'text';

    /**
     * FormField constructor.
     * @param string $id
     * @param string $name
     * @param string $class
     * @param string $labelName
     * @param string $type
     * @param string $required
     * @param array $params
     */

    public function __construct(string $id, string $name, string $class, string $labelName, string $type, string $required, array $params = [])
    {
        $this->id = $id;
        $this->name = $name;
        $this->class = $class;
        $this->labelName = $labelName;
        $this->type = $type;
        $this->required = $required;
        $this->params = $params;
    }

    public function __toString()
    {
        $invalidFeedbackText = $this->params['errors'][$this->name."Error"];
        $validClass = !empty($this->params['errors'][$this->name."Error"]) ? 'is-invalid' : '';

        return <<<STRING
        
        <div class="form-group">
            <label for="$this->id">$this->labelName <sup>$this->required</sup></label>
            <input type="$this->type" class="$validClass form-control form-control-lg"
                   name="$this->name" id="$this->id" value="{$this->params['name']}">
            <span class="invalid-feedback">$invalidFeedbackText</span>
        </div>
STRING;

    }
}