<!--
# Sample information

Patterns:
- Source: filter_input_prm__<c>(INPUT_GET)_<s>(t)_<c>(FILTER_SANITIZE_EMAIL) ==> Filters:[Filtered( , , , , , , , , , 	, 
, , , , , , , , , , , , , , , , , , , , , ,  , ", (, ), ,, /, :, ;, <, >, \, , , , , , , , , , , , , , , , , , , , , , , , , , , , , , , , , ,  , ¡, ¢, £, ¤, ¥, ¦, §, ¨, ©, «, ¬, ­, ®, ¯, °, ±, ², ³, ´, ¶, ·, ¸, ¹, », ¼, ½, ¾, ¿, ×, ÷)]
- Sanitization: preg_match_prm__<s>(_[0-9]_) ==> Filters:[]
- Filters complete: Filters:[Filtered( , , , , , , , , , 	, 
, , , , , , , , , , , , , , , , , , , , , ,  , ", (, ), ,, /, :, ;, <, >, \, , , , , , , , , , , , , , , , , , , , , , , , , , , , , , , , , ,  , ¡, ¢, £, ¤, ¥, ¦, §, ¨, ©, «, ¬, ­, ®, ¯, °, ±, ², ³, ´, ¶, ·, ¸, ¹, », ¼, ½, ¾, ¿, ×, ÷)]
- Dataflow: assignment
- Context: xss_javascript_no_enclosure
- Sink: exit

State:
- State: Bad
- Exploitable: Not found


# Exploit description

-->
<?php
# Init

# Sample
$tainted = filter_input(INPUT_GET, "t", FILTER_SANITIZE_EMAIL);
if(preg_match("/[0-9]/", $tainted))
{
  $sanitized = $tainted;
  $dataflow = $sanitized;
  $pre = "<script>alert(Hello";
  $post = ");</script>";
  $context = ($pre . ($dataflow . $post));
  exit($context);
}

?>