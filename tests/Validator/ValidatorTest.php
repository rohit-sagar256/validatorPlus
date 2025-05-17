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

  public function test_required_rule_fails_through_validator()
  {
    $data = ['name' => ''];
    $validator = new Validator();
    $validator->field('name')->required();
    $this->assertFalse($validator->validate($data));
    $expectedErrors = [
      'name' => [
        'The name field is required.',
      ],
    ];

    $this->assertEquals($expectedErrors, $validator->errors());
  }


  public function test_field_key_can_name_can_be_changed_using_alias_and_show_in_errors()
  {
    $data = ['name' => ''];
    $aliasName = 'username';
    $validator = new Validator();
    $validator->field('name')->required()->alias($aliasName);
    $this->assertFalse($validator->validate($data));
    $expectedErrors  = [
      'username' => ['The name field is required.']
    ];
    $this->assertEquals($expectedErrors, $validator->errors());
  }

  public function test_field_attribute_name_can_be_changed_using_label_and_show_in_errors_message()
  {

    $data = ['name' => ''];

    $labelname = 'username';

    $validator = new Validator();

    $validator->field('name')->required()->label($labelname);

    $this->assertFalse($validator->validate($data));

    $expectedErrors  = [
      'name' => ['The username field is required.']
    ];

    $this->assertEquals($expectedErrors, $validator->errors());
  }


  public function test_field_key_name_and_label_can_be_changed_and_show_in_errors()
  {

    $data = ['name' => ''];

    $labelname = 'User name';
    $alias = 'username';

    $validator = new Validator();

    $validator->field('name')->required()->label($labelname)->alias($alias);

    $this->assertFalse($validator->validate($data));

    $expectedErrors  = [
      'username' => ['The User name field is required.']
    ];

    $this->assertEquals($expectedErrors, $validator->errors());
  }
}
