<?php
	$connection = mysqli_connect("db-mysql-sfo3-52037-do-user-4596315-0.b.db.ondigitalocean.com","doadmin","qmdvp61fnm8azm2u","defaultdb", "25060");

	if (mysqli_connect_errno()) {
  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
  		exit();
	}

	$sql = "select product, variant, shopify_customer_id, count(*) as NumDuplicates
			from table
			group by product, variant, shopify_customer_id
			having NumDuplicates > 1";

	$stmt = $connection->prepare($sql);
	$stmt->execute();

	$data = $stmt->get_result();

	while ($row = mysqli_fetch_array($data)) {
		print_r($row);
	}
