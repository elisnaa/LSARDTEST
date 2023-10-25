<!--
# Sample information

Patterns:
- Source: _REQUEST ==> Filters:[]
- Sanitization: settype_prm__<s>(int) ==> Filters:[letters, specials]
- Filters complete: Filters:[letters, specials]
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
$tainted = $_REQUEST;
$tainted = $tainted["t"];
if(settype($tainted, "int"))
{
  $sanitized = $tainted;
  $dataflow = $sanitized;
  $context = (("SELECT * FROM users WHERE password =\"" . $dataflow) . "\";");
  $results = $pdo->query($context);
  foreach ($results as $row){
    echo(htmlentities(print_r($row, true)));
  }
}

?>