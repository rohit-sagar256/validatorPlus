<?php

use PHPUnit\Framework\TestCase;
use ValidatorPlus\Rules\RequiredRule;

class RequiredRuleTest extends TestCase
{


  public function test_passes_if_required_rule_is_true()
  {
    $rule = new RequiredRule();
    $this->assertTrue($rule->passes('name', 'hello dear'));
  }

  public function test_fails_if_required_rule_is_false()
  {
    $rule = new RequiredRule();
    $this->assertFalse($rule->passes('name', ''));
  }


  public function test_error_message_default()
  {
    $rule = new RequiredRule();
    $rule->passes('name', '');
    $this->assertEquals('The name field is required.', $rule->message('name'));
  }

  public function test_error_message_custom()
  {
    $rule = new RequiredRule();
    $rule->passes('name', '');
    $rule->customMessage('Something went wrong');
    $this->assertEquals('Something went wrong', $rule->message('name'));
  }
}
