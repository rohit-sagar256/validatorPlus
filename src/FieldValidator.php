<?php

namespace ValidatorPlus;

use ValidatorPlus\Rules\RequiredRule;
use ValidatorPlus\Rules\RuleInterface;

class FieldValidator
{
  protected string $field;

  protected array $rules = [];

  protected ?string $label = null;

  protected ?string $alias = null;

  public function __construct(string $field)
  {
    $this->field = $field;
  }


  public function required(string $attribute = null, string $message = null): self
  {
    $rule = new RequiredRule();

    if ($message) {
      $rule->customMessage($message);
    }

    $this->rules[] = $rule;
    return $this;
  }


  public function addRule(RuleInterface $rule): self
  {
    $this->rules[] = $rule;
    return $this;
  }


  public function alias(string $alias): self
  {
    $this->alias = $alias;
    return $this;
  }

  public function label(string $label): self
  {
    $this->label = $label;
    return $this;
  }

  public function getKey()
  {
    return $this->alias ?? $this->field;
  }

  public function getLable(): string
  {
    return $this->label ?? $this->field;
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
