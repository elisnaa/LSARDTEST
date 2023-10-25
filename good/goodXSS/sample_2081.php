<!--
# Sample information

Patterns:
- Source: _REQUEST ==> Filters:[]
- Sanitization: in_array_prm__<$>(legal)_<true>() ==> Filters:[nums, letters, specials]
- Filters complete: Filters:[nums, letters, specials]
- Dataflow: assignment
- Context: xss_apostrophe
- Sink: vprintf_prm__<s>(This%d)

State:
- State: Good
- Exploitable: Not found


# Exploit description

-->
<?php
# Init
$legal = ["safe1", "safe2"];


# Sample
$tainted = $_REQUEST;
$tainted = $tainted["t"];
if(in_array($tainted, $legal, true))
{
  $sanitized = $tainted;
  $dataflow = $sanitized;
  $context = (("Hello to '" . $dataflow) . "'");
  vprintf("This%d", $context);
}

?>