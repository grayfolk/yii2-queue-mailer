<?php

/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 * @author Syakur Rahman <shaqman2004@yahoo.com>
 */

namespace eto\mailer\queuemailer\jobs;

use eto\yii2\queuemailer\Mailer;
use yii\di\Instance;
use \yii\queue\Job;
use yii\mail\MessageInterface;

class SendMultipleMessagesJob extends Object implements Job {

    /** @var MessageInterface */
    public $messages;

    /** @var string|array */
    public $mailer = 'mailer';

    public function execute($queue) {
        $this->mailer = Instance::ensure($this->mailer, Mailer::class);
        return $this->message->sendMultiple($this->mailer);
    }

}
