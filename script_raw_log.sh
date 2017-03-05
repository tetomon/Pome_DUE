
#!/bin/bash

#Script raw log

find /raw_log/* -type d -ctime +90 | xargs rm -rf

current=`date`
echo ===================== Start Log $current ============================
year=`date --date 'yesterday' +%Y`
month=`date --date 'yesterday' +%b`
day=`date --date 'yesterday' +%dd`
password="Metro*2016"

mkdir -p /raw_log/$year/$month/$day
remote_path=/BrowseByTime/$year/$month/$day/
local_path=/raw_log/$year/$month/$day

sshpass -p $password sftp -oBatchMode=no -P 23 NGCP@10.119.136.70

cd $filename
lcd $local_path
get -r *
close
exit
echo 'Complete copy rawlog'
echo ===================== End Log $current ============================


bash -x script_rawlog.sh > script_rawlog.log 2>&1

vi /etc/crontab
0 6 * * * /root/script_rawlog.sh >> /var/log/script_rawlog.log 2>&1
service crond status
service crond stop
service crond status
service crond start
