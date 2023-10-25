<!--
# Sample information

Patterns:
- Source: _REQUEST ==> Filters:[]
- Sanitization: ctype_alpha ==> Filters:[nums, specials]
- Filters complete: Filters:[nums, specials]
- Dataflow: assignment
- Context: sql_plain
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
$tainted = $_REQUEST;
$tainted = $tainted["t"];
if(ctype_alpha($tainted))
{
  $sanitized = $tainted;
  $dataflow = $sanitized;
  $context = (("SELECT * FROM users WHERE pin =" . $dataflow) . ";");
  $stmt = $pdo->prepare($context);
  $results = $stmt->execute([]);
  foreach ($stmt->fetchAll() as $row){
    echo(htmlentities(print_r($row, true)));
  }
}

?>