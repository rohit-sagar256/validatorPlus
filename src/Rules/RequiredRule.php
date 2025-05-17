<?php

namespace ValidatorPlus\Rules;

use ValidatorPlus\Rules\RuleInterface;

class RequiredRule implements RuleInterface
{

  protected ?string $customMessage = null;

  public function passes($attribute, $value): bool
  {
    return !is_null($value) && $value !== '';;
  }

  public function message(string $attribute): string
  {
    return $this->customMessage ?? "This {$attribute} field is required";
  }

  public function customMessage(string $msg): void
  {
    $this->customMessage = $msg;
  }
}
