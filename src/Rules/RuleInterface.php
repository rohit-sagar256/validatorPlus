<?php

namespace ValidatorPlus\Rules;

interface RuleInterface
{
  public function passes($attribute, $value): bool;

  public function message(string $attribute): string;

  public function customMessage(string $msg): void;
}
