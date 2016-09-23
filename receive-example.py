import boto3
import json
import os
import sys
import config

if __name__ == '__main__':
    if len(sys.argv) < 2:
        print "Usage: AWS_ACCESS_KEY_ID=... AWS_SECRET_ACCESS_KEY=... send-example.py topic '{\"key\":\"value\"}'"
        sys.exit(1)
    queue_name = sys.argv[1]

    sqs = boto3.resource('sqs', aws_access_key_id=config.aws_access_key_id, aws_secret_access_key=config.aws_secret_access_key, region_name=config.region)
    queue = sqs.get_queue_by_name(QueueName=queue_name)

    messages = []
    while not messages:
        print 'Looping...'
        messages = queue.receive_messages(
            MaxNumberOfMessages=1,
            VisibilityTimeout=60, # time allowed to call delete, can be increased
            WaitTimeSeconds=20 # maximum setting for long polling
        )
    message = messages[0]
    print "Message received!"
    message_contents = json.loads(message.body)
    print message_contents
    message.delete()

