<?php 
define('APP_ROOT', __DIR__);
require_once __DIR__ . '/../config/db.php';
header('Content-Type: application/json');

try {
	$stmt = $pdo->query("SELECT id, code, name, ST_AsGeoJSON(ST_Transform(polygon, 3857)) AS geometry FROM communities");
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

	$features = [];
	foreach ($rows as $row) {
		$features[] = [
			'type' => 'Feature',
			'properties' => [
				'id' => $row['id'],
				'name' => $row['name'],
				'code' => $row['code']
			],
			'polygon' => json_decode($row['polygon'])
		];
	}
	echo json_encode(['type' => 'FeatureCollection', 'features' => $features]);
} catch (Exception $e) {
	echo json_encode(['error' => $e->getMessage()]);
}

?>