<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
//These above allow accessing this endpoint from outside of the host domain


define('APP_ROOT', __DIR__);
require_once __DIR__ . '/../config/db.php';
header('Content-Type: application/json');

try {
    $stmt = $pdo->query("SELECT id, name, code, area_km2, ST_AsGeoJSON(polygon) AS geometry FROM communities");
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $features = [];
    foreach ($rows as $row) {
        $features[] = [
            'type' => 'Feature',
            'properties' => [
                'id' => $row['id'],
                'name' => $row['name'],
                'code' => $row['code'],
                'area' => $row['area_km2']
            ],
            'geometry' => json_decode($row['geometry'])
        ];
    }

    echo json_encode(['type' => 'FeatureCollection', 'features' => $features]);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}


?>
