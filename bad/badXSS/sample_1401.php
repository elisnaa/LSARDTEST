<!--
# Sample information

Patterns:
- Source: filter_input_array_prm__<c>(INPUT_GET)_<array>(<ae_k>(<s>(t),<c>(FILTER_SANITIZE_ADD_SLASHES))) ==> Filters:[Escape[\](", ', \)]
- Sanitization: htmlentities_prm__<c>(ENT_NOQUOTES) ==> Filters:[Filtered(&, <, >)]
- Filters complete: Filters:[Filtered(&, <, >), Escape[\](", ', \)]
- Dataflow: assignment
- Context: xss_html_param_a
- Sink: vprintf_prm__<s>(This%s)

State:
- State: Bad
- Exploitable: Yes


# Exploit description

1. It is possible to create a javascript context with: javascript:alert(1)
-->
<?php
# Init

# Sample
$tainted = filter_input_array(INPUT_GET, ["t" => FILTER_SANITIZE_ADD_SLASHES]);
$tainted = $tainted["t"];
$sanitized = htmlentities($tainted, ENT_NOQUOTES);
$dataflow = $sanitized;
$context = (("<a href=\"" . $dataflow) . "\">link</a>");
vprintf("This%s", $context);

?>