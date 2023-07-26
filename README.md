# Nova prefiller field

A Laravel Nova field to prefill fields based on another field. Super Awesome!

## Installation

```bash
composer require marshmallow/prefiller-field
```

## Usage
```php
public function fields(Request $request)
{
    return [
		BelongsTo::make('Product')->nullable()->searchable(),

		PrefillerText::make('Test', 'field_2')
                    ->sourceField('product')
                    ->sourceModel(\Marshmallow\Product\Models\Product::class)
                    ->sourceColumn('external_id')
                    ->prefillWith('name'), // This can be a field or a method on your target resource

        PrefillerCurrency::make('Test 3', 'field_3')
                    ->sourceField('product')
                    ->sourceModel(\Marshmallow\Product\Models\Product::class)
                    ->prefillWith('price')
                    ->currency('EUR')
                    ->default(0)
                    ->nullable(),
	]
}
```

### Extra methods

I you want the prefiller to check for new values, even if the target field is already filled with content, you can call the method `allowUpdatingFilledFields()`.

### Supported

Currently we have only implemented the `Text` and `Currency` field because we needed it in a project for a customer. We will add more in the comming months. Feel free to send a pull request if you need another field for your project.

### Security

If you discover any security related issues, please email stef@marshmallow.dev instead of using the issue tracker.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
