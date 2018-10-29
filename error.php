<?php

$val = true;
do{

shell_exec("touch /tmp/error.log");
shell_exec("sudo sshpass -p 'student' scp /tmp/event.log it490@192.168.1.13:/home/it490/");
echo("sucess");
}while($val);

?>
