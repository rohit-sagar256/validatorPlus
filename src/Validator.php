<?php

namespace ValidatorPlus;

class Validator
{
  protected array $fields = [];
  protected array $errors = [];


  public function field(string $name): FieldValidator
  {
    $fieldValidator = new FieldValidator($name);
    $this->fields[$name] = $fieldValidator;
    return $fieldValidator;
  }


  public function validate(array $data): bool
  {
    $this->errors = [];

    foreach ($this->fields as $name => $field) {
      $value = $data[$name] ?? null;
      $fieldKey = $field->getKey();

      foreach ($field->getRules() as $rule) {

        if (method_exists($rule, "setLabel")) {
          $rule->setLabel($field->getLable());
        }

        if (!$rule->passes($name, $value)) {
          $this->errors[$fieldKey][] = $rule->message($fieldKey);
        }
      }
    }
    return empty($this->errors);
  }

  public function errors(): array
  {
    return $this->errors;
  }
}
