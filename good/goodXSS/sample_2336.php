<!--
# Sample information

Patterns:
- Source: _GET ==> Filters:[]
- Sanitization: str_replace_prm__<array>(<ae>(<s>(")), <ae>(<s>(')), <ae>(<s>(\<)) , <ae>(<s>(\>)))_<s>() ==> Filters:[Filtered(", ', <, >)]
- Filters complete: Filters:[Filtered(", ', <, >)]
- Dataflow: assignment
- Context: xss_plain
- Sink: exit

State:
- State: Good
- Exploitable: Not found


# Exploit description

-->
<?php
# Init

# Sample
$tainted = $_GET;
$tainted = $tainted["t"];
$sanitized = str_replace(["\"", "'", "<", ">"], "", $tainted);
$dataflow = $sanitized;
$context = ("Hello" . $dataflow);
exit($context);

?>