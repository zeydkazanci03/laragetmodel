# laragetmodel/laragetmodel

Laravel package to call model methods via a facade:

```php
use GetModel;

$user = GetModel::run('User')->find(1);
$user = GetModel::run(\App\Models\User::class)->someMethod();
```

## Features
- `GetModel::run('ModelName')` resolves `App\Models\ModelName` by default.
- You can pass a full class name (`\App\Models\User`) if needed.
- Configurable `base_model_namespace`.

## Requirements
- PHP >= 8.0 (compatible with PHP 8+)
- Laravel ^10.0

## Installation (dev / local)
Add repository to your project's `composer.json`:

```json
"repositories": [
  {
    "type": "vcs",
    "url": "https://github.com/YOUR_USER/laragetmodel"
  }
]
```

Then in your project:
```bash
composer require laragetmodel/laragetmodel:dev-main
```

Or use `path` repository during local testing.

## Usage
After installation the package registers automatically (Laravel package discovery). You can also add provider/alias manually in `config/app.php`:

```php
'providers' => [
    Laragetmodel\GetModel\Providers\GetModelServiceProvider::class,
],

'aliases' => [
    'GetModel' => Laragetmodel\GetModel\Facades\GetModel::class,
],
```

Config publish (optional):
```bash
php artisan vendor:publish --provider="Laragetmodel\GetModel\Providers\GetModelServiceProvider" --tag="config"
```

## Configuration
`config/getmodel.php` contains `base_model_namespace` (default `App\\Models\\`).

## License
MIT
