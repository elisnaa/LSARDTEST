<!--
# Sample information

Patterns:
- Source: _POST ==> Filters:[]
- Sanitization: sizeof_prm__<c>(COUNT_NORMAL) ==> Filters:[nums, letters, specials]
- Filters complete: Filters:[nums, letters, specials]
- Dataflow: assignment
- Context: xss_plain
- Sink: printf_func_prm__<s>(Print this: %d)

State:
- State: Good
- Exploitable: Not found


# Exploit description

-->
<?php
# Init

# Sample
$tainted = $_POST;
$sanitized = sizeof($tainted, COUNT_NORMAL);
$dataflow = $sanitized;
$context = ("Hello" . $dataflow);
printf("Print this: %d", $context);

?>