# http-ansible-run
CGI Script to run ansible-playbook via an http API.

### Setup
* Adjust variables in script
* `a2enmod cgid`
* `systemctl restart apache2`
* `visudo` -> `www-data ALL=(ALL) NOPASSWD: ALL`
* `cp index.cgi /usr/lib/cgi-bin/`

