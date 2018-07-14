<?php
namespace App\Validation;

use Respect\Validation\Exceptions\NestedValidationException;
use Slim\Http\Request;
use Slim\Http\Response;

class Validator
{
    protected $errors = [];

    public function validate(Request $request, array $rules)
    {
        foreach ($rules as $field => $rule) {
            try {
                $rule->setName(ucfirst($field))->assert($request->getParam($field));
            } catch (NestedValidationException $e) {
                $this->errors[$field] = $e->getFullMessage();
            }
        }

        return $this;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function failed()
    {
        return !empty($this->errors);
    }
}