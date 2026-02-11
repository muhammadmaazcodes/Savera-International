<?php

return [
  'accounts' => [
    'default' => [
        'host'          => 'mail.app.saveraaintl.com',
        'port'          => 993,
        'protocol'      => 'imap',
        'validate_cert' => env('IMAP_VALIDATE_CERT', true),
        'username'      => 'test-savera@app.saveraaintl.com',
        'password'      => 'd#O=Rp,]D$!j',
    ],
],
];