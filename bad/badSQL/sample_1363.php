<!--
# Sample information

Patterns:
- Source: apache_request_headers ==> Filters:[]
- Sanitization: filter_var_prm__<c>(FILTER_SANITIZE_EMAIL) ==> Filters:[Filtered( , , , , , , , , , 	, 
, , , , , , , , , , , , , , , , , , , , , ,  , ", (, ), ,, /, :, ;, <, >, \, , , , , , , , , , , , , , , , , , , , , , , , , , , , , , , , , ,  , ¡, ¢, £, ¤, ¥, ¦, §, ¨, ©, «, ¬, ­, ®, ¯, °, ±, ², ³, ´, ¶, ·, ¸, ¹, », ¼, ½, ¾, ¿, ×, ÷)]
- Filters complete: Filters:[Filtered( , , , , , , , , , 	, 
, , , , , , , , , , , , , , , , , , , , , ,  , ", (, ), ,, /, :, ;, <, >, \, , , , , , , , , , , , , , , , , , , , , , , , , , , , , , , , , ,  , ¡, ¢, £, ¤, ¥, ¦, §, ¨, ©, «, ¬, ­, ®, ¯, °, ±, ², ³, ´, ¶, ·, ¸, ¹, », ¼, ½, ¾, ¿, ×, ÷)]
- Dataflow: assignment
- Context: sql_apostrophe
- Sink: mysqli_real_query_prm__<$>(db)

State:
- State: Bad
- Exploitable: Yes


# Exploit description

1. Escape the apostrophe with '
2. No enclosure and special chars are allowed -> SQL injection
-->
<?php
# Init
$servername = "mysql";
$username = "username";
$password = "password";
$dbName = "myDB";
$db = new mysqli($servername, $username, $password, $dbName);


# Sample
$tainted = apache_request_headers();
$tainted = $tainted["t"];
$sanitized = filter_var($tainted, FILTER_SANITIZE_EMAIL);
$dataflow = $sanitized;
$context = (("SELECT * FROM users WHERE password ='" . $dataflow) . "';");
mysqli_real_query($db, $context);
$results = $db->use_result();
while(($row = $results->fetch_row()))
{
  echo(htmlentities(print_r($row, true)));
}

?>