# bus

The `bus` project is a set of (AWS) SNS and SQS resources for making eLife's projects communicate.

The available topics are defined [in the builder project elife.yaml](https://github.com/elifesciences/builder/blob/master/projects/elife.yaml).

Each project defines its own SQS queue and subscribe to the interesting SNS topics.

The schema of the JSON notifications being sent out follows these conventions (non-exhaustive examples):

```
{
    "type": "collection",
        "id": "foobar"
        }
```

```
{
    "type": "podcast-episode",
    "number": 4
}
```

```
{
    "type": "article",
    "id": "04518"
}
```

The `type` field is always named like this, while the name of the identifier field is the responsibility of the project that emits the notification.

