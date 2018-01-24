# ossiquiz-bot

First things first you dont have to install a Server you can just copy all files from html/ossi_quiz/ and use "python html/ossi_quiz/ossi_bot.py.lock name place". 

This is a python bot for http://www.ossiquiz.de/ it stores questions, the image name and the answer.
So you just have to repeatedly start this script untill all answers are saved in html/ossi_quiz/ossi_data.lock
and after that you can cheate your way to the top of the list.

# Installation

1. install lighttpd

- The config can look like this:

```
server.modules = (
	"mod_access",
	"mod_alias",
	"mod_compress",
	"mod_redirect",
#       "mod_rewrite",
)

server.document-root        = "/var/www/html"
server.upload-dirs          = ( "/var/cache/lighttpd/uploads" )
server.errorlog             = "/var/log/lighttpd/error.log"
server.pid-file             = "/var/run/lighttpd.pid"
server.username             = "www-data"
server.groupname            = "www-data"
server.port                 = 8080


index-file.names            = ( "index.php", "index.html", "index.lighttpd.html" )
url.access-deny             = ( "~", ".inc", ".lock" )
static-file.exclude-extensions = ( ".php", ".pl", ".fcgi" )

compress.cache-dir          = "/var/cache/lighttpd/compress/"
compress.filetype           = ( "application/javascript", "text/css", "text/html", "text/plain" )

# default listening port for IPv6 falls back to the IPv4 port
## Use ipv6 if available
#include_shell "/usr/share/lighttpd/use-ipv6.pl " + server.port
include_shell "/usr/share/lighttpd/create-mime.assign.pl"
include_shell "/usr/share/lighttpd/include-conf-enabled.pl"
```
1.1. install php and php-cgi

```
sudo apt-get install php -y
sudo apt-get install php-cgi -y
sudo lighty-enable-mod fastcgi
sudo lighty-enable-mod fastcgi-php
```

2. add and change passwords

If you not just want to use it locally you should change passwords.
therfor you have to chnage some out commented areas in html/index.php and html/ossi_quiz/get_output.php

3. Copy Files 

Copy all files to /var/www/ and dont forget to change permisions of all files in /var/www/ to www-data:www-data 

4. Reboot
