<?php
// Database connection
$host = "localhost";
$port = "5432";
$dbname = "postgres";
$user = "postgres";
$password = "root";

$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

if (!$conn) {
    die("Connection failed: " . pg_last_error());
}

// Kingdoms
$tables = [
    'funan',
    'tampornling',
    'janela',
    'hripunchai',
    'srivichai',
    'panakorn',
    'lavo',
    'sukothai',
    'lanna',
    'ayuttaya',
    'cotraboon',
    'lanchang',
    'kamenravak',
    'ratanakosin'
];

// Mapping ชื่ออาณาจักรภาษาอังกฤษเป็นภาษาไทย
$kingdomNamesThai = [
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
    'cotraboon' => 'อาณาจักรโคตรบูร',
    'lanchang' => 'อาณาจักรล้านช้าง',
    'kamenravak' => 'สมัยละแวก',
    'ratanakosin' => 'กรุงรัตนโกสินทร์'
];

// Fetch timeline data for each kingdom from the database
$timeline_data = [];
$minYear = PHP_INT_MAX; // เก็บค่าปีที่น้อยที่สุดที่ไม่เป็น null
$maxYear = 0; // เก็บค่าปีที่มากที่สุด

foreach ($tables as $table) {
    $query = "
        SELECT id, name, reignstart, reignend, '$table' as kingdomname, monarch, latitude, longitude 
        FROM public.$table 
        WHERE reignstart IS NOT NULL AND latitude IS NOT NULL AND longitude IS NOT NULL
        ORDER BY reignstart ASC, reignend ASC;
    ";

    $result = pg_query($conn, $query);
    while ($row = pg_fetch_assoc($result)) {
        $timeline_data[$table][] = $row; // Group data by kingdom
        // หาปีที่น้อยที่สุดและมากที่สุด (เฉพาะ reignstart ที่ไม่เป็น null)
        if ($row['reignstart'] < $minYear) {
            $minYear = $row['reignstart'];
        }
        if ($row['reignend'] > $maxYear) {
            $maxYear = $row['reignend'];
        }
    }
}
// เพิ่ม array สำหรับเก็บสีของแต่ละอาณาจักร
$kingdomColors = [
    'funan' => '#FFA07A',
    'tampornling' => '#DDA0DD',
    'janela' => '#88B04B',
    'hripunchai' => '#F5DEB3',
    'srivichai' => '#92A8D1',
    'panakorn' => '#F6C3C1',
    'lavo' => '#FFCC00',
    'sukothai' => '#C39BD3',
    'lanna' => '#76D7C4',
    'ayuttaya' => '#F1948A',
    'cotraboon' => '#F7DC6F',
    'lanchang' => '#85C1E9',
    'kamenravak' => '#D5DBDB',
    'ratanakosin' => '#48C9B0'
];

// ปรับ minYear ให้ลงท้ายด้วย 0
$minYear = $minYear - ($minYear % 10);

