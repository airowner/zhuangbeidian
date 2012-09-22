<?php

$url  = 'http://item.taobao.com/item.htm?id=15312637279&ali_refid=a3_420961_1006:1102939026:6::9aaa5f1da4eff60973444b8ccb4331a3&ali_trackid=1_9aaa5f1da4eff60973444b8ccb4331a3';

$query = parse_url($url, PHP_URL_QUERY);

parse_str($query, $a);
var_export($a);
