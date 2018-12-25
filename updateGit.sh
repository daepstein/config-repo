#!/bin/bash
echo  "Atualizando Github";
echo $(git add .);
echo $(git commit -m "atualizando");
echo $(git push);
exit;
