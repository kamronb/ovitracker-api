-- 🪰 Ovitracker API Sample Database Schema
-- Database: ovitracker

CREATE DATABASE IF NOT EXISTS ovitracker;
USE ovitracker;

-- Communities table: holds community polygons or names
CREATE TABLE communities (
    id INT AUTO_INCREMENT PRIMARY KEY,
    parish VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL,
    polygon GEOMETRY NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Traps table: holds static trap info
CREATE TABLE traps (
    trap_id VARCHAR(100) PRIMARY KEY,
    latitude DECIMAL(10, 6) NOT NULL,
    longitude DECIMAL(10, 6) NOT NULL,
    community_id INT,
    FOREIGN KEY (community_id) REFERENCES communities(id)
);

-- Readings table: stores ovitrap egg counts and risk levels
CREATE TABLE trap_readings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    trap_id VARCHAR(100),
    egg_count INT NOT NULL,
    risk_level ENUM('low', 'moderate', 'high') NOT NULL DEFAULT 'low',
    date_collected DATE NOT NULL,
    user_id VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (trap_id) REFERENCES traps(trap_id)
);

-- Users (optional if authentication added later)
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) UNIQUE NOT NULL,
    email VARCHAR(255),
    role ENUM('admin', 'participant', 'viewer') DEFAULT 'participant',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert a sample community
INSERT INTO communities (parish, name, polygon)
VALUES ('Kingston', 'Half Way Tree', ST_GeomFromText('POLYGON((-76.793 17.991, -76.787 17.991, -76.787 17.995, -76.793 17.995, -76.793 17.991))', 4326));

-- Insert a sample trap
INSERT INTO traps (trap_id, latitude, longitude, community_id)
VALUES ('KSA001', 17.993, -76.790, 1);

-- Insert a sample reading
INSERT INTO trap_readings (trap_id, egg_count, risk_level, date_collected, user_id)
VALUES ('KSA001', 35, 'moderate', '2025-10-22', 'kbennett');

