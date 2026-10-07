<?php
return [

    'paths' => ['sanctum/csrf-cookie','my-recipes','recipes/*','me','recipes','recipes/my','api/*', 'register', 'login','admin/*','/admin/recipes','/favorites','/favorites/*','/admin/users/*','/categories','admin/categories/add','admin/categories','meal-plans','logout','/admin/comments','/admin/comments/*','meal-plans/*'],
    'allowed_methods' => ['*'],

    // Autoriser le frontend
    'allowed_origins' => ['http://localhost:5173'],
    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    // important pour les sessions/cookies
    'supports_credentials' => true,
];
