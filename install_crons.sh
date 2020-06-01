#!/usr/bin/env bash
BASEDIR=$(dirname "$0")
FILE=/etc/cron.d/lineblocs
LINEBLOCS_APP=${BASEDIR}/app
if test -f "$FILE"; then
    echo "crontabs already exist in $FILE"
else
    touch $FILE
    echo "0 0 1 * * /bin/bash -c 'cd $LINEBLOCS_APP && php artisan monthlybill >> ./crons/monthly.txt'" >> $FILE
    echo "0 * * * * /bin/bash -c 'cd $LINEBLOCS_APP && php artisan emails:free-trial-ending >> ./crons/free-trial.txt'" >> $FILE
    echo "0 * * * * /bin/bash -c 'cd $LINEBLOCS_APP && php artisan send-bg-emails >> ./crons/bg-emails.txt'" >> $FILE
    echo "0 * * * * /bin/bash -c 'cd $LINEBLOCS_APP && php artisan cleanups:delete-unset-passwords  >> ./crons/delete-pwds.txt'" >> $FILE
    echo "0 * * * * /bin/bash -c 'cd $LINEBLOCS_APP && php artisan debuggerlogs:remove  >> ./crons/logs-removal.txt'" >> $FILE
  echo "Crons installed!"
fi
