<?php

namespace App\Traits;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

/**
 * Dynamic inputs
 */
trait HasDynamicInput
{
    public $defaultInputs;

    public $inputs;
    public $input_limit = [];

    public function defineInputs(callable $callable)
    {
        $this->defaultInputs = $callable();
    }

    public function fillInputs()
    {
        $this->inputs = $this->defaultInputs;
    }


    public function add($field_group)
    {
        if ($this->input_limit && array_key_exists($field_group, $this->input_limit)) {

            $input_limit = $this->input_limit[$field_group];

            if (!count($this->inputs[$field_group]) < $input_limit) {
                return;
            }
        }
        array_push($this->inputs[$field_group], $this->defaultInputs[$field_group][0]);
    }

    public function remove($key, $field_group)
    {
        if (method_exists($this, 'handleBeforeInputRemove'))
        {
            $this->{'handleBeforeInputRemove'}($key, $field_group);
        }
        unset($this->inputs[$field_group][$key]);
        if (method_exists($this, 'handleAfterInputRemove'))
        {
            $this->{'handleAfterInputRemove'}($field_group);
        }
    }

    /**
     * Validate dynamic inpits
     *
     */
    private function validateInputs($input, $rules, $messages = [], $customAttributes = [])
    {
        $item = Str::singular($input);
        $validator = Validator::make(
            ['inputs' => $this->inputs],
            $rules,
            $messages,
            $customAttributes ?: ["inputs.$input.*.$item" => $item]
        );

        return $validator;
    }

    /**
     * Creates rules for inputs
     *
     * @param array $rules
     * @return array
     */
    protected function inputRules(array $rules)
    {

        $rules_arr = [];


        foreach ($this->inputs as $group_key => $group) {

            foreach ($group[0] as $element_key => $element) {

                // inputs.emails.*.email = [rules]
                if (array_key_exists($element_key, $rules[$group_key])) {
                    $rules_arr['inputs' . '.' . $group_key . '.*.' . $element_key] =  $rules[$group_key][$element_key];
                }
            }
        }

        return $rules_arr;
    }


    /**
     * Change the input keys to match the validation attributes
     */
    protected function inputValidationAttributes(array $fields = [])
    {

        $inputValidationAttributes = [];

        foreach ($this->inputs as $group_key => $group) {

            foreach ($group[0] as $element_key => $element) {

                // inputs.emails.*.email
                $inputValidationAttributes['inputs' . '.' . $group_key . '.*.' . $element_key] =  array_key_exists($element_key, $fields[$group_key]) ? $fields[$group_key][$element_key] : $element_key;
            }
        }

        return $inputValidationAttributes;
    }
}
