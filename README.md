# Enver <!-- omit in toc -->

Laravel small package to locate, append and update `.env` keys.

- [Available methods](#available-methods)
  - [get](#get)
  - [append](#append)
  - [replace](#replace)
  - [delete](#delete)
  - [locate](#locate)
- [Operations on `Line` object](#operations-on-line-object)
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

```php
$line = Enver::locate('APP_KEY');
```

## Operations on `Line` object

Line object represents for single line in env file. You can use the following methods:

### reset

```php
$line = Enver::locate('APP_KEY');

$line->reset(); // set to empty value
```
