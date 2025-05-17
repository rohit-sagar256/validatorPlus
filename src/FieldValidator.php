<?php

namespace ValidatorPlus;

use ValidatorPlus\Rules\RequiredRule;

class FieldValidator
{
  protected string $field;

  protected array $rules = [];

  public function __construct(string $field)
  {
    $this->field = $field;
  }


  public function required(string $message = null): self
  {
    $rule = new RequiredRule();

    if ($message) {
      $rule->customMessage($message);
    }

    $this->rules[] = $rule;
    return $this;
  }

  public function getRules(): array
  {
    return $this->rules;
  }

  public function getField(): string
  {
    return $this->field;
  }
}
