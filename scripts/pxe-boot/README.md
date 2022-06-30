# pxe-boot
Collection of required files to PXE boot the initial installer of ubuntu 20.04 
which runs the ansible part in the post install.

### Installation
* Install a tftp server (e.g. `tftpd-hpa`) and enable it (`systemctl enable --now tftpd-hpa`)
* Install an http server (e.g. `apache2`) and enable it (`systemctl enable --now apache2`)
* Download the ubuntu 20.04 [legacy image netboot tarball](http://archive.ubuntu.com/ubuntu/dists/focal/main/installer-amd64/current/legacy-images/netboot/netboot.tar.gz) and upack it to the tftp root (`tar -xf netboot.tar.gz -C <tftp root>`)
* Copy the custom bootscreen from the [tftp](tftp) folder into `<tftp root>/ubuntu-installer/amd64/boot-screens/txt.cfg` and edit it accordingly
* Copy the preseed file from the [http][http] folder into the www root and edit it accordingly
* Copy the `post-install.sh` and `on-boot.sh` from the [http](folder) into the www root too and adjust the IPs
