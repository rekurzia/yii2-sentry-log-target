# Yii2 Sentry log target

[![Latest Stable Version](https://poser.pugx.org/rekurzia/yii2-sentry-log-target/v/stable)](https://packagist.org/packages/rekurzia/yii2-sentry-log-target)
[![License](https://poser.pugx.org/rekurzia/yii2-sentry-log-target/license)](https://packagist.org/packages/rekurzia/yii2-sentry-log-target)

Yii2 log target which sends log messages to your Sentry instance.

## Installation

Using Composer:

```
composer require rekurzia/yii2-sentry-log-target
```

## Usage

Add Sentry target to your configuration

```php
$config['components']['log']['targets'] = [
    [
        'class' => 'Rekurzia\log\SentryTarget',
        'levels' => ['error', 'warning'],
        'dsn' => 'https://abcdefgh:12345678@sentry.example.com/1',
        'includeContextMessage' => true,
        'options' => [
            'message_limit' => 2048,
        ],
    ],
];
```

## Configuration

### `dsn`

Raven-compatible DSN.

### `options`

These options will be passed to `Raven_Client` constructor

### `includeContextMessage`

This option allows you to hide `info` level context message.

By default Yii generates also context message for you. It means that there will
be two messages logged to your Sentry instance on error. First with `error`
level, second with `info` level.

## License

MIT. See LICENSE file.
