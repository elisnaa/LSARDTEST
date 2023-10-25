<!--
# Sample information

Patterns:
- Source: getallheaders ==> Filters:[]
- Sanitization: fnmatch_prm__<s>(whitelisting)_<i>(0) ==> Filters:[nums, letters, specials]
- Filters complete: Filters:[nums, letters, specials]
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
$tainted = getallheaders();
$tainted = $tainted["t"];
if(fnmatch("whitelisting", $tainted, 0))
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