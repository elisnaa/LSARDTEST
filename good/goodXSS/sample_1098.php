<!--
# Sample information

Patterns:
- Source: getallheaders ==> Filters:[]
- Sanitization: gettype_check_prm__<s>(integer) ==> Filters:[letters, specials]
- Filters complete: Filters:[letters, specials]
- Dataflow: assignment
- Context: xss_quotes
- Sink: printf_func_prm__<s>(Print this: %d)

State:
- State: Good
- Exploitable: Not found


# Exploit description

-->
<?php
# Init

# Sample
$tainted = getallheaders();
$tainted = $tainted["t"];
if(gettype($tainted) == "integer")
{
  $sanitized = $tainted;
  $dataflow = $sanitized;
  $context = (("Hello to \"" . $dataflow) . "\"");
  printf("Print this: %d", $context);
}

?>