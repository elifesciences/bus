<?php
require_once 'vendor/autoload.php';
$config = include 'config.php';

if (count($argv) < 3) {
    echo "Usage: ./send-example.php topic_name '{\"key\":\"value\"}'", PHP_EOL;
    exit(1);
}
$topic_name = $argv[1];
$message = $argv[2];

$sns = new Aws\Sns\SnsClient([
    'version' => 'latest',
    'region'  => $config['region'],
    'credentials' => [
        'key'    => $config['key'],
        'secret' => $config['secret'],
    ],
]);
$topic = $sns->createTopic([
     'Name' => $topic_name,
]);
$sns->publish([
    'TopicArn' => $topic['TopicArn'],
    'Message' => $message,
]);
echo "Message sent!", PHP_EOL;

