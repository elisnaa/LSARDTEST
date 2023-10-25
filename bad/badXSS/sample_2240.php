<!--
# Sample information

Patterns:
- Source: _POST ==> Filters:[]
- Sanitization: is_string ==> Filters:[]
- Filters complete: Filters:[]
- Dataflow: assignment
- Context: xss_plain
- Sink: print_func

State:
- State: Bad
- Exploitable: Yes


# Exploit description

1. Create script tag with <script>
-->
<?php
# Init

# Sample
$tainted = $_POST;
$tainted = $tainted["t"];
if(is_string($tainted))
{
  $sanitized = $tainted;
  $dataflow = $sanitized;
  $context = ("Hello" . $dataflow);
  print($context);
}

?>