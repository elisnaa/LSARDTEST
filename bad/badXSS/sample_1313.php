<!--
# Sample information

Patterns:
- Source: _POST ==> Filters:[]
- Sanitization: str_getcsv_prm_ ==> Filters:[Filtered(,)]
- Filters complete: Filters:[Filtered(,)]
- Dataflow: assignment
- Context: xss_html_param_a
- Sink: printf_func_prm__<s>(Print this: %s)

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
$sanitized = str_getcsv($tainted);
$sanitized = implode($sanitized, "_");
$dataflow = $sanitized;
$context = (("<a href=\"" . $dataflow) . "\">link</a>");
printf("Print this: %s", $context);

?>