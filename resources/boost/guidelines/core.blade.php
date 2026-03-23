## Laravel Backed Enums

This project uses `webfox/laravel-backed-enums` to add utility methods to PHP backed enums.

### Creating Enums

Use `php artisan make:enum Name --string` or `--int`. The `Enum` suffix is appended automatically. All backed enums must implement the interface and use the trait:

```php
use Webfox\LaravelBackedEnums\BackedEnum;
use Webfox\LaravelBackedEnums\IsBackedEnum;

enum StatusEnum: string implements BackedEnum
{
    use IsBackedEnum;

    case ACTIVE   = 'active';
    case INACTIVE = 'inactive';
}
```

### Static Helpers (don't reinvent these)

- `StatusEnum::map()` — returns `['active' => 'Active', 'inactive' => 'Inactive']` (value => translated label)
- `StatusEnum::options()` — returns array of `['name' => ..., 'value' => ..., 'label' => ..., 'meta' => ...]` per case
- `StatusEnum::labels()` — returns array of translated labels
- `StatusEnum::values()` — returns array of raw values
- `StatusEnum::names()` — returns array of case names
- `StatusEnum::rule()` — returns an `Illuminate\Validation\Rules\Enum` instance for form validation

### Instance Methods

- `$enum->label()` — translated label for this case
- `$enum->toArray()` — returns `['name' => ..., 'value' => ..., 'label' => ..., 'meta' => ...]`
- `$enum->toHtml()` — returns the label (implements `Htmlable`)
- `$enum->toJson()` — JSON-encoded `toArray()` (implements `Jsonable`)

### Comparisons

Use the built-in comparison methods instead of writing `===` checks:

```php
$enum->is(StatusEnum::ACTIVE)        // or ->isA(), ->isAn()
$enum->isAny([StatusEnum::ACTIVE, StatusEnum::INACTIVE])
$enum->isNot(StatusEnum::ACTIVE)     // or ->isNotA(), ->isNotAn()
$enum->isNotAny([StatusEnum::ACTIVE, StatusEnum::INACTIVE])
```

These accept both enum instances and raw string/int values.

### Metadata

Override `withMeta()` to attach extra data per case:

```php
public function withMeta(): array
{
    return match ($this) {
        self::ACTIVE   => ['color' => 'green'],
        self::INACTIVE => ['color' => 'gray'],
    };
}
```

### Translations

@verbatim
Create `lang/{locale}/enums.php` keyed by fully-qualified class name:

```php
return [
    App\Enums\StatusEnum::class => [
        'active'   => 'Currently Active',
        'inactive' => 'Not Active',
    ],
];
```

If no translation exists, the raw value is returned as the label.
@endverbatim

### Casting JSON Columns

Use `AsFullEnumCollection` for JSON columns storing multiple enum values:

```php
protected function casts(): array
{
    return [
        'statuses' => \Webfox\LaravelBackedEnums\Casts\AsFullEnumCollection::of(StatusEnum::class),
    ];
}
```