// Close the database connection
pg_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timeline</title>
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

        .filter-container {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 20px;
            max-width: 1200px;
            margin: 20px auto;
        }

        .filter-container h3 {
            margin-bottom: 15px;
            font-size: 20px;
            text-align: center;
        }

        .filter-section {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
        }

        .filter-section label {
            font-size: 16px;
            cursor: pointer;
            display: flex;
            align-items: center;
            background-color: #e6eaf0;
            padding: 10px 20px;
            border-radius: 10px;
            transition: background-color 0.3s ease;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .filter-section label:hover {
            background-color: #d4dde6;
        }

        .filter-section input[type="checkbox"] {
            margin-right: 8px;
        }

        .timeline-container {
            max-width: 1200px;
            margin: 20px auto;
            position: relative;
            overflow-x: scroll;
            border: 3px solid #0288d1;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            height: 600px;
        }


        .timeline-item {
            position: absolute;
            top: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-left: 200px;
            /* Add margin to move the circle away from the edge */
        }

        .kingdom-section {
            margin-bottom: 50px;
            position: relative;
            padding-bottom: 20px;
            padding-left: 20px;
            /* Add padding to the left */
        }


        .kingdom-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
            text-transform: capitalize;
            color: #000;
        }

        .timeline-items {
            position: relative;
            height: 100px;
        }

        .timeline-item {
            position: absolute;
            top: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .circle {
            background-color: #444;
            color: black;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            line-height: 50px;
            cursor: pointer;
            margin-bottom: 10px;
            transition: all 0.3s ease;
        }

        .timeline-content {
            color: black;
            padding: 15px;
            border-radius: 10px;
            width: 300px;
            position: absolute;
            top: 60px;
            display: none;
            text-align: center;
            z-index: 1;
        }

        .close-btn {
            position: absolute;
            top: 5px;
            right: 10px;
            background-color: #000;
            color: white;
            border: none;
            cursor: pointer;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 14px;
        }

        .close-btn:hover {
            background-color: #555;
        }

        .year-labels {
            position: relative;
            height: 40px;
            margin-bottom: 10px;
        }

        .year-label {
            position: absolute;
            font-size: 14px;
            font-weight: bold;
            color: #000;
            margin-left: 200px;
        }

        .filter-container {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 20px;
            max-width: 1200px;
            margin: 20px auto;
        }

        .filter-section {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-start;
            gap: 10px;
            margin-bottom: 20px;
        }

        .kingdom-legend {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-start;
            margin-top: 10px;
        }

        .kingdom-item {
            display: flex;
            align-items: center;
            margin: 0 10px;
        }

        .color-circle {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            margin-right: 5px;
        }

        .kingdom-name {
            font-size: 16px;
            font-weight: bold;
        }

        select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-color: #007bff;
            color: #fff;
            padding: 10px 15px;
            font-size: 16px;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        select:hover {
            background-color: #0056b3;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }

        select:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.4);
        }

        select:disabled {
            background-color: #e9ecef;
            color: #888;
            cursor: not-allowed;
        }

        select option {
            background-color: #ffffff;
            color: #333;
        }
    </style>
</head>

