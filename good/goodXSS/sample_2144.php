<!--
# Sample information

Patterns:
- Source: apache_request_headers ==> Filters:[]
- Sanitization: gettype_check_prm__<s>(integer) ==> Filters:[letters, specials]
- Filters complete: Filters:[letters, specials]
- Dataflow: assignment
- Context: xss_quotes
- Sink: user_error_prm_

State:
- State: Good
- Exploitable: Not found


# Exploit description

-->
<?php
# Init

# Sample
$tainted = apache_request_headers();
$tainted = $tainted["t"];
if(gettype($tainted) == "integer")
{
  $sanitized = $tainted;
  $dataflow = $sanitized;
  $context = (("Hello to \"" . $dataflow) . "\"");
  user_error($context);
}

?>