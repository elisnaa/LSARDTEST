<!--
# Sample information

Patterns:
- Source: _GET ==> Filters:[]
- Sanitization: preg_match_prm__<s>(_[0-9]_) ==> Filters:[]
- Filters complete: Filters:[]
- Dataflow: assignment
- Context: sql_apostrophe
- Sink: sqlsrv_query_prm__<$>(db)

State:
- State: Bad
- Exploitable: Yes


# Exploit description

1. Escape the apostrophe with '
2. No enclosure and special chars are allowed -> SQL injection
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
$tainted = $_GET;
$tainted = $tainted["t"];
if(preg_match("/[0-9]/", $tainted))
{
  $sanitized = $tainted;
  $dataflow = $sanitized;
  $context = (("SELECT * FROM users WHERE password ='" . $dataflow) . "';");
  $result = sqlsrv_query($db, $context);
  while(($row = sqlsrv_fetch_object($result)))
  {
    echo(htmlentities(print_r($row, true)));
  }
}

?>