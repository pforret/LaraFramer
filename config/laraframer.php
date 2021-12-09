<?php

return [

    /*
    config for LaraFramer application
    */

    'rss' => env("FRAMER_RSS" , "https://www.flickr.com/services/feeds/photos_public.gne?tags=tesla"),
    'folder'    =>  env("FRAMER_FOLDER",'images'),
    'seconds'   =>  env("FRAMER_SECONDS", 60),
    'transition'    =>  env("FRAMER_TRANSITION","fade"),

    ];
