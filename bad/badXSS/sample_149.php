<!--
# Sample information

Patterns:
- Source: _REQUEST ==> Filters:[]
- Sanitization: htmlspecialchars_prm__<c>(ENT_NOQUOTES) ==> Filters:[Filtered(&, <, >)]
- Filters complete: Filters:[Filtered(&, <, >)]
- Dataflow: assignment
- Context: xss_html_param
- Sink: echo_func

State:
- State: Bad
- Exploitable: Yes


# Exploit description

1. Escape quotes with "
2. It is possible to create javascript parameters for: img attributes: onerror
-->
<?php
# Init

# Sample
$tainted = $_REQUEST;
$tainted = $tainted["t"];
$sanitized = htmlspecialchars($tainted, ENT_NOQUOTES);
$dataflow = $sanitized;
$context = (("<img src=\"" . $dataflow) . "\"/>");
echo($context);

?>