<?php
// ข้อมูลการเชื่อมต่อฐานข้อมูลและการดึงข้อมูลจากฐานข้อมูลยังคงเหมือนเดิม
$host = "localhost";
$port = "5432";
$dbname = "postgres";
$user = "postgres";
$password = "root";

$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

if (!$conn) {
    die("Connection failed: " . pg_last_error());
}

$query = "
    SELECT name, reignstart, reignend, kingdomname, monarch FROM public.funan WHERE kingdomname IS NOT NULL
    UNION ALL
    SELECT name, reignstart, reignend, kingdomname, monarch FROM public.tampornling WHERE kingdomname IS NOT NULL
    UNION ALL
    SELECT name, reignstart, reignend, kingdomname, monarch FROM public.janela WHERE kingdomname IS NOT NULL
    UNION ALL
    SELECT name, reignstart, reignend, kingdomname, monarch FROM public.hripunchai WHERE kingdomname IS NOT NULL
    UNION ALL
    SELECT name, reignstart, reignend, kingdomname, monarch FROM public.srivichai WHERE kingdomname IS NOT NULL
    UNION ALL
    SELECT name, reignstart, reignend, kingdomname, monarch FROM public.panakorn WHERE kingdomname IS NOT NULL
    UNION ALL
    SELECT name, reignstart, reignend, kingdomname, monarch FROM public.lavo WHERE kingdomname IS NOT NULL
    UNION ALL
    SELECT name, reignstart, reignend, kingdomname, monarch FROM public.sukothai WHERE kingdomname IS NOT NULL
    UNION ALL
    SELECT name, reignstart, reignend, kingdomname, monarch FROM public.lanna WHERE kingdomname IS NOT NULL
    UNION ALL
    SELECT name, reignstart, reignend, kingdomname, monarch FROM public.ayuttaya WHERE kingdomname IS NOT NULL
    UNION ALL
    SELECT name, reignstart, reignend, kingdomname, monarch FROM public.lanchang WHERE kingdomname IS NOT NULL
    UNION ALL
    SELECT name, reignstart, reignend, kingdomname, monarch FROM public.kamenravak WHERE kingdomname IS NOT NULL
    UNION ALL
    SELECT name, reignstart, reignend, kingdomname, monarch FROM public.ratanakosin WHERE kingdomname IS NOT NULL
    ORDER BY reignstart ASC, reignend ASC;
";

$result = pg_query($conn, $query);

if (!$result) {
    die("Error in SQL query: " . pg_last_error());
}

$timeline_data = array();
while ($row = pg_fetch_assoc($result)) {
    $timeline_data[] = $row;
}

$kingdom_query = "SELECT DISTINCT kingdomname FROM (
    SELECT kingdomname FROM public.funan
    UNION ALL
    SELECT kingdomname FROM public.tampornling
    UNION ALL
    SELECT kingdomname FROM public.janela
    UNION ALL
    SELECT kingdomname FROM public.hripunchai
    UNION ALL
    SELECT kingdomname FROM public.srivichai
    UNION ALL
    SELECT kingdomname FROM public.panakorn
    UNION ALL
    SELECT kingdomname FROM public.lavo
    UNION ALL
    SELECT kingdomname FROM public.sukothai
    UNION ALL
    SELECT kingdomname FROM public.lanna
    UNION ALL
    SELECT kingdomname FROM public.ayuttaya
    UNION ALL
    SELECT kingdomname FROM public.lanchang
    UNION ALL
    SELECT kingdomname FROM public.kamenravak
    UNION ALL
    SELECT kingdomname FROM public.ratanakosin
) as kingdoms WHERE kingdomname IS NOT NULL ORDER BY kingdomname ASC;";

$kingdom_result = pg_query($conn, $kingdom_query);

$kingdoms = [];
while ($row = pg_fetch_assoc($kingdom_result)) {
    $kingdoms[] = $row['kingdomname'];
}

pg_close($conn);

$desired_order = [
    'ฟูนาน',
    'อาณาจักรตามพรลิงค์',
    'เจนละ',
    'หริภุญชัย',
    'อาณาจักรศรีวิชัย',
    'อาณาจักรพระนคร',
    'อาณาจักรละโว้',
    'อาณาจักรสุโขทัย',
    'อาณาจักรล้านนา',
    'อาณาจักรอยุธยา',
    'อาณาจักรล้านช้าง',
    'สมัยละแวก',
    'กรุงรัตนโกสินทร์'
];

