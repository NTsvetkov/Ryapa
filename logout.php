<?php
require ("db.inc.php");
unset ($_SESSION[$sessionName]);
header('Location: /');

