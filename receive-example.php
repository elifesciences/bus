<?php
require_once 'vendor/autoload.php';
$config = include 'config.php';

if (count($argv) < 2) {
    echo "Usage: ./receive-example.php queue_name", PHP_EOL;
    exit(1);
}
$queue_name = $argv[1];

$sqs = new Aws\Sqs\SqsClient([
    'version' => 'latest',
    'region'  => $config['region'],
    'credentials' => [
        'key'    => $config['key'],
        'secret' => $config['secret'],
    ],
]);
$queue = $sqs->getQueueUrl([
     'QueueName' => $queue_name,
]);
$messages = [];
while (!$messages) {
    echo "Looping...", PHP_EOL;
    $messages = $sqs->receiveMessage([
        'QueueUrl' => $queue['QueueUrl'],
        'VisibilityTimeout' => 60, # time allowed to call delete, can be increased
        'WaitTimeSeconds' => 20, # maximum setting for long polling
    ]);
}
$message = $messages['Messages'][0];
$message_contents = json_decode($message['Body'], true);
echo "Message received!", PHP_EOL;
echo var_export($message_contents, true), PHP_EOL;
$sqs->deleteMessage([
    'QueueUrl' => $queue['QueueUrl'],
    'ReceiptHandle' => $message['ReceiptHandle'],
]);

