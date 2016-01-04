<?php

namespace Rekurzia\log;

use yii\base\InvalidConfigException;
use yii\log\Logger;
use yii\log\Target;

class SentryTarget extends Target
{
    public $dsn;

    public $options = [];

    public $includeContextMessage = false;

    private $_client;

    public function init()
    {
        parent::init();
        if ($this->dsn === null) {
            throw new InvalidConfigException('The "dsn" property must be set.');
        }
    }

    /**
     * @return \Raven_Client
     */
    public function getClient()
    {
        if ($this->_client === null) {
            $this->_client = new \Raven_Client($this->dsn, $this->options);
        }

        return $this->_client;
    }

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