<!--
# Sample information

Patterns:
- Source: _COOKIE ==> Filters:[]
- Sanitization: htmlspecialchars_prm__<c>(ENT_NOQUOTES) ==> Filters:[Filtered(&, <, >)]
- Filters complete: Filters:[Filtered(&, <, >)]
- Dataflow: assignment
- Context: xss_html_param
- Sink: printf_func_prm__<s>(Print this: %s)

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
$tainted = $_COOKIE;
$tainted = $tainted["t"];
$sanitized = htmlspecialchars($tainted, ENT_NOQUOTES);
$dataflow = $sanitized;
$context = (("<img src=\"" . $dataflow) . "\"/>");
printf("Print this: %s", $context);

?>