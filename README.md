# Laravel Env <!-- omit in toc -->

Laravel small package to locate, append and update `.env` keys.

![Laravel env](banner.png)

- [Available methods](#available-methods)
  - [get](#get)
  - [append](#append)
  - [replace](#replace)
  - [delete](#delete)
  - [locate](#locate)
  - [reset](#reset)

## Available methods

### get

```php
LaravelEnv::get('APP_KEY', 'default');
```

### append

```php
LaravelEnv::append('LOG_CHANNEL', 'daily');
```

### replace

```php
LaravelEnv::replace('APP_KEY', 'another key');
```

### delete

```php
LaravelEnv::delete('FOO');
```

### locate

Returns a `CodeBugLab\LaravelEnv\Line` object

```php
$line = LaravelEnv::locate('APP_KEY');
```

### reset

Set to empty value

```php
LaravelEnv::reset('APP_KEY'); // APP_KEY=""
```
