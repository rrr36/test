!/bin/bash

version=$1
ip=$2
zip /home/it490/versions/test$version.zip ./*
sshpass -p 'student' scp /home/it490/versions/test$version.zip it490@$ip:/home/it490/versions/
sshpass -p 'student' ssh it490@$ip "unzip -d /home/it490/test/ /home/it490/versions/test$version.zip"
