<?php

$files = array_merge(glob(__DIR__ . '/classes/*.php'), glob(__DIR__ . '/classes/**/*.php'));

foreach ($files as $file)
{
    include_once($file);
}