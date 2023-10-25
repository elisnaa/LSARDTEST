<!--
# Sample information

Patterns:
- Source: _REQUEST ==> Filters:[]
- Sanitization: count_prm_ ==> Filters:[letters, specials]
- Filters complete: Filters:[letters, specials]
- Dataflow: assignment
- Context: xss_plain
- Sink: echo_func

State:
- State: Good
- Exploitable: Not found


# Exploit description

-->
<?php
# Init

# Sample
$tainted = $_REQUEST;
$sanitized = count($tainted);
$dataflow = $sanitized;
$context = ("Hello" . $dataflow);
echo($context);

?>