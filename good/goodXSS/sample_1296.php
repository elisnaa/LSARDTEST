<!--
# Sample information

Patterns:
- Source: _POST ==> Filters:[]
- Sanitization: floatval ==> Filters:[letters, specials]
- Filters complete: Filters:[letters, specials]
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
$tainted = $_POST;
$tainted = $tainted["t"];
$sanitized = floatval($tainted);
$dataflow = $sanitized;
$context = ("Hello" . $dataflow);
exit($context);

?>