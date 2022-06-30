#!/bin/bash
### BEGIN INIT INFO
# Provides:             post-install
# Required-Start:       $remote_fs $network $named
# Default-Start:        2 3 4 5
# Default-Stop:
# Short-Description: Executes post installation scripts
### ENT INIT INFO

case "$1" in
    stop|status)
        # Not a daemon
    ;;
    start|restart)
	    /usr/bin/wget http://10.10.0.5/deploy.php?ip=$(/bin/hostname -I | cut -d " " -f1)
    ;;
    *)
        echo "Usage /etc/init.d/post-install [start|restart]"
    ;;
esac
