# 🪰 Ovitracker API
**PHP REST API for Community-Based Mosquito Surveillance**

Ovitracker API powers the web and mobile applications for mosquito ovitrap surveillance across communities in Jamaica.  
It provides secure RESTful endpoints to record, retrieve, and analyze ovitrap data — supporting early dengue intervention and GIS-based vector tracking.

Developed and maintained by **Kamron Bennett**  
Public Health Inspector, GIS Transformation Unit  
Kingston & St. Andrew Health Department

---

## 🌍 Overview

This API is part of the **Ovitracker Ecosystem**, which combines:
- **Frontend (React/Vite Web App)** – for mapping, analytics, and visualization  
- **Backend (PHP + MySQL API)** – for data storage, retrieval, and analysis  

The API handles:
- Trap registration  
- Trap reading uploads (egg count, date, coordinates, etc.)  
- Community lookups  
- Risk classification  
- Data feed for GIS dashboards

---

## 🧩 Folder Structure

ovitracker-backend/
│
├── api/
│ ├── get-traps.php
│ ├── get-readings.php
│ ├── add-readings.php
│ ├── get-communities.php
│ ├── get-coords-metric-projection.php
│ └── index.php
│
├── config/
│ ├── db.php
│ └── .htaccess
│
├── index.php
└── .htaccess


---

## ⚙️ Installation (Ubuntu 22.04)

### 1. Install LAMP stack
```bash
sudo apt update
sudo apt install apache2 mysql-server php libapache2-mod-php php-mysql
sudo systemctl enable apache2
sudo systemctl start apache2


2. Clone the Repository
cd /var/www/html
sudo git clone https://github.com/kamronb/ovitracker-api.git ovitracker-backend
sudo chown -R $USER:$USER ovitracker-backend


3. Configure Database
$host = 'localhost';
$dbname = 'ovitracker';
$username = 'root';
$password = '';


🧪 API Endpoints
| Endpoint                                | Method | Description                             |
| --------------------------------------- | ------ | --------------------------------------- |
| `/api/get-traps.php`                    | `GET`  | Retrieve all traps with latest readings |
| `/api/get-readings.php`                 | `GET`  | Retrieve readings for all traps         |
| `/api/add-readings.php`                 | `POST` | Submit a new ovitrap reading            |
| `/api/get-communities.php`              | `GET`  | Fetch community polygons                |
| `/api/get-coords-metric-projection.php` | `GET`  | Retrieve coordinate conversions         |

📦 Sample API Request
POST /api/add-readings.php
curl -X POST https://yourdomain/api/add-readings.php \
     -H "Content-Type: application/json" \
     -d '{
          "trap_id": "KSA_001",
          "egg_count": 42,
          "latitude": 17.992049,
          "longitude": -76.786233,
          "user_id": "kbennett",
          "risk_level": "moderate"
         }'

Response:
{
  "status": "success",
  "message": "Reading added successfully"
}

🛡️ Security Notes

Use HTTPS when deploying publicly.

Sanitize and validate all inputs.

Consider adding API keys or JWT authentication for production.


🧰 Tech Stack
Component	Technology
Backend Language	PHP 8.x
Database	MySQL 8
Server	Apache2
OS	Ubuntu 22.04 LTS


📫 Contact

Kamron Bennett
Public Health Inspector, GIS Transformation Unit
Kingston & St. Andrew Health Department
📧 kbennett@serha.gov.jm

🏛️ Acknowledgements

Thanks to the Ministry of Health & Wellness, University of Technology, and University of the West Indies (Mona) for supporting innovation in public health surveillance and GIS applications.




