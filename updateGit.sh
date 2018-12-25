#!/bin/bash
echo  "Atualizando Github";
echo $(git add .);
echo $(git commit -m "atualizando");
git push;
exit;
