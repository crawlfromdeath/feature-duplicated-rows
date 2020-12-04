<?php
	$connection = mysqli_connect("db-mysql-sfo3-52037-do-user-4596315-0.b.db.ondigitalocean.com","doadmin","qmdvp61fnm8azm2u","defaultdb", "25060");

	if (mysqli_connect_errno()) {
  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
  		exit();
	}

	$sql = "DELETE a
		  FROM Entries a
		  JOIN (SELECT MAX(t.id) AS max_a1, t.variant, t.shopify_customer_id
			  FROM Entries t
		      GROUP BY t.variant, t.shopify_customer_id
			HAVING COUNT(*) > 1) b ON b.shopify_customer_id = a.shopify_customer_id
					      AND b.variant = a.variant
					      AND b.max_a1 != a.id";

	$stmt = $connection->prepare($sql);
	$stmt->execute();
