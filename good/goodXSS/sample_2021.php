<!--
# Sample information

Patterns:
- Source: _REQUEST ==> Filters:[]
- Sanitization: preg_match_prm__<s>(_^[A-Za-z]*$_) ==> Filters:[nums, specials]
- Filters complete: Filters:[nums, specials]
- Dataflow: assignment
- Context: xss_javascript_no_enclosure
- Sink: user_error_prm_

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
if(preg_match("/^[A-Za-z]*$/", $tainted))
{
  $sanitized = $tainted;
  $dataflow = $sanitized;
  $pre = "<script>alert(Hello";
  $post = ");</script>";
  $context = ($pre . ($dataflow . $post));
  user_error($context);
}

?>