<!--
# Sample information

Patterns:
- Source: _GET ==> Filters:[]
- Sanitization: sizeof_prm__<c>(COUNT_NORMAL) ==> Filters:[nums, letters, specials]
- Filters complete: Filters:[nums, letters, specials]
- Dataflow: assignment
- Context: xss_html_param
- Sink: printf_func_prm__<s>(Print this: %d)

State:
- State: Good
- Exploitable: Not found


# Exploit description

-->
<?php
# Init

# Sample
$tainted = $_GET;
$sanitized = sizeof($tainted, COUNT_NORMAL);
$dataflow = $sanitized;
$context = (("<img src=\"" . $dataflow) . "\"/>");
printf("Print this: %d", $context);

?>