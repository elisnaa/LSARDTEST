<!--
# Sample information

Patterns:
- Source: filter_input_prm__<c>(INPUT_GET)_<s>(t)_<c>(FILTER_SANITIZE_NUMBER_INT) ==> Filters:[letters, specials]
- Sanitization: strip_tags_1 ==> Filters:[Filtered(<, >)]
- Filters complete: Filters:[letters, specials, Filtered(<, >)]
- Dataflow: assignment
- Context: sql_apostrophe
- Sink: pg_send_query_prm__<$>(db)

State:
- State: Good
- Exploitable: Not found


# Exploit description

-->
<?php
# Init
$db = pg_pconnect("host=postgres-server port=5432 user=postgres password=postgres123 dbname=myDB");


# Sample
$tainted = filter_input(INPUT_GET, "t", FILTER_SANITIZE_NUMBER_INT);
$sanitized = strip_tags($tainted);
$dataflow = $sanitized;
$context = (("SELECT * FROM users WHERE password ='" . $dataflow) . "';");
pg_send_query($db, $context);
$result = pg_get_result($db);
while(($row = pg_fetch_row($result)))
{
  echo(htmlentities(print_r($row, true)));
}

?>