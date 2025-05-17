<?php

namespace ValidatorPlus\Rules;

abstract class AbstractRule implements RuleInterface
{
  protected ?string $label = null;

  public function setLabel(string $label): void
  {
    $this->label = $label;
  }

  protected function getLabelOr(string $fallback): string
  {
    return $this->label ?? $fallback;
  }
}
