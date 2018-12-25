#!/bin/bash

while inotifywait -q -e modify /home/bitnami/htdocs/config-repo/config-repo/mining-development.yml>/dev/null; do
    echo "filename is changed"
echo  "Atualizando Github";
git add .;
git commit -m "atualizando";
git push;
    # do whatever else you need to do
done
