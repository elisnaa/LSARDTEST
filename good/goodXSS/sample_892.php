<!--
# Sample information

Patterns:
- Source: apache_request_headers ==> Filters:[]
- Sanitization: sha1_prm__<false>() ==> Filters:[nums, letters, specials]
- Filters complete: Filters:[nums, letters, specials]
- Dataflow: assignment
- Context: xss_apostrophe
- Sink: printf_func_prm__<s>(Print this: %s)

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
$sanitized = sha1($tainted, false);
$dataflow = $sanitized;
$context = (("Hello to '" . $dataflow) . "'");
printf("Print this: %s", $context);

?>