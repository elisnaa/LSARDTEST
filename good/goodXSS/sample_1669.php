<!--
# Sample information

Patterns:
- Source: filter_input_array_prm__<c>(INPUT_GET)_<array>(<ae_k>(<s>(t),<c>(FILTER_SANITIZE_ADD_SLASHES))) ==> Filters:[Escape[\](", ', \)]
- Sanitization: substr_replace_prm__<s>(bob)_<i>(0) ==> Filters:[nums, letters, specials]
- Filters complete: Filters:[nums, letters, specials, Escape[\](", ', \)]
- Dataflow: assignment
- Context: xss_quotes
- Sink: vprintf_prm__<s>(This%s)

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
$sanitized = substr_replace($tainted, "bob", 0);
$dataflow = $sanitized;
$context = (("Hello to \"" . $dataflow) . "\"");
vprintf("This%s", $context);

?>