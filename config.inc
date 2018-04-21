<?php

$servername = '127.0.0.1';
$username = 'root';
$password = 'root';
$dbname = 'museumcode';

// Needed for the GitHub API
$opts = [
        'http' => [
                'method' => 'GET',
                'header' => [
                        'User-Agent: PHP'
                ]
        ]
];
$context = stream_context_create($opts);


?>
