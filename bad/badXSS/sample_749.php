<!--
# Sample information

Patterns:
- Source: _GET ==> Filters:[]
- Sanitization: strtr_prm__<s>(')_<s>(\w) ==> Filters:[Filtered(')]
- Filters complete: Filters:[Filtered(')]
- Dataflow: assignment
- Context: xss_html_param_a
- Sink: trigger_error_prm__<c>(E_USER_ERROR)

State:
- State: Bad
- Exploitable: Yes


# Exploit description

1. It is possible to create a javascript context with: javascript:alert(1)
-->
<?php
# Init

# Sample
$tainted = $_GET;
$tainted = $tainted["t"];
$sanitized = strtr($tainted, "'", " ");
$dataflow = $sanitized;
$context = (("<a href=\"" . $dataflow) . "\">link</a>");
trigger_error($context, E_USER_ERROR);

?>