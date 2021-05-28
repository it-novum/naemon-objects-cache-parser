# naemon-objects-cache-parser
This is a super simple script which parses the objects.cache file of Naemon and Nagios

The output of the script will be a list of all ipaddresses and the corresponding hostname
seperated by tab character `\t`

Example:
```
 127.0.0.1    localhost
 192.168.0.1  router
 127.1.2.3    just another localhost
 8.8.8.8  Google DNS
 ```


## Usage
The basic idea is to add this script into the `ExecStartPost=` directive of your naemon.service systemd definition

