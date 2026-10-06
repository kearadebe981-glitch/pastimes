<?php
require "db.php";
session_destroy();
header("Location: index.php?msg=You have been logged out.");
exit;
