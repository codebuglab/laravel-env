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
Enver::get('APP_KEY', 'default');
```

### append

```php
Enver::append('LOG_CHANNEL', 'daily');
```

### replace

```php
Enver::replace('APP_KEY', 'another key');
```

### delete

```php
Enver::delete('FOO');
```

### locate

Returns a `CodeBugLab\Enver\Line` object

```php
$line = Enver::locate('APP_KEY');
```

### reset

Set to empty value

```php
Enver::reset('APP_KEY'); // APP_KEY=""
```
