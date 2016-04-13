#!/bin/sh
sh clear-cache.sh && bin/phpunit -c app/ $@
