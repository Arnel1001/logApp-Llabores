<?php

#start session
session_start();

#unset the sessions to stop
session_unset($_SESSION['user']);
session_unset($_SESSION['pass']);
?>