![alt text](https://marshmallow.dev/cdn/media/logo-red-237x46.png "marshmallow.")

# Nova Prefiller Field

[![Latest Version on Packagist](https://img.shields.io/packagist/v/marshmallow/prefiller-field.svg?style=flat-square)](https://packagist.org/packages/marshmallow/prefiller-field)
[![PHP Syntax Checker](https://img.shields.io/github/actions/workflow/status/marshmallow-packages/prefiller-field/php-syntax-checker.yml?branch=main&label=syntax&style=flat-square)](https://github.com/marshmallow-packages/prefiller-field/actions/workflows/php-syntax-checker.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/marshmallow/prefiller-field.svg?style=flat-square)](https://packagist.org/packages/marshmallow/prefiller-field)

A Laravel Nova field to prefill fields based on another field. Super Awesome!

When a source field (for example a `BelongsTo` relation) changes in a Nova form, the prefiller field looks up the selected model and fills itself with a value taken from that model — either an attribute or a method on it.

## Installation

Install the package via Composer:

```bash
composer require marshmallow/prefiller-field
```

The package registers its service provider automatically through Laravel's package discovery, so there is nothing else to set up.

## Usage

Use the prefiller fields inside a Nova resource's `fields()` method. Point each field at the source field with `sourceField()`, tell it which model to look up with `sourceModel()`, and choose the attribute or method to copy with `prefillWith()`.

```php
use Laravel\Nova\Fields\BelongsTo;
use Marshmallow\PrefillerField\PrefillerText;
use Marshmallow\PrefillerField\PrefillerCurrency;

public function fields(Request $request)
{
    return [
        BelongsTo::make('Product')->nullable()->searchable(),

        PrefillerText::make('Test', 'field_2')
            ->sourceField('product')
            ->sourceModel(\Marshmallow\Product\Models\Product::class)
            ->prefillWith('name'), // This can be a field or a method on your target resource

        PrefillerCurrency::make('Test 3', 'field_3')
            ->sourceField('product')
            ->sourceModel(\Marshmallow\Product\Models\Product::class)
            ->prefillWith('price')
            ->currency('EUR')
            ->default(0)
            ->nullable(),
    ];
}
```

### Available methods

Every prefiller field inherits the standard Nova field methods plus the following helpers from the `Prefillable` trait:

| Method | Description |
| --- | --- |
| `sourceField($source_field)` | The attribute of the field that triggers the prefill (for example the `BelongsTo` relation). |
| `sourceModel($source_model)` | The fully-qualified model class that is looked up when the source field changes. |
| `prefillWith($prefill_with)` | The attribute or method on the looked-up model whose value is used to prefill the field. |
| `allowUpdatingFilledFields()` | Re-check for new values even when the target field already has content (by default a filled field is left untouched). |
| `fieldType($type)` | Override the field type passed to the front-end component. |

### Extra methods

If you want the prefiller to check for new values, even if the target field is already filled with content, you can call the method `allowUpdatingFilledFields()`.

### Supported fields

Currently we have only implemented the `Text` and `Currency` fields because we needed them in a project for a customer. We will add more in the coming months. Feel free to send a pull request if you need another field for your project.

- `Marshmallow\PrefillerField\PrefillerText` — extends Nova's `Text` field.
- `Marshmallow\PrefillerField\PrefillerCurrency` — extends Nova's `Currency` field.

## Security Vulnerabilities

If you discover any security related issues, please email stef@marshmallow.dev instead of using the issue tracker.

## Credits

- [Marshmallow](https://github.com/marshmallow-packages)
- [All Contributors](https://github.com/marshmallow-packages/prefiller-field/contributors)

## License

The MIT License (MIT). Please see the [License File](LICENSE.md) for more information.
