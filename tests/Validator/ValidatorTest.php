<?php

namespace Tests\Validator;

use PHPUnit\Framework\TestCase;
use ValidatorPlus\Validator;

class ValidatorTest extends TestCase
{


  public function test_required_rule_passes_through_validator()
  {
    $data = ['name' => 'Rohit'];
    $validator = new Validator();
    $validator->field('name')->required();
    $this->assertTrue($validator->validate($data));
    $this->assertEmpty($validator->errors());
  }
}
