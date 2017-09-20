<?php

/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 * @author Syakur Rahman <shaqman2004@yahoo.com>
 */

namespace shaqman\mailer\queuemailer;

use shaqman\yii2\queuemailer\jobs\SendMessageJob;
use shaqman\yii2\queuemailer\jobs\SendMultipleMessagesJob;
use yii\base\Component;
use yii\base\InvalidConfigException;
use yii\mail\MailerInterface;
use yii\mail\MessageInterface;
use yii\di\Instance;
use yii\queue\Queue;

class Mailer extends Component implements MailerInterface {

    /** @var MailerInterface */
    public $syncMailer;
    public $queue = 'queue';

    public function init() {
        parent::init();

        if (empty($this->syncMailer)) {
            throw new InvalidConfigException('Missing sync mailer configuration.s');
        }

        $this->syncMailer = Instance::ensure($this->syncMailer, MailerInterface::class);
        $this->queue = Instance::ensure($this->queue, Queue::class);
    }

    public function compose($view = null, array $params = []) {
        return $this->getSyncMailer()->compose($view, $params);
    }

    public function send($message) {
        $message = Instance::ensure($message, MessageInterface::class);

        $this->queue->push(new SendMessageJob([
            'message' => Instance::ensure($message, MessageInterface::class),
        ]));
    }

    public function sendMultiple(array $messages) {
        foreach ($messages as $message) {
            $message = Instance::ensure($message, MessageInterface::class);
        }

        $this->queue->push(new SendMultipleMessagesJob([
            'messages' => $messages,
        ]));
    }

}
