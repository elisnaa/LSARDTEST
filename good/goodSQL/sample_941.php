<!--
# Sample information

Patterns:
- Source: _POST ==> Filters:[]
- Sanitization: is_float ==> Filters:[letters, specials]
- Filters complete: Filters:[letters, specials]
- Dataflow: assignment
- Context: sql_apostrophe
- Sink: mssql_sqlsrv_prepare_prm__<$>(db)

State:
- State: Good
- Exploitable: Not found


# Exploit description

-->
<?php
# Init
$info = ["Database" => "myDB", "UID" => "SA", "PWD" => "Msql12345678!"];
$db = sqlsrv_connect("mssql", $info);
if($db == false)
{
  die(print_r(sqlsrv_errors(), true));
}


# Sample
$tainted = $_POST;
$tainted = $tainted["t"];
if(is_float($tainted))
{
  $sanitized = $tainted;
  $dataflow = $sanitized;
  $context = (("SELECT * FROM users WHERE password ='" . $dataflow) . "';");
  $stmt = sqlsrv_prepare($db, $context);
  $result = sqlsrv_execute($stmt);
  while(($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)))
  {
    echo(htmlentities(print_r($row, true)));
  }
}

?>