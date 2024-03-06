<?php

return [

    /*
    |-----------------------------------------------------------------------------
    | Your GetStream.io API credentials (you can them from getstream.io/dashboard)
    |-----------------------------------------------------------------------------
    |
    */

    'api_key' => '329fxvd8szdn',
    'api_secret' => 't6tagenu8v8tx2zhzav7neekw8nx6nf56883w3r6zg9bz5avbgr3k3kpa9btp9zm',
    'api_app_id' => '1289302',
    /*
    |-----------------------------------------------------------------------------
    | Client connection options
    |-----------------------------------------------------------------------------
    |
    */
    'location' => '',
    'timeout' => 3,
    /*
    |-----------------------------------------------------------------------------
    | The default feed manager class
    |-----------------------------------------------------------------------------
    |
    */

    'feed_manager_class' => 'GetStream\StreamLaravel\StreamLaravelManager',

    /*
    |-----------------------------------------------------------------------------
    | The feed that keeps content created by its author
    |-----------------------------------------------------------------------------
    |
    */
    'user_feed' => 'user',
    /*
    |-----------------------------------------------------------------------------
    | The feed containing notification activities
    |-----------------------------------------------------------------------------
    |
    */
    'notification_feed' => 'notification',
    /*
    |-----------------------------------------------------------------------------
    | The feeds that shows activities from followed user feeds
    |-----------------------------------------------------------------------------
    |
    */
    'news_feeds' => [
        'timeline' => 'timeline',
        'timeline_aggregated' => 'timeline_aggregated',
    ]
];
