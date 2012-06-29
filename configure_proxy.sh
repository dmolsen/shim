SPATH=$(dirname $0)

echo "setting network interface privileges ..."
sudo chgrp admin /dev/bpf*
sudo chmod g+rw /dev/bpf*

echo "making sure old ipfw rules are removed ..."
sudo ipfw delete 02000 
sudo ipfw pipe 1 delete

echo "adding traffic shaping for all tcp requests ..."
source $SPATH/proxy-mod/proxy-mods.sh

echo "Adding firewall rule to forward all port-80 WiFi passthrough traffic to localhost:3128 ..."
sudo ipfw -q add 02000 fwd 127.0.0.1,3128 tcp from any to any dst-port 80 in recv en1

sudo sysctl -w net.inet.ip.forwarding=1
sudo sysctl -w net.inet.ip.fw.enable=1
sudo sysctl -w net.inet.ip.fw.verbose=1
sudo sysctl -w net.inet.ip.scopedroute=0
