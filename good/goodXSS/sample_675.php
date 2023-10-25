<!--
# Sample information

Patterns:
- Source: filter_input_array_prm__<c>(INPUT_GET)_<array>(<ae_k>(<s>(t),<c>(FILTER_SANITIZE_SPECIAL_CHARS))) ==> Filters:[Filtered(", &, ', <, >)]
- Sanitization: htmlentities_1 ==> Filters:[Filtered(", &, <, >)]
- Filters complete: Filters:[Filtered(", &, ', <, >)]
- Dataflow: assignment
- Context: xss_quotes
- Sink: exit

State:
- State: Good
- Exploitable: Not found


# Exploit description

-->
<?php
# Init

# Sample
$tainted = filter_input_array(INPUT_GET, ["t" => FILTER_SANITIZE_SPECIAL_CHARS]);
$tainted = $tainted["t"];
$sanitized = htmlentities($tainted);
$dataflow = $sanitized;
$context = (("Hello to \"" . $dataflow) . "\"");
exit($context);

?>