<?php
session_start();
session_unset(); // كيمسح كاع الداتا ديال السيسيون
session_destroy(); // كيقتل السيسيون نهائيا
header("Location: index.php"); // كيرجعو للوجين
exit();
?>
