<html>
	<body>
		<h1>Tweak Shim's Proxy Settings</h1>
		<p>
			Use the options below to modify the proxy settings for Shim. You can limit
			bandwidth and/or add latency to (poorly) mimic cellphone network conditions. To reset the config
			to the default simply submit this form without choosing any options.
		</p>
		<p>
			<strong>
			<?php
				if ($posted) {
					print "<span style=\"color: green\">new config:</span>";
				} else {
					print "current config:";
				}
			?>
			</strong>
			<code>
			<?php
				if ((($posted == false) && ($config == "")) || (($posted == true) && ($c == ""))) {
					print "running the default shim settings";
				} else if ($posted) {
					print $c;
				} else {
					print $config;
				}
			?>
			</code>
		</p>
		<form action="index.php" method="post">
			<p>
			<strong>Latency:</strong>
				<?php
					foreach($lArray as $key) {
						print "<input type=\"radio\" value=\"".$key."\" name=\"latency\" /> ".$key."ms &nbsp; ";
					}
				?>
				</p>
			<p>
				<strong>Bandwidth:</strong>
				<?php
					foreach($bArray as $key=>$value) {
						print "<input type=\"radio\" value=\"".$key."\" name=\"network\" /> ".$key." &nbsp; ";
					}
				?>
			</p>
			<p>
				<input type="submit" name="submit" value=" Submit " />
			</p>
		</form>
	</body>
</html>