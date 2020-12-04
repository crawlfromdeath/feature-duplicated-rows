<?php
	$connection = mysqli_connect("db-mysql-sfo3-52037-do-user-4596315-0.b.db.ondigitalocean.com","doadmin","qmdvp61fnm8azm2u","defaultdb", "25060");

	if (mysqli_connect_errno()) {
  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
  		exit();
	}

	$sql = "select id, variant, shopify_customer_id from Entries order by id desc limit 1";

	$stmt = $connection->prepare($sql);
	$stmt->execute();

	$data = $stmt->get_result();

	$arr = array();

	while ($row = mysqli_fetch_array($data)) {
		$arr[$row['variant'] . '_' . $row['shopify_customer']][] = $row['id'];
	}

	print_r($arr);
