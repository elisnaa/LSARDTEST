<!--
# Sample information

Patterns:
- Source: _GET ==> Filters:[]
- Sanitization: metaphone_prm__<i>(9) ==> Filters:[nums, specials, Filtered(c, d, v, w, g, h, x, y, z)]
- Filters complete: Filters:[nums, specials, Filtered(c, d, v, w, g, h, x, y, z)]
- Dataflow: assignment
- Context: xss_apostrophe
- Sink: vprintf_prm__<s>(This%d)

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
$sanitized = metaphone($tainted, 9);
$dataflow = $sanitized;
$context = (("Hello to '" . $dataflow) . "'");
vprintf("This%d", $context);

?>