<!--
# Sample information

Patterns:
- Source: _COOKIE ==> Filters:[]
- Sanitization: filter_var_prm__<c>(FILTER_SANITIZE_NUMBER_INT) ==> Filters:[letters, specials]
- Filters complete: Filters:[letters, specials]
- Dataflow: assignment
- Context: xss_apostrophe
- Sink: printf_func_prm__<s>(Print this: %d)

State:
- State: Good
- Exploitable: Not found


# Exploit description

-->
<?php
# Init

# Sample
$tainted = $_COOKIE;
$tainted = $tainted["t"];
$sanitized = filter_var($tainted, FILTER_SANITIZE_NUMBER_INT);
$dataflow = $sanitized;
$context = (("Hello to '" . $dataflow) . "'");
printf("Print this: %d", $context);

?>