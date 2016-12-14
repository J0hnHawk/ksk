<?php
$output = shell_exec('zip -9 -r ksk2bak.zip ./*');
echo "<pre>$output</pre>";
?>