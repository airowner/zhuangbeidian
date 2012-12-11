#!/bin/bash

query_file=/usr/local/coreseek/var/log/query.log

/bin/cat $query_file | /bin/awk -F ']' '{if($4){print $4}}' | /bin/sort | /usr/bin/uniq  | /usr/bin/head -n 6 > /tmp/query_log
