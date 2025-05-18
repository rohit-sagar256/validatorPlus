
[![Run Tests](https://github.com/rohit-sagar256/validatorPlus/actions/workflows/run-tests.yml/badge.svg)](https://github.com/rohit-sagar256/validatorPlus/actions/workflows/run-tests.yml)
# ValidatorPlus

**ValidatorPlus** is a lightweight, chainable validation package built in PHP — perfect for console applications, CLI tools, or any PHP project where you want custom and clean validation without relying on full-stack frameworks.

This package was created while learning **Composer**, **design patterns**, and **package publishing** — and has been structured to be **extensible**, **testable**, and **easy to use**.

---

## Installation

```bash
composer require rohit-sagar/validatorplus
```
---

## Why Use ValidatorPlus?

- Built using real design patterns (Chain of Responsibility, Strategy)
- Fully chainable syntax for rules
- Supports label (alias) for human-friendly error messages
- Fully tested using PHPUnit
- Easily extendable — add your own rules in seconds
- Designed for clarity and learning — perfect for devs who want to understand how validation works under the hood

---

## Quick Example

```php
use ValidatorPlus\Validator;

$data = [
    'name' => '',
    'email' => 'invalid-email'
];

$validator = new Validator();

$validator->field('name')
    ->label('Full Name')   // Optional alias
    ->required()
    ->min(3);

$validator->field('email')
    ->required()
    ->email();

if (!$validator->validate($data)) {
    print_r($validator->errors());
}
```

### Output

```php
[
    'name' => ['The Full Name field is required.'],
    'email' => ['The email must be a valid email address.']
]
```

---

## Available Rules (So far)

| Rule     | Description                         |
|----------|-------------------------------------|
| required | Field must be present and not empty |
| min:x    | Minimum string length               |
| max:x    | Maximum string length               |
| email    | Must be a valid email address       |

You can chain as many rules as you like on any field.

---

## Add Your Own Rule

You can define custom rules using the provided `RuleInterface`.

```php
use ValidatorPlus\Contracts\RuleInterface;

class StartsWithA implements RuleInterface
{
    protected string $label = '';

    public function passes(string $field, $value): bool {
        return is_string($value) && str_starts_with($value, 'A');
    }

    public function message(string $field): string {
        return "The {$this->label} must start with the letter A.";
    }

    public function setLabel(string $label): void {
        $this->label = $label;
    }
}
```

### Use it in validation

```php
$validator->field('nickname')
    ->label('Nickname')
    ->addRule(new StartsWithA());
```

This approach allows you to add as many custom rules as you want no need to modify the core.

---

## Aliases / Labels

Use `.label()` to define a human-readable name for a field, which is reflected in error messages:

```php
$validator->field('email')->label('Email Address')->required();
```

Error will say `The Email Address field is required.`

---

## Testing

This package includes tests using PHPUnit.

```bash
vendor/bin/phpunit
```

You can add more tests to the `tests/` folder to ensure coverage of all your custom rules and logic.

---

**Structure:**
```
src/
├── Validator.php           // Main entry point
├── FieldValidator.php      // Handles rule chains for a field
├── Contracts/
│   └── RuleInterface.php   // Interface for all rules
├── Rules/
│   ├── RequiredRule.php
│   ├── MinRule.php
│   ├── MaxRule.php
│   └── EmailRule.php
tests/
composer.json
```

---

##  Notes

This library was built as a learning project and is designed to be easy to read and extend. You are encouraged to:

- Create and share your own rules
- Fork and improve it further
- Use it in CLI tools or simple web backends

If you’re learning design patterns, open the source and explore how each part connects. The code is your teacher.

---

## License

MIT — use it freely in personal or commercial projects.
