<?php
// Database connection details
$host = getenv('DB_HOST') ?: 'localhost';
$dbname = getenv('DB_NAME') ?: 'postgres';
$username = getenv('DB_USER') ?: 'postgres';
$password = getenv('DB_PASS') ?: 'root';

try {
    // Connect to PostgreSQL database
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get selected kingdoms from the POST request
    $selectedKingdoms = isset($_POST['kingdoms']) ? $_POST['kingdoms'] : [];

    // Array to store all locations
    $allLocations = [];

    // List of tables to query
    $tables = [
        'public.ayuttaya', 'public.cotraboon', 'public.funan', 'public.hripunchai',
        'public.janela', 'public.kamenravak', 'public.lanchang', 'public.lanna',
        'public.lavo', 'public.panakorn', 'public.ratanakosin', 'public.srivichai',
        'public.sukothai', 'public.tampornling'
    ];

    // Assuming input year, name, and relationship are provided via POST method
    $inputYear = isset($_POST['year']) ? intval($_POST['year']) : null;
    $eraType = isset($_POST['era']) ? $_POST['era'] : 'CE';
    $inputName = isset($_POST['name']) ? trim($_POST['name']) : null;
    $inputRelationship = isset($_POST['relationship']) ? trim($_POST['relationship']) : null;
    $reset = isset($_POST['reset']) ? true : false;

    // Convert Christian Era to Buddhist Era
    if ($eraType === 'CE' && $inputYear !== null) {
        $inputYear += 543;
    }

    if ($eraType === 'AP' && $inputYear !== null) {
        $inputYear += 2324;
    }

    // Process the relationship input for searching "รัชกาลที่"
    if (!empty($inputRelationship)) {
        if (preg_match('/^รัชกาลที่\s*(\d+)$/', $inputRelationship, $matches) || is_numeric($inputRelationship)) {
            $inputRelationship = 'รัชกาลที่ ' . (is_numeric($inputRelationship) ? $inputRelationship : $matches[1]);
        }
    }

    // Filter tables based on selected kingdoms
    if (!empty($selectedKingdoms)) {
        $tables = array_filter($tables, function($table) use ($selectedKingdoms) {
            foreach ($selectedKingdoms as $kingdom) {
                if (strpos($table, $kingdom) !== false) {
                    return true;
                }
            }
            return false;
        });
    }

    // Prepare and execute queries for each table
    foreach ($tables as $table) {
        if ($reset || ($inputYear === null && empty($inputName) && empty($inputRelationship))) {
            $stmt = $pdo->prepare("SELECT latitude, longitude, name, kingdomname, url, imgplace, reignstart, reignend, after, before, relationship FROM $table WHERE id = 1 LIMIT 1");
        } elseif (!empty($inputName)) {
            $stmt = $pdo->prepare("SELECT latitude, longitude, name, kingdomname, url, imgplace, reignstart, reignend, after, before, relationship FROM $table WHERE name ILIKE :name");
            $nameParam = '%' . $inputName . '%';
            $stmt->bindParam(':name', $nameParam, PDO::PARAM_STR);
        } elseif (!empty($inputRelationship)) {
            $stmt = $pdo->prepare("SELECT latitude, longitude, name, kingdomname, url, imgplace, reignstart, reignend, after, before, relationship FROM $table WHERE position(:relationship in relationship) > 0 ORDER BY id ASC LIMIT 1");
            $stmt->bindParam(':relationship', $inputRelationship, PDO::PARAM_STR);
        } elseif ($inputYear !== null) {
            $stmt = $pdo->prepare("SELECT latitude, longitude, name, kingdomname, url, imgplace, reignstart, reignend, after, before, relationship FROM $table WHERE :year BETWEEN reignstart AND reignend");
            $stmt->bindParam(':year', $inputYear, PDO::PARAM_INT);
        }
        $stmt->execute();
        $locations = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Append locations from the current table to the allLocations array
        foreach ($locations as $location) {
            $allLocations[] = $location;
        }
    }

    // Check if allLocations is empty
    if (empty($allLocations)) {
        echo "<p>No results found. Please adjust your search criteria.</p>";
    }

    // Encode locations as JSON to pass to JavaScript
    $locationsJson = json_encode($allLocations);
} catch (PDOException $e) {
    // Handle database connection error
    die("Database connection failed: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thailand Dynasty Map</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="styles.css">
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <style>
        #map {
            height: 889px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Thailand Dynasty Map</h1>
        <nav>
            <ul>
                <li><a href="index.php" class="active">Home</a></li>
                <li><a href="family_tree.php">Family Tree</a></li>
            </ul>
        </nav>
    </header>
    <div id="map">
    <div class="form-container">
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <fieldset>
                <legend>Select Kingdoms:</legend>
                <label><input type="checkbox" id="selectAll"> Select All</label><br>
                <?php
                // Array of kingdoms to generate checkboxes
                $kingdoms = [
                    'funan' => 'ฟูนาน',
                    'tampornling' => 'อาณาจักรตามพรลิงค์',
                    'janela' => 'เจนละ',
                    'hripunchai' => 'หริภุญชัย',
                    'srivichai' => 'อาณาจักรศรีวิชัย',
                    'panakorn' => 'อาณาจักรพระนคร',
                    'lavo' => 'อาณาจักรละโว้',
                    'sukothai' => 'อาณาจักรสุโขทัย',
                    'lanna' => 'อาณาจักรล้านนา',
                    'ayuttaya' => 'อาณาจักรอยุธยา',
                    'lanchang' => 'อาณาจักรล้านช้าง',
                    'kamenravak' => 'สมัยละแวก',
                    'ratanakosin' => 'กรุงรัตนโกสินทร์'
                ];

                foreach ($kingdoms as $kingdom => $label) {
                    echo "<label><input type='checkbox' name='kingdoms[]' value='$kingdom' checked> $label</label><br>";
                }
                
                ?>
            </fieldset>

            <label for="searchType">เลือกประเภทการค้นหา : </label>
            <select id="searchType" name="searchType" onchange="toggleSearchFields()">
                <option value="year" <?php echo (isset($_POST['searchType']) && $_POST['searchType'] === 'year') ? 'selected' : ''; ?>>ค้นหาด้วยปี</option>
                <option value="relationship" <?php echo (isset($_POST['searchType']) && $_POST['searchType'] === 'relationship') ? 'selected' : ''; ?>>ค้นหาด้วยคำว่ารัชกาล</option>
                <option value="name" <?php echo (isset($_POST['searchType']) && $_POST['searchType'] === 'name') ? 'selected' : ''; ?>>ค้นหาด้วยชื่อ</option>
            </select>

            <div id="searchByYear" style="display: none;">
                <label for="year">ใส่ปีศักราช : </label>
                <input type="number" id="year" name="year" value="<?php echo isset($_POST['reset']) ? '' : (isset($_POST['year']) ? htmlspecialchars($_POST['year']) : ''); ?>">
                <label for="era">เลือกปีศักราช : </label>
                <select id="era" name="era">
                    <option value="BE" <?php echo (!isset($_POST['era']) || $_POST['era'] === 'BE') ? 'selected' : ''; ?>>พุทธศักราช (พ.ศ.)</option>
                    <option value="CE" <?php echo (isset($_POST['era']) && $_POST['era'] === 'CE') ? 'selected' : ''; ?>>คริสต์ศักราช (ค.ศ.)</option>
                    <option value="AP" <?php echo (isset($_POST['era']) && $_POST['era'] === 'AP') ? 'selected' : ''; ?>>รัตนโกสินทรศก (ร.ศ.)</option>
                </select>
            </div>

            <div id="searchByRelationship" style="display: none;">
                <label for="relationship">ใส่รัชกาล : </label>
                <input type="number" id="relationship" name="relationship" value="<?php echo isset($_POST['reset']) ? '' : (isset($_POST['relationship']) ? htmlspecialchars($_POST['relationship']) : ''); ?>">
            </div>

            <div id="searchByName" style="display: none;">
                <label for="name">ใส่ชื่อ : </label>
                <input type="text" id="name" name="name" value="<?php echo isset($_POST['reset']) ? '' : (isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''); ?>">
            </div>

            <button type="submit" class="oval-button">ค้นหา</button>
            <button type="submit" name="reset" value="reset" class="oval-button">รีเซ็ต</button>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function toggleSearchFields() {
        var searchType = document.getElementById('searchType').value;
        document.getElementById('searchByYear').style.display = searchType === 'year' ? 'block' : 'none';
        document.getElementById('searchByRelationship').style.display = searchType === 'relationship' ? 'block' : 'none';
        document.getElementById('searchByName').style.display = searchType === 'name' ? 'block' : 'none';
    }

    window.onload = function() {
        toggleSearchFields();
    }

    function convertToCE(buddhistYear) {
        return buddhistYear !== null ? buddhistYear - 543 : 'ไม่ปรากฏ';
    }

    var map = L.map('map').setView([12.923828640427846, 100.8822441508516], 6);
    L.tileLayer('https://api.maptiler.com/maps/streets-v2/{z}/{x}/{y}.png?key=Qy0caTTPn0K7S8WaoZ1d', {
        attribution: '<a href="https://www.maptiler.com/copyright/" target="_blank">&copy; MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">&copy; OpenStreetMap contributors</a>'
    }).addTo(map);

    var locations = <?php echo $locationsJson; ?>;

    if (Array.isArray(locations) && locations.length) {
        locations.forEach(function(location) {
            if (location.latitude && location.longitude) {
                var reignStartCE = convertToCE(location.reignstart);
                var reignEndCE = convertToCE(location.reignend);

                var popupContent = `
                    <div style="text-align: center;">
                        <img src="${location.imgplace}" alt="${location.name}" style="width: 200px; height: auto; margin-bottom: 8px;">
                        <p style="margin-top: 8px;">
                            <a href="${location.url}" target="_blank">
                                <img src="https://logoeps.com/wp-content/uploads/2014/05/49360-wikipedia-logo-icon-vector-icon-vector-eps.png" alt="Wikipedia" style="width: 30px; height: auto; margin-right: 0px;">
                            </a>
                        </p>
                        <h3 style="margin-bottom: 8px;">${location.kingdomname}</h3>
                        <p>${location.relationship}</p>
                        <p>พระนาม : ${location.name}</p>
                        <p>พระองค์ก่อนหน้า : ${location.before ? location.before : 'ไม่ปรากฏ'}</p>
                        <p>พระองค์ถัดไป : ${location.after ? location.after : 'ไม่ปรากฏ'}</p>
                        <p>ปกครอง : พ.ศ. ${location.reignstart ? location.reignstart : 'ไม่ปรากฏ'} - พ.ศ. ${location.reignend ? location.reignend : 'ไม่ปรากฏ'}</p>
                        <p>ปกครอง : ค.ศ. ${reignStartCE} - ค.ศ. ${reignEndCE}</p>
                    </div>
                `;

                L.marker([location.latitude, location.longitude]).addTo(map)
                .bindPopup(popupContent);
            } else {
                console.warn('Invalid location data:', location);
            }
        });
    } else {
        console.warn('No location data available.');
    }

    // "Select All" functionality
    document.getElementById('selectAll').addEventListener('change', function() {
        var checkboxes = document.querySelectorAll('input[name="kingdoms[]"]');
        for (var checkbox of checkboxes) {
            checkbox.checked = this.checked;
        }
    });

    window.onload = function() {
    toggleSearchFields();
    
    // Set Select All checkbox to true
    document.getElementById('selectAll').checked = true;

    // Select all checkboxes
    var checkboxes = document.querySelectorAll('input[name="kingdoms[]"]');
    for (var checkbox of checkboxes) {
        checkbox.checked = true;
    }

    // Display marker with ID 1
    var markerId1 = locations.find(location => location.id == 1);
    if (markerId1) {
        var popupContent = `
            <div style="text-align: center;">
                <img src="${markerId1.imgplace}" alt="${markerId1.name}" style="width: 200px; height: auto; margin-bottom: 8px;">
                <p style="margin-top: 8px;">
                    <a href="${markerId1.url}" target="_blank">
                        <img src="https://logoeps.com/wp-content/uploads/2014/05/49360-wikipedia-logo-icon-vector-icon-vector-eps.png" alt="Wikipedia" style="width: 30px; height: auto; margin-right: 0px;">
                    </a>
                </p>
                <h3 style="margin-bottom: 8px;">${markerId1.kingdomname}</h3>
                <p>${markerId1.relationship}</p>
                <p>พระนาม : ${markerId1.name}</p>
                <p>พระองค์ก่อนหน้า : ${markerId1.before ? markerId1.before : 'ไม่ปรากฏ'}</p>
                <p>พระองค์ถัดไป : ${markerId1.after ? markerId1.after : 'ไม่ปรากฏ'}</p>
                <p>ปกครอง : พ.ศ. ${markerId1.reignstart ? markerId1.reignstart : 'ไม่ปรากฏ'} - พ.ศ. ${markerId1.reignend ? markerId1.reignend : 'ไม่ปรากฏ'}</p>
                <p>ปกครอง : ค.ศ. ${convertToCE(markerId1.reignstart)} - ค.ศ. ${convertToCE(markerId1.reignend)}</p>
            </div>
        `;

        // Add marker to map
        L.marker([markerId1.latitude, markerId1.longitude]).addTo(map)
            .bindPopup(popupContent)
            .openPopup();
    }
}

</script>

</body>
</html>