<body>
    <header>
        <h1>Timeline</h1>
        <nav>
            <ul>
                <li><a href="index.php">Map</a></li>
                <li><a href="family_tree.php">Family Tree</a></li>
                <li><a href="time.php" class="active">Timeline</a></li>
            </ul>
        </nav>
    </header>

    <!-- Container for Filter Section (เลือกอาณาจักร) -->
    <div class="filter-container">
        <label>
            <input type="checkbox" id="select-all-checkbox" checked> เลือกทั้งหมด
        </label>
        <div class="filter-section">
            <?php foreach ($tables as $table): ?>
                <label>
                    <input type="checkbox" class="kingdom-checkbox" value="<?php echo $table; ?>" checked>
                    <?php echo $kingdomNamesThai[$table]; // ใช้ชื่อภาษาไทย ?>
                </label>
            <?php endforeach; ?>
        </div>

        <!-- Container for Kingdom Legend -->
        <div class="kingdom-legend">
            <?php foreach ($tables as $table): ?>
                <div class="kingdom-item">
                    <span class="color-circle" style="background-color: <?php echo $kingdomColors[$table]; ?>"></span>
                    <span class="kingdom-name"><?php echo $kingdomNamesThai[$table]; ?></span>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="year-format">
            <label for="year-format">เปลี่ยนปีศักราช :</label>
            <select id="year-format">
                <option value="BE" selected>พ.ศ.</option>
                <option value="AD">ค.ศ.</option>
                <option value="RS">รศ.</option>
            </select>
        </div>

        <!-- Container for Timeline Section (แสดงโหนด) -->
        <div class="timeline-container">

            <!-- Section to show years at the top -->
            <div class="year-labels">
                <?php
                $yearInterval = 100; // แสดงปีทุก ๆ 100 ปี
                for ($year = $minYear; $year <= $maxYear; $year += $yearInterval) {
                    $position = ($year - $minYear) * 30; // ปรับค่า 30 เป็นระยะห่างของปี
                    echo '<div class="year-label" style="left: ' . $position . 'px;">' . $year . '</div>';
                }
                ?>
            </div>

            <div id="timeline-sections">
                <?php foreach ($timeline_data as $kingdom => $items): ?>
                    <div class="kingdom-section" data-kingdom="<?php echo $kingdom; ?>">
                        <div class="kingdom-title">
                            <?php echo $kingdomNamesThai[$kingdom]; // ใช้ชื่อภาษาไทย ?>
                        </div>
                        <div class="timeline-items">
                            <div class="timeline-line"></div>
                            <?php
                            $previousEndPosition = -100; // ตำแหน่งเริ่มต้นสำหรับการตรวจสอบการทับซ้อน
                            $currentTopPosition = 0; // เริ่มต้นที่ตำแหน่งบนสุด
                        
                            foreach ($items as $item):
                                // คำนวณตำแหน่งตามปีที่เริ่มครองราชย์ (reignstart)
                                $startYear = $item['reignstart'];
                                $endYear = $item['reignend'];
                                $position = ($startYear - $minYear) * 30; // ตำแหน่งที่ต้องการให้ตรงกับ year-label
                                // ตรวจสอบการทับซ้อน
                                if ($position < $previousEndPosition + 60) {
                                    $currentTopPosition += 60;
                                } else {
                                    $currentTopPosition = 0;
                                }
                                $previousEndPosition = $position;
                                ?>
                                <div class="timeline-item"
                                    style="left: <?php echo $position; ?>px; top: <?php echo $currentTopPosition; ?>px;">
                                    <div class="circle" data-id="<?php echo $item['id']; ?>"
                                        data-kingdom="<?php echo $kingdom; ?>"
                                        style="background-color: <?php echo $kingdomColors[$kingdom]; ?>;"
                                        onclick="toggleContent('<?php echo $item['id']; ?>', '<?php echo $kingdom; ?>')"
                                        data-reignstart="<?php echo $startYear; ?>" data-reignend="<?php echo $endYear; ?>">
                                        <?php echo $startYear; ?>
                                    </div>
                                    <div class="timeline-content" id="content-<?php echo $kingdom . '-' . $item['id']; ?>">
                                        <button class="close-btn"
                                            onclick="closeContent('<?php echo $kingdom . '-' . $item['id']; ?>')">ปิด</button>
                                        <h3><?php echo $item['name']; ?></h3>
                                        <p>ครองราชย์:
                                            <?php
                                            echo ($item['reignstart'] !== null ? 'ค.ศ. ' . $item['reignstart'] : 'ไม่ปรากฏ');
                                            echo ' - ';
                                            echo ($item['reignend'] !== null ? 'ค.ศ. ' . $item['reignend'] : 'ไม่ปรากฏ');
                                            ?>
                                        </p>

                                        <!-- ปุ่มสำหรับการนำทางไปที่ family_tree.php -->
                                        <button class="search-btn"
                                            onclick="searchFamilyTree('<?php echo $item['name']; ?>', '<?php echo $item['id']; ?>', '<?php echo $kingdom; ?>')">แสดงหน้า
                                            Family Tree</button>
                                    </div>


                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div id="display-id"></div>

        <script>
            const buddhistEraSuffix = 'พ.ศ.';
            const christianEraSuffix = 'ค.ศ.';
            const rattanakosinEraSuffix = 'รศ.';
            const beforeRattanakosinEraSuffix = 'ก่อนหน้า รศ.';

            function searchFamilyTree(name, id, kingdom) {
                const searchName = encodeURIComponent(name); // เข้ารหัสชื่อสำหรับการใช้งานใน URL
                window.location.href = `family_tree.php?id=${id}&table=${kingdom}&search=${searchName}`;
            }

            function toggleContent(id, kingdom) {
                const content = document.getElementById('content-' + kingdom + '-' + id);
                const circle = event.currentTarget; // ได้รับการอ้างอิงโหนดที่ถูกคลิก
                const color = circle.style.backgroundColor; // ดึงสีจากโหนด

                if (content.style.display === 'block') {
                    content.style.display = 'none';
                } else {
                    document.querySelectorAll('.timeline-content').forEach(content => {
                        content.style.display = 'none';
                    });
                    content.style.display = 'block';
                }

                // เปลี่ยนสีพื้นหลังของ timeline content ตามสีของโหนด
                content.style.backgroundColor = color;
            }


            function closeContent(contentId) {
                const content = document.getElementById('content-' + contentId);
                if (content) {
                    content.style.display = 'none';
                }
            }

            // ฟังก์ชันในการแสดงหรือซ่อนอาณาจักรตามการเลือก checkbox
            document.querySelectorAll('.kingdom-checkbox').forEach(checkbox => {
                checkbox.addEventListener('change', function () {
                    const kingdom = this.value;
                    const sections = document.querySelectorAll(`[data-kingdom="${kingdom}"]`);
                    sections.forEach(section => {
                        section.style.display = this.checked ? 'block' : 'none';
                    });

                    // ตรวจสอบว่าทุก checkbox ถูกเลือกหรือไม่
                    const allChecked = document.querySelectorAll('.kingdom-checkbox:checked').length === document.querySelectorAll('.kingdom-checkbox').length;
                    document.getElementById('select-all-checkbox').checked = allChecked;

                    const format = document.getElementById('year-format').value; // รับค่าจาก select box
                    updateYearLabels(format);
                    updateNodeYears(format); // อัปเดตปีในโหนด
                });
            });

            // การเลือกหรือยกเลิกเลือกทั้งหมด
            document.getElementById('select-all-checkbox').addEventListener('change', function () {
                const isChecked = this.checked;
                document.querySelectorAll('.kingdom-checkbox').forEach(checkbox => {
                    checkbox.checked = isChecked;
                    const kingdom = checkbox.value;
                    document.querySelectorAll(`[data-kingdom="${kingdom}"]`).forEach(section => {
                        section.style.display = isChecked ? 'block' : 'none';
                    });
                });
                const format = document.getElementById('year-format').value; // รับค่าจาก select box
                updateYearLabels(format);
                updateNodeYears(format); // อัปเดตปีในโหนด
            });

            document.getElementById('year-format').addEventListener('change', function () {
                const format = this.value; // รับค่าจาก select box
                updateYearLabels(format);
                updateNodeYears(format); // อัปเดตปีในโหนด
            });

            function updateYearLabels(format) {
                let minYear = Infinity;
                let maxYear = 0;
                document.querySelectorAll('.kingdom-checkbox:checked').forEach(checkbox => {
                    const kingdom = checkbox.value;
                    const sections = document.querySelectorAll(`[data-kingdom="${kingdom}"] .timeline-item`);
                    sections.forEach(section => {
                        const reignstart = parseInt(section.querySelector('.circle').dataset.reignstart);
                        let reignstartAdjusted = reignstart;

                        // ปรับปีตามรูปแบบที่เลือก
                        if (format === 'AD') {
                            reignstartAdjusted = reignstart - 543;
                        } else if (format === 'RS') {
                            reignstartAdjusted = reignstart - 2324;
                        }

                        if (reignstartAdjusted < minYear) minYear = reignstartAdjusted;
                        if (reignstartAdjusted > maxYear) maxYear = reignstartAdjusted;
                    });
                });

                minYear = minYear - (minYear % 10);
                document.querySelector('.year-labels').innerHTML = '';
                const yearInterval = 100;
                for (let year = minYear; year <= maxYear; year += yearInterval) {
                    let displayedYear = year;
                    let suffix = '';

                    // แสดง suffix ตามรูปแบบปีที่เลือก
                    if (format === 'AD') {
                        suffix = christianEraSuffix; // "ค.ศ."
                    } else if (format === 'BE') {
                        suffix = buddhistEraSuffix; // "พ.ศ."
                        displayedYear; // แปลงเป็น พ.ศ.
                    } else if (format === 'RS') {
                        displayedYear = year < 0 ? `${beforeRattanakosinEraSuffix} ${Math.abs(year)}` : `${rattanakosinEraSuffix} ${year}`;
                    }

                    const position = (year - minYear) * 30;
                    document.querySelector('.year-labels').innerHTML += `<div class="year-label" style="left: ${position}px;">${suffix} ${displayedYear}</div>`;
                }

                updateNodePositions(minYear, format);
            }


            document.addEventListener('DOMContentLoaded', function () {
                const format = document.getElementById('year-format').value; // รับค่าจาก select box
                updateYearLabels(format); // เรียกใช้ฟังก์ชันเพื่อแสดงปีเริ่มต้น
                updateNodeYears(format); // อัปเดตปีในโหนดเมื่อโหลดหน้า
            });

            function updateNodeYears(format) {
                document.querySelectorAll('.timeline-item').forEach(item => {
                    const circle = item.querySelector('.circle');
                    const reignstart = parseInt(circle.dataset.reignstart);
                    const reignend = circle.dataset.reignend ? parseInt(circle.dataset.reignend) : null;

                    // คำนวณปีใหม่
                    let newStartYear = reignstart;
                    let newEndYear = reignend;

                    if (format === 'AD') {
                        newStartYear = reignstart - 543;
                        newEndYear = reignend !== null ? reignend - 543 : null;
                    } else if (format === 'RS') {
                        newStartYear = reignstart - 2324;
                        newEndYear = reignend !== null ? reignend - 2324 : null;
                    }

                    // แสดงเฉพาะตัวเลขในโหนด
                    circle.textContent = Math.abs(newStartYear);

                    const reignEndText = item.querySelector('.timeline-content p');

                    const suffixStart = format === 'AD' ? christianEraSuffix : (format === 'RS' ? (newStartYear < 0 ? beforeRattanakosinEraSuffix : rattanakosinEraSuffix) : buddhistEraSuffix);
                    const suffixEnd = format === 'AD' ? christianEraSuffix : (format === 'RS' ? (newEndYear < 0 ? beforeRattanakosinEraSuffix : rattanakosinEraSuffix) : buddhistEraSuffix);

                    // แสดงข้อความในรูปแบบที่เหมาะสมในส่วน content
                    reignEndText.textContent = `ครองราชย์: ${suffixStart} ${Math.abs(newStartYear)} - ${newEndYear !== null ? `${suffixEnd} ${Math.abs(newEndYear)}` : 'ไม่ปรากฏ'}`;
                });
            }


            function updateNodePositions(minYear, format) {
                document.querySelectorAll('.timeline-item').forEach(item => {
                    const circle = item.querySelector('.circle');
                    const reignstart = parseInt(circle.dataset.reignstart); // ดึงข้อมูล reignstart จาก dataset

                    // ปรับตำแหน่งตามรูปแบบปีที่เลือก
                    let reignstartAdjusted = reignstart;
                    if (format === 'AD') {
                        reignstartAdjusted = reignstart - 543; // ปรับปีสำหรับ ค.ศ.
                    } else if (format === 'RS') {
                        reignstartAdjusted = reignstart - 2324; // ปรับปีสำหรับ รศ.
                    }

                    // คำนวณตำแหน่งที่ถูกต้องสำหรับโหนด
                    const position = (reignstartAdjusted - minYear) * 30;

                    // อัปเดตตำแหน่งของโหนด
                    item.style.left = position + 'px';
                });
            }

        </script>

</body>

</html>