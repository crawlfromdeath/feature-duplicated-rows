<?php
	if ($_GET['view'] == '') {
		if ($_GET['pk'] == 'KKyttFCksn8Eg3vygW3LDRKjeFTuSdddzBwCSXMa') {
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
			
			header('Content-Type: application/json');
			header('Access-Control-Allow-Origin: https://releases.feature.com');
			header('Access-Control-Allow-Methods: GET');
			header("Access-Control-Allow-Headers: X-Requested-With");
			
			$arr = array('status' => 200, 'message' => 'Done');
			echo json_encode($arr);
		}
		else {
			header('Content-Type: application/json');
			header('Access-Control-Allow-Origin: https://releases.feature.com');
			header('Access-Control-Allow-Methods: GET');
			header("Access-Control-Allow-Headers: X-Requested-With");

			$arr = array('status' => 503, 'message' => 'Denied');
			echo json_encode($arr);
		}

		// $data = $stmt->get_result();

		// $arr = array();

		// while ($row = mysqli_fetch_array($data)) {
		// 	$arr[$row['variant'] . '_' . $row['shopify_customer_id']][] = $row['id'];
		// }

		// $arr_to_delete = array();

		// foreach ($arr as $arr_each) {
		// 	if (count($arr_each) > 1) {
		// 		for ($i = 1; $i <= count($arr_each) - 1; $i++) {
		// 			$arr_to_delete[] = $arr_each[$i];
		// 		}
		// 	}
		// }

		// if (count($arr_to_delete) > 0) {
		// 	foreach ($arr_to_delete as $key) {
		// 		$sql = "DELETE from Entries where id = '" . $key . "'";

		// 		$stmt = $connection->prepare($sql);
		// 		$stmt->execute();
		// 	}
		// }
	}
	else {
		if ($_GET['view'] == 'cdb') {
			if ($_GET['pk'] == 'VmTUjTqxzQzUkGWMkWDHryF3qPsV3qMAmg6gMkDb') {
				$connection = mysqli_connect("db-mysql-sfo3-52037-do-user-4596315-0.b.db.ondigitalocean.com","doadmin","qmdvp61fnm8azm2u","defaultdb", "25060");

				if (mysqli_connect_errno()) {
			  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
			  		exit();
				}

				$sql = "TRUNCATE `Entries`";

				$stmt = $connection->prepare($sql);
				$stmt->execute();

				header('Content-Type: application/json');
				header('Access-Control-Allow-Origin: https://releases.feature.com');
				header('Access-Control-Allow-Methods: GET');
				header("Access-Control-Allow-Headers: X-Requested-With");

				$arr = array('status' => 200, 'message' => 'Done');
				echo json_encode($arr);
			}
		}
		if ($_GET['view'] == 'all') {
			$connection = mysqli_connect("db-mysql-sfo3-52037-do-user-4596315-0.b.db.ondigitalocean.com","doadmin","qmdvp61fnm8azm2u","defaultdb", "25060");

			if (mysqli_connect_errno()) {
		  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		  		exit();
			}

			$sql = "SELECT id, variant, shopify_customer_id FROM Entries order by id desc";

			$stmt = $connection->prepare($sql);
			$stmt->execute();

			$data = $stmt->get_result();

			$arr = array();

			while ($row = mysqli_fetch_array($data)) {
				echo $row['variant'] . '_' . $row['shopify_customer_id'] . '_' . $row['id'] . '_' . $row['shopify_order_id'] . "\n";
			}

		}
		if ($_GET['view'] == 'group') {
			$connection = mysqli_connect("db-mysql-sfo3-52037-do-user-4596315-0.b.db.ondigitalocean.com","doadmin","qmdvp61fnm8azm2u","defaultdb", "25060");

			if (mysqli_connect_errno()) {
		  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		  		exit();
			}

			$sql = "SELECT MAX(id) as id, variant, shopify_customer_id, COUNT(*) FROM Entries GROUP BY variant, shopify_customer_id HAVING COUNT(*) > 1";

			$stmt = $connection->prepare($sql);
			$stmt->execute();

			$data = $stmt->get_result();

			$arr = array();

			while ($row = mysqli_fetch_array($data)) {
				echo $row['variant'] . '_' . $row['shopify_customer_id'] . '_' . $row['id'] . '_' . $row['shopify_order_id'] . "\n";
			}
		}
	}
