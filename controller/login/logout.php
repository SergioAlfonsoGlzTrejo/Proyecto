<?php
session_start();
session_destroy();
header('Location:../../view/principal/login.php?ok=1');