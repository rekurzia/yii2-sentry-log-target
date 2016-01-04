# Yii2 Sentry log target

Yii2 log target sends log messages to your Sentry instance.

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

where:

- `includeContextMessage` is optional, default `false`
- `options` is optional, default `[]`

## License

MIT. See LICENSE file.