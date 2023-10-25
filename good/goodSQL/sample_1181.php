<!--
# Sample information

Patterns:
- Source: getallheaders ==> Filters:[]
- Sanitization: pdo_quote_prm__<$>(pdo) ==> Filters:[Filtered(')]
- Filters complete: Filters:[Filtered(')]
- Dataflow: assignment
- Context: sql_apostrophe
- Sink: pdo_prepare_prm__<$>(pdo)

State:
- State: Good
- Exploitable: Not found


# Exploit description

-->
<?php
# Init
$pdo = new PDO("mysql:host=mysql;port=3306;dbname=myDB", "username", "password");


# Sample
$tainted = getallheaders();
$tainted = $tainted["t"];
$sanitized = $pdo->quote($tainted);
$dataflow = $sanitized;
$context = (("SELECT * FROM users WHERE password ='" . $dataflow) . "';");
$stmt = $pdo->prepare($context);
$results = $stmt->execute([]);
foreach ($stmt->fetchAll() as $row){
  echo(htmlentities(print_r($row, true)));
}

?>