# Laravel Env <!-- omit in toc -->

Laravel small package to locate, append and update `.env` keys.

![Laravel env](banner.png)

## Warning <!-- omit in toc -->

**TO BE ABLE TO UPDATE `.env` FILE THROUGH BROWSER YOU MAY NEED TO CHANGE `.env` FILE PERMISSIONS TO _755_. THIS WILL MAKE YOUR FILE WRITABLE VIA BROWSER.**

**YOU SHOULD NOT HAVE `.env` IN YOUR PUBLIC ROOT, EX: `public_html`**


## Table of contents <!-- omit in toc -->

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
