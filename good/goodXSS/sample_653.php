<!--
# Sample information

Patterns:
- Source: filter_input_array_prm__<c>(INPUT_GET)_<array>(<ae_k>(<s>(t),<c>(FILTER_SANITIZE_ADD_SLASHES))) ==> Filters:[Escape[\](", ', \)]
- Sanitization: mhash_prm__<c>(MHASH_MD4) ==> Filters:[nums, letters, specials]
- Filters complete: Filters:[nums, letters, specials, Escape[\](", ', \)]
- Dataflow: assignment
- Context: xss_javascript
- Sink: echo_func

State:
- State: Good
- Exploitable: Not found


# Exploit description

-->
<?php
# Init

# Sample
$tainted = filter_input_array(INPUT_GET, ["t" => FILTER_SANITIZE_ADD_SLASHES]);
$tainted = $tainted["t"];
$sanitized = mhash(MHASH_MD4, $tainted);
$dataflow = $sanitized;
$pre = "<script>alert(\"Hello";
$post = "\");</script>";
$context = ($pre . ($dataflow . $post));
echo($context);

?>