# BW: Bandwidth-based Traffic Shaping
# Supply a number (KBytes/s) to turn this feature on. Set to 0 to turn off
BW="0"

# DL: Latency-based Traffic Shaping
# Supply a number (ms) to turn this feature on. Set to 0 to turn off
DL="0"

echo "setting network interface privileges ..."
sudo chgrp admin /dev/bpf*
sudo chmod g+rw /dev/bpf*

echo "making sure old ipfw rules are removed ..."
sudo ipfw delete 02000 
sudo ipfw pipe 1 delete

if [ "$BW" -ne "0" ] || [ "$DL" -ne "0" ]; then
	echo "adding traffic shaping for all tcp requests ..."
	sudo ipfw add 02000 pipe 1 out via en1
	if [ "$BW" -ne "0" ]; then
		BWF="bw "$BW"KByte/s"
	else
		BWF=""
	fi
	if [ "$DL" -ne "0" ]; then
		DLF="delay "$DL"ms "
	else
		DLF=""
	fi
	sudo ipfw pipe 1 config $DLF$BWF
fi

echo "adding firewall rule to forward all port-80 WiFi passthrough traffic to localhost:3128 ..."
sudo ipfw -q add 02000 fwd 127.0.0.1,3128 tcp from any to any dst-port 80 in recv en1

sudo sysctl -w net.inet.ip.forwarding=1
sudo sysctl -w net.inet.ip.fw.enable=1
sudo sysctl -w net.inet.ip.fw.verbose=1
sudo sysctl -w net.inet.ip.scopedroute=0
