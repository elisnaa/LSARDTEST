<!--
# Sample information

Patterns:
- Source: _GET ==> Filters:[]
- Sanitization: preg_match_prm__<s>(_^[A-Za-z]*$_) ==> Filters:[nums, specials]
- Filters complete: Filters:[nums, specials]
- Dataflow: assignment
- Context: sql_apostrophe
- Sink: pg_query_prm__<$>(db)

State:
- State: Good
- Exploitable: Not found


# Exploit description

-->
<?php
# Init
$db = pg_pconnect("host=postgres-server port=5432 user=postgres password=postgres123 dbname=myDB");


# Sample
$tainted = $_GET;
$tainted = $tainted["t"];
if(preg_match("/^[A-Za-z]*$/", $tainted))
{
  $sanitized = $tainted;
  $dataflow = $sanitized;
  $context = (("SELECT * FROM users WHERE password ='" . $dataflow) . "';");
  $result = pg_query($db, $context);
  while(($row = pg_fetch_row($result)))
  {
    echo(htmlentities(print_r($row, true)));
  }
}

?>