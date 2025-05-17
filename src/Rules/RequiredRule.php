<?php

namespace ValidatorPlus\Rules;

use ValidatorPlus\Rules\RuleInterface;

class RequiredRule implements RuleInterface
{

  protected ?string $customMessage = null;
  protected ?string $label = null;

  public function passes($attribute, $value): bool
  {
    return !is_null($value) && $value !== '';;
  }

  public function message(string $attribute): string
  {
    $msg =  $this->customMessage ?? "The :attribute field is required.";
    return str_replace(
      [':attribute'],
      [$this->label ?? $attribute],
      $msg
    );
  }

  public function customMessage(string $msg): void
  {
    $this->customMessage = $msg;
  }

  public function setLabel(string $label): void
  {
    $this->label = $label;
  }
}
