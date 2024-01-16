#!/bin/bash
# run
# chmod 755 docker-entrypoint.sh
composer install --no-interaction

/app/bin/console doctrine:database:create

/app/bin/console make:migration -n

/app/bin/console doctrine:migrations:migrate -n

/usr/bin/supervisord -c /etc/supervisor/conf.d/messenger-worker.conf