<!--
# Sample information

Patterns:
- Source: _POST ==> Filters:[]
- Sanitization: preg_match_all_prm__<s>(_^[A-Za-z0-9]*$_) ==> Filters:[specials]
- Filters complete: Filters:[specials]
- Dataflow: assignment
- Context: xss_html_param_a
- Sink: printf_func_prm__<s>(Print this: %s)

State:
- State: Good
- Exploitable: Not found


# Exploit description

-->
<?php
# Init

# Sample
$tainted = $_POST;
$tainted = $tainted["t"];
if(preg_match_all("/^[A-Za-z0-9]*$/", $tainted))
{
  $sanitized = $tainted;
  $dataflow = $sanitized;
  $context = (("<a href=\"" . $dataflow) . "\">link</a>");
  printf("Print this: %s", $context);
}

?>