<!--
# Sample information

Patterns:
- Source: getallheaders ==> Filters:[]
- Sanitization: strip_tags_1 ==> Filters:[Filtered(<, >)]
- Filters complete: Filters:[Filtered(<, >)]
- Dataflow: assignment
- Context: sql_plain
- Sink: pg_send_query_prm__<$>(db)

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
$tainted = getallheaders();
$tainted = $tainted["t"];
$sanitized = strip_tags($tainted);
$dataflow = $sanitized;
$context = (("SELECT * FROM users WHERE pin =" . $dataflow) . ";");
pg_send_query($db, $context);
$result = pg_get_result($db);
while(($row = pg_fetch_row($result)))
{
  echo(htmlentities(print_r($row, true)));
}

?>