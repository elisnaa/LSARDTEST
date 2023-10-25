<!--
# Sample information

Patterns:
- Source: _REQUEST ==> Filters:[]
- Sanitization: soundex ==> Filters:[nums, letters, specials]
- Filters complete: Filters:[nums, letters, specials]
- Dataflow: assignment
- Context: xss_quotes
- Sink: trigger_error_prm__<c>(E_USER_ERROR)

State:
- State: Good
- Exploitable: Not found


# Exploit description

-->
<?php
# Init

# Sample
$tainted = $_REQUEST;
$tainted = $tainted["t"];
$sanitized = soundex($tainted);
$dataflow = $sanitized;
$context = (("Hello to \"" . $dataflow) . "\"");
trigger_error($context, E_USER_ERROR);

?>