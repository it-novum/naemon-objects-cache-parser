#!/usr/bin/php
<?php

/**
 * This script parses the objects.cache of Naemon or Nagios and prints
 * out a list of all ipaddresses and the corresponding hostname
 * 
 * @author Daniel Ziegler 2021
 * @license MIT License
 * 
 * Example Output:
 * 127.0.0.1    localhost
 * 192.168.0.1  router
 * 127.1.2.3    just another localhost
 * 8.8.8.8  Google DNS
 * 
 */

$objectsCache = fopen('/opt/openitc/naemon/var/objects.cache', 'r');
$hostContent = [];
$saveContent = false;

while (!feof($objectsCache)) {
    $line = trim(fgets($objectsCache));
    if ($line == "define host {") {
        $saveContent = true;
        $section = [];
        continue;
    }

    if ($line == "}" && $saveContent === true) {
        $saveContent = false;
        $hostContent[] = $section;
    }

    if ($saveContent) {
        $tmp = explode("\t", $line);
        $section[$tmp[0]] = $tmp[1] ?? '';
        unset($tmp);
    }
}

foreach($hostContent as $host){
    echo $host['address'] . "\t" . $host['host_name'] . "\n";
}

