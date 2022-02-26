# EnvLoader
A PHP class to load environment variables from .env files

## Installation
Install it using composer:
```
composer require adistoe/env-loader
```

## Getting Started
Create a .env file or copy the .env.example (rename it to .env) and modify it as needed.\
Then you can load the file with the following code (do NOT add ".env" to the path):
```php
EnvLoader::load('path/to/your/project/');
```

If the file is loaded correctly you can access your environment variables with the following code:
```php
echo getenv('MY_ENV_VAR');
```
