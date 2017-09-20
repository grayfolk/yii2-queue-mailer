# bluespy/yii2-queue-mailer
Background mailer for Yii2 using [yii2 queue extension](https://github.com/yiisoft/yii2-queue/).

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist bluespy/yii2-queue-mailer
```

or add

```json
"bluespy/yii2-queue-mailer": "*"
```

## Usage

Under development.

Now you can send your emails as usual.
```
$message = \Yii::$app->mailer->compose()
  ->setSubject('test subject')
  ->setFrom('test@example.org')
  ->setHtmlBody('test body')
  ->setTo('user@example.org');

\Yii::$app->mailer->send($message);
```
