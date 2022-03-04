# EnvLoader
A PHP class to load environment variables from .env files

## Getting Started
Create a .env file or copy the .env.example (rename it to .env) and modify it as needed.\
Then you can load the file with the following code:
```php
EnvLoader::load('path/to/your/project/');
```
If no .env file exists in the given path, the EnvLoader will automatically search for a .env file in all subdirectories.

If the file is loaded correctly you can access your environment variables with over the php function:
```php
getenv('NAME_OF_THE_VARIABLE');
```
