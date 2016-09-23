<?php
return [
    'key' => getenv('AWS_ACCESS_KEY_ID'),
    'secret' => getenv('AWS_SECRET_ACCESS_KEY'),
    'region' => getenv('REGION') ? getenv('REGION') : 'us-east-1',
];
