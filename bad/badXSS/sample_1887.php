<!--
# Sample information

Patterns:
- Source: filter_input_array_prm__<c>(INPUT_GET)_<array>(<ae_k>(<s>(t),<c>(FILTER_SANITIZE_ADD_SLASHES))) ==> Filters:[Escape[\](", ', \)]
- Sanitization: strtr_prm__<s>(')_<s>(\w) ==> Filters:[Filtered(')]
- Filters complete: Filters:[Filtered('), Escape[\](", ', \)]
- Dataflow: assignment
- Context: xss_html_param_a
- Sink: print_func

State:
- State: Bad
- Exploitable: Yes


# Exploit description

1. It is possible to create a javascript context with: javascript:alert(1)
-->
<?php
# Init

# Sample
$tainted = filter_input_array(INPUT_GET, ["t" => FILTER_SANITIZE_ADD_SLASHES]);
$tainted = $tainted["t"];
$sanitized = strtr($tainted, "'", " ");
$dataflow = $sanitized;
$context = (("<a href=\"" . $dataflow) . "\">link</a>");
print($context);

?>