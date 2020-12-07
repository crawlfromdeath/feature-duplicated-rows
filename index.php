<?php
	if ($_GET['view'] == '') {
		$connection = mysqli_connect("db-mysql-sfo3-52037-do-user-4596315-0.b.db.ondigitalocean.com","doadmin","qmdvp61fnm8azm2u","defaultdb", "25060");

		if (mysqli_connect_errno()) {
	  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  		exit();
		}
		
		$offset = 20000 * $_GET['page'];

		$sql = "select id, variant, shopify_customer_id from Entries order by id desc limit 20000 offset " . $offset;

		$stmt = $connection->prepare($sql);
		$stmt->execute();

		$data = $stmt->get_result();

		$arr = array();

		while ($row = mysqli_fetch_array($data)) {
			$arr[$row['variant'] . '_' . $row['shopify_customer_id']][] = $row['id'];
		}

		$arr_to_delete = array();

		foreach ($arr as $arr_each) {
			if (count($arr_each) > 1) {
				for ($i = 1; $i <= count($arr_each) - 1; $i++) {
					$arr_to_delete[] = $arr_each[$i];
				}
			}
		}

		if (count($arr_to_delete) > 0) {
			foreach ($arr_to_delete as $key) {
				$sql = "DELETE from Entries where id = '" . $key . "'";

				$stmt = $connection->prepare($sql);
				$stmt->execute();
			}
		}
	}
	else {
		$connection = mysqli_connect("db-mysql-sfo3-52037-do-user-4596315-0.b.db.ondigitalocean.com","doadmin","qmdvp61fnm8azm2u","defaultdb", "25060");

		if (mysqli_connect_errno()) {
	  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  		exit();
		}
		
		$offset = 20000 * $_GET['page'];

		$sql = "select id, variant, shopify_customer_id from Entries order by id desc limit 20000 offset " . $offset;

		$stmt = $connection->prepare($sql);
		$stmt->execute();

		$data = $stmt->get_result();

		$arr = array();

		while ($row = mysqli_fetch_array($data)) {
			$arr[$row['variant'] . '_' . $row['shopify_customer_id']][] = $row['id'];
		}
		
		print_r($arr);

		$arr_to_delete = array();

		foreach ($arr as $arr_each) {
			if (count($arr_each) > 1) {
				for ($i = 1; $i <= count($arr_each) - 1; $i++) {
					$arr_to_delete[] = $arr_each[$i];
				}
			}
		}

		print_r($arr_to_delete);
	}
