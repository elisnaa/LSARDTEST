<!--
# Sample information

Patterns:
- Source: _COOKIE ==> Filters:[]
- Sanitization: sscanf_prm__<s>(foo %s) ==> Filters:[]
- Filters complete: Filters:[]
- Dataflow: assignment
- Context: sql_plain
- Sink: pg_query_prm__<$>(db)

State:
- State: Bad
- Exploitable: Yes


# Exploit description

1. No enclosure and special chars are allowed -> SQL injection
-->
<?php
# Init
$db = pg_pconnect("host=postgres-server port=5432 user=postgres password=postgres123 dbname=myDB");


# Sample
$tainted = $_COOKIE;
$tainted = $tainted["t"];
$sanitized = sscanf($tainted, "foo %s");
$sanitized = implode($sanitized, "_");
$dataflow = $sanitized;
$context = (("SELECT * FROM users WHERE pin =" . $dataflow) . ";");
$result = pg_query($db, $context);
while(($row = pg_fetch_row($result)))
{
  echo(htmlentities(print_r($row, true)));
}

?>