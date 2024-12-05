<?php
session_start();
session_destroy();
header('Location:../../view/login/iniciar_sesion.php');