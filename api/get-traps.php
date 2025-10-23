<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
//These above allow accessing this endpoint from outside of the host domain

define('APP_ROOT', __DIR__);
require_once __DIR__ . '/../config/db.php';
header('Content-Type: application/json');

try {
	$stmt = $pdo->query("SELECT t.trap_id, t.community_id, r.date_collected, t.community_name, t.location_description, t.latitude, t.placement, t.longitude, r.egg_count, r.risk_level, r.user_id FROM traps t JOIN trap_readings r ON t.trap_id = r.trap_id ORDER BY r.date_collected DESC");
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

	$traps_data = [];
	foreach ($rows as $row) {
		$traps_data[] = [
			"Trap ID" => $row['trap_id'],
			"Latitude" => $row['latitude'],
			"Longitude" => $row['longitude'],
			"Community Name" => $row['community_name'],
			"Community ID" => $row['community_id'],
			"Location Description" => $row['location_description'],
			"Egg count" => $row['egg_count'],
			"Risk Level" => $row['risk_level'],
			"Collection Date" => $row['date_collected'],
			"Collected By" => $row['user_id'],
			"Placement" => $row['placement']
		];
	}

// Send the JSON Response
	echo json_encode([
		"status" => "success",
		"count" => count($traps_data),
		"data" => $traps_data
	]);



} catch (Exception $e) {
	http_response_code(500);
	echo json_encode([
		"status" => "error",
		"message" => "Error detected: " . $e->getMessage()
	]);
}
?>
