<!--
# Sample information

Patterns:
- Source: filter_input_prm__<c>(INPUT_GET)_<s>(t)_<c>(FILTER_SANITIZE_SPECIAL_CHARS) ==> Filters:[Filtered(", &, ', <, >)]
- Sanitization: filter_var_prm__<c>(FILTER_SANITIZE_URL) ==> Filters:[Filtered( , , , , , , , , , 	, 
, , , , , , , , , , , , , , , , , , , , , ,  , , , , , , , , , , , , , , , , , , , , , , , , , , , , , , , , , ,  , ¡, ¢, £, ¤, ¥, ¦, §, ¨, ©, «, ¬, ­, ®, ¯, °, ±, ², ³, ´, ¶, ·, ¸, ¹, », ¼, ½, ¾, ¿, ×, ÷)]
- Filters complete: Filters:[Filtered( , , , , , , , , , 	, 
, , , , , , , , , , , , , , , , , , , , , ,  , ", &, ', <, >, , , , , , , , , , , , , , , , , , , , , , , , , , , , , , , , , ,  , ¡, ¢, £, ¤, ¥, ¦, §, ¨, ©, «, ¬, ­, ®, ¯, °, ±, ², ³, ´, ¶, ·, ¸, ¹, », ¼, ½, ¾, ¿, ×, ÷)]
- Dataflow: assignment
- Context: xss_javascript_no_enclosure
- Sink: user_error_prm_

State:
- State: Bad
- Exploitable: Yes


# Exploit description

1. The ; can be used to chain commands
-->
<?php
# Init

# Sample
$tainted = filter_input(INPUT_GET, "t", FILTER_SANITIZE_SPECIAL_CHARS);
$sanitized = filter_var($tainted, FILTER_SANITIZE_URL);
$dataflow = $sanitized;
$pre = "<script>alert(Hello";
$post = ");</script>";
$context = ($pre . ($dataflow . $post));
user_error($context);

?>