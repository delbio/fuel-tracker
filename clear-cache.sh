#!/usr/bin/env bash

# Clear Doctrine Caches
php app/console doctrine:cache:clear-metadata;
php app/console doctrine:cache:clear-query;
php app/console doctrine:cache:clear-result;

# Clear Symfony Caches
php app/console ca:cl --env=dev &&\
php app/console ca:cl --env=prod &&\
php app/console ca:cl --env=test