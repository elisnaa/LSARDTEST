<!--
# Sample information

Patterns:
- Source: _POST ==> Filters:[]
- Sanitization: htmlspecialchars_prm__<c>(ENT_QUOTES) ==> Filters:[Filtered(", &, ', <, >)]
- Filters complete: Filters:[Filtered(", &, ', <, >)]
- Dataflow: assignment
- Context: xss_html_param_a
- Sink: echo_func

State:
- State: Bad
- Exploitable: Yes


# Exploit description

1. It is possible to create a javascript context with: javascript:alert(1)
-->
<?php
# Init

# Sample
$tainted = $_POST;
$tainted = $tainted["t"];
$sanitized = htmlspecialchars($tainted, ENT_QUOTES);
$dataflow = $sanitized;
$context = (("<a href=\"" . $dataflow) . "\">link</a>");
echo($context);

?>