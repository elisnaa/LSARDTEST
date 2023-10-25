<!--
# Sample information

Patterns:
- Source: _COOKIE ==> Filters:[]
- Sanitization: preg_replace_prm__<s>(_'_)_<s>() ==> Filters:[Filtered(')]
- Filters complete: Filters:[Filtered(')]
- Dataflow: assignment
- Context: xss_apostrophe
- Sink: user_error_prm_

State:
- State: Bad
- Exploitable: Yes


# Exploit description

1. Create script tag with <script>
2. Apostrophe are useless inside plain html context for XSS
-->
<?php
# Init

# Sample
$tainted = $_COOKIE;
$tainted = $tainted["t"];
$sanitized = preg_replace("/'/", "", $tainted);
$dataflow = $sanitized;
$context = (("Hello to '" . $dataflow) . "'");
user_error($context);

?>