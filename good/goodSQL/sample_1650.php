<!--
# Sample information

Patterns:
- Source: filter_input_prm__<c>(INPUT_GET)_<s>(t)_<c>(FILTER_SANITIZE_NUMBER_INT) ==> Filters:[letters, specials]
- Sanitization: gzencode_prm__<i>(9) ==> Filters:[nums, letters, specials]
- Filters complete: Filters:[nums, letters, specials]
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
$tainted = filter_input(INPUT_GET, "t", FILTER_SANITIZE_NUMBER_INT);
$sanitized = gzencode($tainted, 9);
$dataflow = $sanitized;
$context = (("SELECT * FROM users WHERE password ='" . $dataflow) . "';");
$stmt = sqlsrv_prepare($db, $context);
$result = sqlsrv_execute($stmt);
while(($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)))
{
  echo(htmlentities(print_r($row, true)));
}

?>