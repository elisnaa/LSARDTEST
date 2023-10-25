<!--
# Sample information

Patterns:
- Source: getallheaders ==> Filters:[]
- Sanitization: settype_prm__<s>(bool) ==> Filters:[nums, letters, specials]
- Filters complete: Filters:[nums, letters, specials]
- Dataflow: assignment
- Context: sql_apostrophe
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
$tainted = getallheaders();
$tainted = $tainted["t"];
if(settype($tainted, "bool"))
{
  $sanitized = $tainted;
  $dataflow = $sanitized;
  $context = (("SELECT * FROM users WHERE password ='" . $dataflow) . "';");
  $results = $pdo->query($context);
  foreach ($results as $row){
    echo(htmlentities(print_r($row, true)));
  }
}

?>