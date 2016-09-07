<?php

$app->get('random', 'ImageController@random');
$app->get('random/{width}', 'ImageController@random');
$app->get('random/{width}/{height}', 'ImageController@random');
