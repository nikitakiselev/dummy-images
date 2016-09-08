<?php

$app->get('/', 'PageController@front');
$app->get('random', 'ImageController@random');
$app->get('random/{width}', 'ImageController@random');
$app->get('random/{width}/{height}', 'ImageController@random');
