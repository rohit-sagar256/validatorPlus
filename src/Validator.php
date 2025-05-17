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

      foreach ($field->getRules() as $rule) {
        if (!$rule->passes($name, $value)) {
          $this->errors[$name][] = $rule->message();
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
