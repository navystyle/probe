<?php
namespace App\Validation;

use Respect\Validation\Exceptions\NestedValidationException;
use Slim\Http\Request;

class Validator
{
    protected $errors = [];

    /**
     * @param Request $request
     * @param array $rules
     * @return $this
     */
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
        return join(" / ", $this->errors);
    }

    public function failed()
    {
        return !empty($this->errors);
    }
}