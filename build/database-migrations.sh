#!/bin/bash

git clone beacon-database-migrations:BeaconPlatform/database-migrations.git ~/database-migrations


# Attempt to find the feature branch for migrations. Or, check out develop.
(
cd ~/database-migrations
if [ `git branch -r --list | egrep "^  origin/+${CIRCLE_BRANCH}$"` ]
then
  echo "Checking out branch: '$CIRCLE_BRANCH'"
  git checkout $CIRCLE_BRANCH
else
  echo "Checking out develop..."
  git checkout develop
fi
)

# Run the migrations.
(
cd ~/database-migrations && \
composer install --prefer-source --no-interaction && \
cp .env.circleci .env && \
php artisan migrate:refresh --seed
)