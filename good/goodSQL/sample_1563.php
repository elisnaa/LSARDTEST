<!--
# Sample information

Patterns:
- Source: filter_input_prm__<c>(INPUT_GET)_<s>(t)_<c>(FILTER_SANITIZE_NUMBER_INT) ==> Filters:[letters, specials]
- Sanitization: strip_tags_1 ==> Filters:[Filtered(<, >)]
- Filters complete: Filters:[letters, specials, Filtered(<, >)]
- Dataflow: assignment
- Context: sql_quotes
- Sink: pdo_query_prm__<$>(pdo)

State:
- State: Good
- Exploitable: Not found


# Exploit description

-->
<?php
# Init
$pdo = new PDO("mysql:host=mysql;port=3306;dbname=myDB", "username", "password");


# Sample
$tainted = filter_input(INPUT_GET, "t", FILTER_SANITIZE_NUMBER_INT);
$sanitized = strip_tags($tainted);
$dataflow = $sanitized;
$context = (("SELECT * FROM users WHERE password =\"" . $dataflow) . "\";");
$results = $pdo->query($context);
foreach ($results as $row){
  echo(htmlentities(print_r($row, true)));
}

?>