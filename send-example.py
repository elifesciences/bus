import boto3
import json
import os
import sys
import config

if __name__ == '__main__':
    if len(sys.argv) < 3:
        print "Usage: AWS_ACCESS_KEY_ID=... AWS_SECRET_ACCESS_KEY=... send-example.py topic '{\"key\":\"value\"}'"
        sys.exit(1)
    topic_name = sys.argv[1]
    message = sys.argv[2]

    sns = boto3.client('sns', aws_access_key_id=config.aws_access_key_id, aws_secret_access_key=config.aws_secret_access_key, region_name=config.region)
    # idempotent, the only sane way to retrieve a topic ARN
    topic = sns.create_topic(Name=topic_name)
    sns.publish(
        TopicArn=topic['TopicArn'],
        Message=message
    )
    print 'Message sent!'
