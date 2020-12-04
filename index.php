<?php
	$mysqli = new mysqli("db-mysql-sfo3-52037-do-user-4596315-0.b.db.ondigitalocean.com","doadmin","qmdvp61fnm8azm2u","defaultdb", "25060");

	if ($mysqli->connect_errno) {
  		echo "Failed to connect to MySQL: " . $mysqli->connect_error;
  		exit();
	}
