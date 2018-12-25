#!/bin/bash

while inotifywait -q -e modify /home/bitnami/htdocs/config-repo/config-repo/mining-development.yml>/dev/null; do
        echo "$(date) $line";

    echo "filename is changed".
echo  "Atualizando Github";
git add .;
git commit -m "atualizando";
git push;
 curl -X POST http://gomining-env.uppk4f29t3.sa-east-1.elasticbeanstalk.com/actuator/refresh
    # do whatever else you need to do
done
