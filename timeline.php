<?php
// ข้อมูลการเชื่อมต่อฐานข้อมูล
$host = "localhost";
$port = "5432";
$dbname = "postgres";
$user = "postgres";
$password = "root";

// สร้างการเชื่อมต่อกับฐานข้อมูล
$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

// ตรวจสอบการเชื่อมต่อ
if (!$conn) {
    die("Connection failed: " . pg_last_error());
}

// คำสั่ง SQL เพื่อดึงข้อมูลจากหลายตาราง เฉพาะที่ kingdomname ไม่ใช่ NULL
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

// ดึงข้อมูลจากฐานข้อมูล
$result = pg_query($conn, $query);

// ตรวจสอบว่ามีข้อมูลหรือไม่
if (!$result) {
    die("Error in SQL query: " . pg_last_error());
}

// เก็บข้อมูลในรูปแบบ JSON
$timeline_data = array();
while ($row = pg_fetch_assoc($result)) {
    $timeline_data[] = $row;
}

// Get unique kingdom names for checkboxes
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

// ปิดการเชื่อมต่อฐานข้อมูล
pg_close($conn);

// ลำดับที่ต้องการให้ checkbox แสดงผล
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

// จัดเรียง $kingdoms ให้ตรงกับลำดับที่ต้องการ
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
    <title>Dynamic Timeline with Filters</title>
    <link rel="stylesheet" href="styles.css">
    
</head>
<body>
    <header>
        <h1>Timeline</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="family_tree.php">Family Tree</a></li>
                <li><a href="timeline.php" class="active">timeline</a></li>
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
                    <input type="checkbox" class="kingdom-filter" value="<?php echo htmlspecialchars($kingdom, ENT_QUOTES, 'UTF-8'); ?>" checked>
                    <?php echo htmlspecialchars($kingdom, ENT_QUOTES, 'UTF-8'); ?>
                </label>
            <?php endforeach; ?>
        </div>
        <div class="timeline" id="timeline"></div>
    </div>

    <script>
        const timelineData = <?php echo json_encode($timeline_data, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP); ?>;
        const timeline = document.getElementById('timeline');
        const checkboxes = document.querySelectorAll('.kingdom-filter');
        const selectAllCheckbox = document.getElementById('select-all');

        function renderTimeline(filteredData) {
            timeline.innerHTML = ''; // ล้างข้อมูลเก่าออก
            filteredData.forEach(item => {
                const timelineItem = document.createElement('div');
                timelineItem.classList.add('timeline-item');
                timelineItem.innerHTML = `
                    <h3>${item.name}</h3>
                    <p>${item.kingdomname}</p>
                    <p>ปกครอง : พ.ศ. ${item.reignstart ? item.reignstart : 'ไม่ปรากฏ'} - พ.ศ. ${item.reignend ? item.reignend : 'ไม่ปรากฏ'}</p>
                    <p>ราชวงศ์ : ${item.monarch ? item.monarch : 'ไม่ปรากฎ'}</p>
                `;
                timeline.appendChild(timelineItem);
            });
        }

        function filterTimeline() {
            const selectedKingdoms = Array.from(checkboxes)
                .filter(checkbox => checkbox.checked)
                .map(checkbox => checkbox.value);

            const filteredData = timelineData.filter(item => selectedKingdoms.includes(item.kingdomname));
            renderTimeline(filteredData);
        }

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
