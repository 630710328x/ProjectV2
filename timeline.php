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
    <title>Horizontal Timeline with Arrows</title>
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
            padding: 10px 0;
            color: #ffffff;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        header h1 {
            margin: 0;
            font-size: 28px;
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
            padding: 5px 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        nav ul li a:hover,
        nav ul li a.active {
            background-color: #0056b3;
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
        }

        .timeline-range {
            display: inline-block;
            vertical-align: top;
            width: 280px;
            margin-right: 15px;
            border: 1px solid #ced4da;
            border-radius: 8px;
            background-color: #f8f9fa;
            padding: 15px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .timeline-range h2 {
            font-size: 20px;
            color: #495057;
            text-align: center;
            margin-bottom: 10px;
        }
        .timeline-item {
            margin-bottom: 15px;
            padding: 15px;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            overflow: hidden; /* Ensures content does not overflow */
            text-overflow: ellipsis; /* Adds '...' to indicate overflow */
            white-space: nowrap; /* Prevents text from wrapping to a new line */
}

        .timeline-item h3 {
            margin: 0 0 5px 0;
            font-size: 18px;
            color: #343a40;
        }

        .timeline-item p {
            margin: 5px 0;
            font-size: 14px;
            color: #6c757d;
        }

        .timeline-range:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }

        .timeline::-webkit-scrollbar {
            height: 8px;
        }

        .timeline::-webkit-scrollbar-thumb {
            background-color: #adb5bd;
            border-radius: 4px;
        }

        .timeline::-webkit-scrollbar-thumb:hover {
            background-color: #6c757d;
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
            <input type="checkbox" id="select-all" checked>
            <label for="select-all">Select All</label>
        </div>
        <div class="kingdom-filters">
            <?php foreach ($kingdoms as $kingdom): ?>
                <label>
                    <input type="checkbox" class="kingdom-filter" value="<?php echo htmlspecialchars($kingdom); ?>" checked>
                    <?php echo htmlspecialchars($kingdom); ?>
                </label>
            <?php endforeach; ?>
        </div>
        <div class="timeline-wrapper">
            <div id="timeline" class="timeline"></div>
        </div>
    </div>

    <script>
        const timelineData = <?php echo json_encode($timeline_data); ?>;
        const timeline = document.getElementById('timeline');
        const checkboxes = document.querySelectorAll('.kingdom-filter');
        const selectAllCheckbox = document.getElementById('select-all');

        // ฟังก์ชันเพื่อจัดกลุ่มข้อมูลตามช่วงปี
        function groupByYearRange(data, range) {
            const groupedData = {};
            data.forEach(item => {
                const startYear = Math.floor(item.reignstart / range) * range;
                const endYear = startYear + range - 1;
                const key = `${startYear} - ${endYear}`;
                if (!groupedData[key]) {
                    groupedData[key] = [];
                }
                groupedData[key].push(item);
            });
            return groupedData;
        }

        // ฟังก์ชันเพื่อแสดงไทม์ไลน์
        function renderTimeline(filteredData) {
            const groupedData = groupByYearRange(filteredData, 100); // เปลี่ยนช่วงเวลาได้ตามต้องการ เช่น 50 ปี
            timeline.innerHTML = ''; // ล้างข้อมูลเก่าออก

            Object.keys(groupedData).forEach(range => {
                const rangeSection = document.createElement('div');
                rangeSection.classList.add('timeline-range');
                rangeSection.innerHTML = `<h2>${range}</h2>`;
                
                groupedData[range].forEach(item => {
                    const timelineItem = document.createElement('div');
                    timelineItem.classList.add('timeline-item');
                    timelineItem.innerHTML = `
                        <h3>${item.name}</h3>
                        <p>${item.kingdomname}</p>
                        <p>ปกครอง : พ.ศ. ${item.reignstart ? item.reignstart : 'ไม่ปรากฏ'} - พ.ศ. ${item.reignend ? item.reignend : 'ไม่ปรากฏ'}</p>
                        <p>ราชวงศ์ : ${item.monarch ? item.monarch : 'ไม่ปรากฎ'}</p>
                    `;
                    rangeSection.appendChild(timelineItem);
                });

                timeline.appendChild(rangeSection);
            });

            updateArrows();
        }

        function filterTimeline() {
            const selectedKingdoms = Array.from(checkboxes)
                .filter(checkbox => checkbox.checked)
                .map(checkbox => checkbox.value);

            const filteredData = timelineData.filter(item => selectedKingdoms.includes(item.kingdomname));
            renderTimeline(filteredData);
        }

        function updateArrows() {
            arrowLeft.disabled = timeline.scrollLeft === 0;
            arrowRight.disabled = timeline.scrollLeft + timeline.clientWidth >= timeline.scrollWidth;
        }
        

        timeline.addEventListener('scroll', updateArrows);

        // Initial render
        filterTimeline();

        // Add event listeners to checkboxes
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', filterTimeline);
        });

        // "Select All" functionality
        selectAllCheckbox.addEventListener('change', () => {
            const isChecked = selectAllCheckbox.checked;
            checkboxes.forEach(checkbox => {
                checkbox.checked = isChecked;
            });
            filterTimeline();
        });
    </script>
</body>
</html>
