# bus

The `bus` project is a set of (AWS) SNS and SQS resources for making eLife's projects communicate.

The available topics are defined [in the builder project elife.yaml](https://github.com/elifesciences/builder/blob/master/projects/elife.yaml). Each `type` is sent to the corresponding SNS topic.

Each project defines its own SQS queue and subscribe to the interesting SNS topics, receiving all messages into a single queue and distinguishing between them by looking at their content.

## Schemas

The schema of the JSON notifications being sent out follows these conventions (non-exhaustive examples).

The `type` field is always named like this, while the name of the identifier field is the responsibility of the project that emits the notification. Therefore, that application is free to name the identifier field `id` or to choose a natural key name like `number` (e.g. in the case of podcasts). The value of the identifier field should be a number or a string.

The allowed values for `type` correspond to the singular form of the SNS topics listed in [the bus project builder definition](https://github.com/elifesciences/builder/blob/master/projects/elife.yaml#L463). For example, `bus-podcast-episodes--{instance}` corresponding to a `"type":"podcast-episode"`.

### articles

```
{
    "type": "article",
    "id": "04518"
}
```

### collections

```
{
    "type": "collection",
    "id": "foobar"
}
```

### podcast episodes

```
{
    "type": "podcast-episode",
    "number": 4
}
```

### metrics

```
{
    "type": "metrics",
    "contentType": "article",
    "id": "230",
    "metric": "citations"
}
```
```
    "type": "metrics",
    "contentType": "article",
    "id": "10627",
    "metric": "views-downloads"
```

