#!/bin/bash
### BEGIN INIT INFO
# Provides:             on-boot
# Required-Start:       $remote_fs $syslog
# Default-Start:        2 3 4 
# Default-Stop:
# Short-Description: Executes nessecary boot commands
### ENT INIT INFO

case "$1" in
    stop|status)
        # Not a daemon
    ;;
    start|restart)
	    systemctl stop gdm
	    su gdm -s /bin/bash -c "gsettings set org.gnome.login-screen disable-user-list true"
	    systemctl start gdm
	    nmcli con up "ICT Scouts & Campus"
    ;;
    *)
        echo "Usage /etc/init.d/on-boot [start|restart]"
    ;;
esac
