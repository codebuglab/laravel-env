# Enver <!-- omit in toc -->

Laravel small package to locate, append and update `.env` keys.

- [Available methods](#available-methods)
  - [get](#get)
  - [append](#append)
  - [replace](#replace)
  - [locate](#locate)

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

### locate

```php
Enver::locate('APP_KEY');
```