usort($kingdoms, function($a, $b) use ($desired_order) {
    $pos_a = array_search($a, $desired_order);
    $pos_b = array_search($b, $desired_order);
    return $pos_a - $pos_b;
});
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Horizontal Timeline with Overlapping Rulers</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f2f5;
            color: #333;
        }

        header {
            background-color: #007bff;
            padding: 15px 0;
            color: #ffffff;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-bottom: 2px solid #0056b3;
        }

        header h1 {
            margin: 0;
            font-size: 32px;
            font-weight: bold;
        }

        nav ul {
            list-style-type: none;
            padding: 0;
            margin: 15px 0 0 0;
            display: flex;
            justify-content: center;
        }

        nav ul li {
            margin: 0 15px;
        }

        nav ul li a {
            color: #ffffff;
            text-decoration: none;
            font-size: 18px;
            padding: 8px 15px;
            border-radius: 5px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        nav ul li a:hover,
        nav ul li a.active {
            background-color: #0056b3;
            color: #ffffff;
        }

        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px;
            background-color: #ffffff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 20px;
        }

        .select-all-container {
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }

        .select-all-container input {
            margin-right: 10px;
        }

        .kingdom-filters {
            margin-bottom: 20px;
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }

        .kingdom-filters label {
            display: flex;
            align-items: center;
            background-color: #e9ecef;
            padding: 10px 15px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .kingdom-filters input {
            margin-right: 10px;
        }

        .kingdom-filters label:hover {
            background-color: #dee2e6;
        }

        .timeline-wrapper {
            position: relative;
            overflow-x: auto;
            white-space: nowrap;
            padding: 20px;
            background-color: #e9ecef;
            border-radius: 10px;
            box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .timeline-group {
            display: flex;
            flex-direction: row;
            align-items: flex-start;
            margin-bottom: 30px;
            position: relative;
        }

        .timeline-group .year-label {
            margin-right: 20px; /* Space between year label and items */
            font-weight: bold;
            color: #4a90e2;
            font-size: 16px;
            text-align: center;
            text-transform: uppercase;
            width: 80px; /* Fixed width for year label */
        }

        .timeline-items {
            display: flex;
            flex-direction: row;
            flex-wrap: nowrap;
            overflow-x: auto;
            gap: 15px;
        }

        .timeline-item {
            position: relative;
            padding: 15px;
            border: 1px solid #ced4da;
            border-radius: 8px;
            background-color: #ffffff;
            text-align: center;
            min-width: 200px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease-in-out;
        }

        .timeline-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .timeline-item h3 {
            margin: 0 0 10px 0;
            font-size: 18px;
            color: #333;
        }

        .timeline-item p {
            margin: 5px 0;
            font-size: 14px;
            color: #6c757d;
        }

        .timeline-item p:last-child {
            font-weight: bold;
            color: #007bff;
        }
    </style>
</head>
<body>
    <header>
        <h1>Timeline</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="family_tree.php">Family Tree</a></li>
                <li><a href="timeline.php" class="active">Timeline</a></li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <div class="select-all-container">
            <input type="checkbox" id="select-all">
            <label for="select-all">Select All</label>
        </div>
        <div class="kingdom-filters">
            <!-- Checkboxes for kingdoms will be dynamically generated here -->
        </div>
        <div class="timeline-wrapper" id="timeline-wrapper">
            <!-- Timeline items will be generated here by JavaScript -->
        </div>
    </div>

    <script>
        const timelineData = <?php echo json_encode($timeline_data); ?>;
        const timelineWrapper = document.getElementById('timeline-wrapper');
        const filterContainer = document.querySelector('.kingdom-filters');

        function renderCheckboxes() {
            const kingdoms = [...new Set(timelineData.map(item => item.kingdomname))];
            kingdoms.forEach(kingdom => {
                const label = document.createElement('label');
                const checkbox = document.createElement('input');
                checkbox.type = 'checkbox';
                checkbox.value = kingdom;
                checkbox.checked = true;
                checkbox.addEventListener('change', renderTimeline);
                label.appendChild(checkbox);
                label.appendChild(document.createTextNode(kingdom));
                filterContainer.appendChild(label);
            });

            // Add select all checkbox functionality
            document.getElementById('select-all').addEventListener('change', (e) => {
                const isChecked = e.target.checked;
                document.querySelectorAll('.kingdom-filters input[type=checkbox]').forEach(checkbox => {
                    checkbox.checked = isChecked;
                });
                renderTimeline();
            });
        }

        function renderTimeline() {
            // Clear the current timeline
            timelineWrapper.innerHTML = '';

            // Get selected kingdoms
            const selectedKingdoms = [...filterContainer.querySelectorAll('input[type=checkbox]:not(#select-all)')]
                .filter(checkbox => checkbox.checked)
                .map(checkbox => checkbox.value);

            // Filter data based on selected kingdoms and reign start year
            const filteredData = timelineData.filter(item =>
                item.reignstart !== null && selectedKingdoms.includes(item.kingdomname)
            );

            // Group data by reign start year
            const groupedData = {};
            filteredData.forEach(item => {
                const startYear = item.reignstart;
                if (!groupedData[startYear]) {
                    groupedData[startYear] = [];
                }
                groupedData[startYear].push(item);
            });

            // Generate timeline elements
            Object.keys(groupedData).forEach(year => {
                const group = groupedData[year];
                const groupDiv = document.createElement('div');
                groupDiv.classList.add('timeline-group');

                // Add the year label
                const yearLabel = document.createElement('div');
                yearLabel.classList.add('year-label');
                yearLabel.innerText = `พ.ศ. ${year}`;
                groupDiv.appendChild(yearLabel);

                // Add a container for timeline items
                const itemsDiv = document.createElement('div');
                itemsDiv.classList.add('timeline-items');

                // Add ruler items
                group.forEach(item => {
                    const itemDiv = document.createElement('div');
                    itemDiv.classList.add('timeline-item');

                    itemDiv.innerHTML = 
                        `<h3>${item.name}</h3>
                        <p>${item.kingdomname}</p>
                        <p>ปกครอง : พ.ศ. ${item.reignstart} - พ.ศ. ${item.reignend}</p>
                        <p>ราชวงศ์ : ${item.monarch}</p>`;

                    itemsDiv.appendChild(itemDiv);
                });

                groupDiv.appendChild(itemsDiv);
                timelineWrapper.appendChild(groupDiv);
            });
        }

        // Initial render
        renderCheckboxes();
        renderTimeline();
    </script>
</body>
</html>


