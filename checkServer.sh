#!/bin/bash
#NOTIFYEMAIL=<your email>
#SMSEMAIL=<cell phone number @ sms-gateway>
#SENDEREMAIL=alert@localhost
SERVER=http://192.168.43.179/
PAUSE=10
FAILED=0
DEBUG=0

while true 
do
/usr/bin/curl -sSf $SERVER > /dev/null 2>&1
CS=$?
# For debugging purposes
if [ $DEBUG -eq 1 ]
then
    echo "STATUS = $CS"
    echo "FAILED = $FAILED"
    if [ $CS -ne 0 ]
    then
        echo "$SERVER is down"

    elif [ $CS -eq 0 ]
    then
        echo "$SERVER is up"
    fi
fi

# If the server is down and no alert is sent - alert
if [ $CS -ne 0 ] && [ $FAILED -eq 0 ]
then
    FAILED=1
    if [ $DEBUG -eq 1 ]
    then
        echo "$SERVER failed"
    fi
    if [ $DEBUG = 0 ]
    then
        echo "$SERVER went down $(date)"
        echo "Switching to backup"
        sed -i 's/testServer/prodExchange/g' testRabbitMQClient.php
    fi

# If the server is back up and no alert is sent - alert
elif [ $CS -eq 0 ] && [ $FAILED -eq 1 ]
then
    FAILED=0
    if [ $DEBUG -eq 1 ]
    then
        echo "$SERVER is back up"
    fi
    if [ $DEBUG = 0 ]
    then echo "$SERVER is back up"
    fi
    if [ $DEBUG = 0 ]
    then
        echo "$SERVER is back up $(date)" 
        echo "Switchiing to primary"
        sed -i 's/prodExchange/testServer/g' testRabbitMQClient.php
    fi
fi  
sleep $PAUSE
done
~             
       
                                                                                                                                                                                          1,1           Top
