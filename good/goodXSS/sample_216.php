<!--
# Sample information

Patterns:
- Source: filter_input_prm__<c>(INPUT_GET)_<s>(t)_<c>(FILTER_SANITIZE_NUMBER_INT) ==> Filters:[letters, specials]
- Sanitization: htmlentities_prm__<c>(ENT_NOQUOTES) ==> Filters:[Filtered(&, <, >)]
- Filters complete: Filters:[letters, specials, Filtered(&, <, >)]
- Dataflow: assignment
- Context: xss_plain
- Sink: vprintf_prm__<s>(This%d)

State:
- State: Good
- Exploitable: Not found


# Exploit description

-->
<?php
# Init

# Sample
$tainted = filter_input(INPUT_GET, "t", FILTER_SANITIZE_NUMBER_INT);
$sanitized = htmlentities($tainted, ENT_NOQUOTES);
$dataflow = $sanitized;
$context = ("Hello" . $dataflow);
vprintf("This%d", $context);

?>