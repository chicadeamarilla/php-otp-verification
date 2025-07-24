<?php
setcookie("beedata", "", time() - 3600, "/");
header("Location: https://bee.avishost.com");
exit;
?>