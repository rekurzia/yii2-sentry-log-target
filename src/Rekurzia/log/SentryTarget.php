<?php

namespace Rekurzia\log;

use yii\base\InvalidConfigException;
use yii\log\Logger;
use yii\log\Target;

class SentryTarget extends Target
{
    /**
     * @var string Raven-compatible DSN
     */
    public $dsn;

    /**
     * @var array options to be passed to Raven Client
     */
    public $options = [];

    /**
     * @var boolean whether to include context message
     */
    public $includeContextMessage = false;

    private $_client;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        if ($this->dsn === null) {
            throw new InvalidConfigException('The "dsn" property must be set.');
        }
    }

    /**
     * Gets Raven Client instance.
     * @return \Raven_Client
     */
    public function getClient()
    {
        if ($this->_client === null) {
            $this->_client = new \Raven_Client($this->dsn, $this->options);
        }

        return $this->_client;
    }

    /**
     * Sends log message to Sentry instance.
     */
    public function export()
    {
        foreach ($this->messages as $message) {
            $options = [
                'level' => Logger::getLevelName($message[1]),
            ];

            $logMessage = $this->formatMessage($message);

            $text = $message[0];
            if (!is_string($text) && $text instanceof \Exception) {
                $logMessage = $text->getMessage() . "\n\n" . $logMessage;
            }

            $this->getClient()->captureMessage($logMessage, [], $options);
        }
    }

    /**
     * Ability to hide context message. See parent implementation for more details.
     * @return string
     */
    protected function getContextMessage()
    {
        return $this->includeContextMessage ? parent::getContextMessage() : '';
    }
}
