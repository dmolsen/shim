# shim proxy-mod #

This is a quick PHP hack to enable traffic-shaping for [shim](https://github.com/marstall/shim). While shim is great on its own
not everyone will be connecting to your website on their mobile devices from spotless WiFi connections. In order to test real world scenarios this mod
allows developers & designers to modify the shim network properties via a simple web form. Shim can then be used normally
yet have the connection will be "downgraded" for proper testing. Currently, the
following properties can be controlled "remotely" via this script:

* bandwidth/network _(e.g. EDGE vs 3G)_
* latency

These properties still need to be modified to reflect realistic scenarios. It could also stand to be rewritten in node.js and pulled into the project
proper.

## Setting Up ##

Setting this up is not easy. I'm just trying to be honest. This section assumes you're running shim in a Mac OS X 10.6 environment.

### Configuring Apache ###

You will need to configure Apache since that's what will be running the small web app. In a stock install of Mac OS X you will need to:

1. enable PHP
1. enable index.php support
1. enable vhost support
1. add a vhost for the web app
1. restart apache

You can do that by taking the following steps:

1. Open Utilities > Terminal
1. At the prompt type: sudo vi +115 /etc/apache2/httpd.conf
1. Hit the 'i' key so you can insert text
1. Uncomment the PHP lib by deleting the pound sign at the beginning of line
1. Hit the esc key & then type :wq
1. At the prompt type: sudo vi +230 /etc/apache2/httpd.conf
1. Add index.php to the DirectoryIndex index.html line
1. Hit the esc key & then type :wq
1. At the prompt type: sudo vi +466 /etc/apache2/httpd.conf
1. Uncomment the vhosts file by deleting the pound sign at the beginning of line
1. Hit the esc key & then type :wq
1. (pop in example of the vhost)
1. At the prompt type: sudo apachectl restart

### Configuring Sudo ###

Apache will need to be able to run the various commands in `configure_proxy.sh` via sudo without needing a password. In order to set this up you will need to:

1. enable the root user
1. modifying the sudoers file

You can do that by taking the following steps:

1. Under the Apple menu open System Preferences
1. Choose Accounts
1. Choose Login Options
1. Next to 'Network Account Server' click the Join button
1. Click the Open Directory Utility button
1. Click the lock in the bottom left of the pane to make changes
1. From the Edit menu at the top choose 'Enable Root User'
1. Type in a password

At this point you're going to have to logout of your current session which will close your apps and what not. Save stuff.

1. Under the Apple menu choose Log Out
1. When prompted for a user/password type in root as the username and your new password for the account
1. Open Utilities > Terminal
1. NOT FINISHED

## Resources ##

If you need to understand what's going on with ipfw please check out this [quality set of docs](http://www.nxmnpg.com/8/ipfw).

## Credits ##

Thanks to [Chris Marstall](http://twitter.com/#!/marstall) & the team at [GlobeLab](http://twitter.com/#!/globelab) for making shim available for hacking via GitHub.