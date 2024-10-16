<?php
// Database connection and data retrieval
$host = "localhost";
$port = "5432";
$dbname = "postgres";
$user = "postgres";
$password = "root";

$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

if (!$conn) {
    die("Connection failed: " . pg_last_error());
}

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

$timeline_data = [];
foreach ($tables as $table) {
    $query = "
        SELECT id, name, reignstart, reignend, '$table' as kingdomname, monarch 
        FROM public.$table 
        WHERE kingdomname IS NOT NULL
        ORDER BY reignstart ASC, reignend ASC;
    ";

    $result = pg_query($conn, $query);
    while ($row = pg_fetch_assoc($result)) {
        $timeline_data[] = $row;
    }
}

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


        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow-x: auto;
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

        .color-legend {
            margin-bottom: 20px;
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }

        .color-legend div {
            display: flex;
            align-items: center;
        }

        .color-legend div div {
            width: 20px;
            height: 20px;
            margin-right: 10px;
        }

        .timeline-wrapper {
            display: flex;
            flex-direction: column;
            position: relative;
            padding: 20px;
            background-color: #e9ecef;
            border-radius: 10px;
            box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.1);
            overflow-x: auto;
            margin-top: 30px;
        }

        .timeline-item {
            border: 1px solid #ced4da;
            border-radius: 5px;
            background-color: #f8f9fa;
            text-align: center;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease-in-out, z-index 0.2s ease;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            padding: 8px;
            font-size: 12px;
            position: absolute;
            z-index: 1;
            margin-bottom: 15px;
            cursor: pointer;
        }

        .timeline-item:hover {
            transform: translateY(-3px);
            background-color: #e2e6ea;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            z-index: 10;
            max-width: none;
            /* ยกเลิกข้อจำกัดของขนาด */
            white-space: normal;
            /* ทำให้บรรทัดใหม่เกิดขึ้นถ้ามีข้อมูลยาว */
            padding: 12px;
            width: auto;
            /* ทำให้ขนาดของ item ขยายตามเนื้อหาข้างใน */
        }

        .timeline-item h3 {
            margin: 0;
            font-size: 12px;
            line-height: 1.5;
            color: #333;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .timeline-item p {
            margin: 2px 0;
            font-size: 11px;
            color: #555;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .timeline-item p:last-child {
            font-weight: bold;
            color: #333;
        }

        .timeline-row {
            position: relative;
            margin-bottom: 50px;
            padding-top: 40px;
            padding-left: 150px;
            border-bottom: 1px solid #ddd;
        }

        .kingdom-label {
            position: absolute;
            left: 0;
            top: 0;
            font-weight: bold;
            font-size: 18px;
            color: #333;
        }

        .year-labels {
            position: relative;
            height: 40px;
            margin-bottom: 10px;
            white-space: nowrap;
            left: 150px;
        }

        .vertical-line {
            position: absolute;
            width: 1px;
            height: 100%;
            background-color: #ccc;
        }

        .year-label {
            display: inline-block;
            position: absolute;
            font-weight: bold;
            font-size: 12px;
            color: #333;
            transform: translateX(-50%);
            text-align: center;
            white-space: nowrap;
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
                <li><a href="timeline.php" class="active">Timeline</a></li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <div class="select-all-container">
            <input type="checkbox" id="select-all" checked>
            <label for="select-all">เลือกทั้งหมด</label>
        </div>
        <div class="kingdom-filters">
            <!-- Checkboxes for kingdoms will be dynamically generated here -->
        </div>
        <div class="color-legend">
            <!-- Legend will be dynamically generated here -->
        </div>
        <div class="year-format-container">
            <label for="year-format">เลือกรูปแบบปี:</label>
            <select id="year-format">
                <option value="buddhist" selected>พ.ศ.</option>
                <option value="christian">ค.ศ.</option>
                <option value="rattanakosin">ร.ศ.</option>
            </select>
        </div>
        <div class="timeline-wrapper" id="timeline-wrapper">
            <!-- Timeline rows will be generated here by JavaScript -->
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const timelineData = <?php echo json_encode($timeline_data); ?>;
            const timelineWrapper = document.getElementById('timeline-wrapper');
            const filterContainer = document.querySelector('.kingdom-filters');
            const colorLegendContainer = document.querySelector('.color-legend');
            const selectAllCheckbox = document.getElementById('select-all');
            const yearFormatSelect = document.getElementById('year-format');

            const kingdomNames = {
                'funan': 'ฟูนาน',
                'tampornling': 'อาณาจักรตามพรลิงค์',
                'janela': 'เจนละ',
                'hripunchai': 'หริภุญชัย',
                'srivichai': 'อาณาจักรศรีวิชัย',
                'panakorn': 'อาณาจักรพระนคร',
                'lavo': 'อาณาจักรละโว้',
                'sukothai': 'อาณาจักรสุโขทัย',
                'lanna': 'อาณาจักรล้านนา',
                'ayuttaya': 'อาณาจักรอยุธยา',
                'cotraboon': 'อาณาจักรโคตรบูร',
                'lanchang': 'อาณาจักรล้านช้าง',
                'kamenravak': 'สมัยละแวก',
                'ratanakosin': 'กรุงรัตนโกสินทร์'
            };

            const zoomLevel = 1 / 20;
            let minYearSelected, maxYear;

            function renderCheckboxes() {
                const kingdoms = [...new Set(timelineData.map(item => item.kingdomname))];
                kingdoms.forEach((kingdom, index) => {
                    const label = document.createElement('label');
                    const checkbox = document.createElement('input');
                    checkbox.type = 'checkbox';
                    checkbox.value = kingdom;
                    checkbox.checked = true;
                    checkbox.id = `kingdom-${index}`;
                    checkbox.addEventListener('change', debounce(handleCheckboxChange, 300));

                    label.setAttribute('for', checkbox.id);
                    label.appendChild(checkbox);
                    label.appendChild(document.createTextNode(kingdomNames[kingdom] || kingdom));
                    filterContainer.appendChild(label);

                    const legendItem = document.createElement('div');
                    legendItem.innerHTML = `
                        <div style="background-color: ${getColorForKingdom(kingdom)}; width: 20px; height: 20px; border-radius: 50%;"></div>
                        <span style="margin-left: 10px;">${kingdomNames[kingdom] || kingdom}</span>
                    `;
                    colorLegendContainer.appendChild(legendItem);
                });

                selectAllCheckbox.checked = true;

                selectAllCheckbox.addEventListener('change', (e) => {
                    const isChecked = e.target.checked;
                    document.querySelectorAll('.kingdom-filters input[type=checkbox]').forEach(checkbox => {
                        checkbox.checked = isChecked;
                    });
                    renderTimeline();
                });
            }

            function handleCheckboxChange() {
                const allCheckboxes = document.querySelectorAll('.kingdom-filters input[type=checkbox]');
                const allChecked = Array.from(allCheckboxes).every(checkbox => checkbox.checked);
                selectAllCheckbox.checked = allChecked;

                renderTimeline();
            }

            function renderTimeline() {
                timelineWrapper.innerHTML = '';
                const selectedKingdoms = Array.from(document.querySelectorAll('.kingdom-filters input[type=checkbox]'))
                    .filter(checkbox => checkbox.checked)
                    .map(checkbox => checkbox.value);

                // แยกข้อมูลที่มีค่า null ออกมาจากข้อมูลปกติ
                const filteredData = timelineData.filter(item =>
                    item.reignstart !== null && selectedKingdoms.includes(item.kingdomname)
                );

                const nullData = timelineData.filter(item =>
                    item.reignstart === null && selectedKingdoms.includes(item.kingdomname)
                );

                if (filteredData.length === 0 && nullData.length === 0) {
                    return;
                }

                const allYears = filteredData.flatMap(item => [item.reignstart, item.reignend]);
                minYearSelected = Math.min(...filteredData.map(item => item.reignstart));
                maxYear = Math.max(...allYears);

                filteredData.sort((a, b) => a.reignstart - b.reignstart);

                renderYearLabels(minYearSelected, maxYear);

                const timelineItems = document.createElement('div');
                timelineItems.classList.add('timeline-items');

                // แสดงข้อมูลตามอาณาจักรก่อน
                const kingdoms = [...new Set(filteredData.map(item => item.kingdomname))];
                kingdoms.forEach((kingdom) => {
                    const rowDiv = document.createElement('div');
                    rowDiv.classList.add('timeline-row');

                    const kingdomLabel = document.createElement('div');
                    kingdomLabel.classList.add('kingdom-label');
                    kingdomLabel.textContent = kingdomNames[kingdom] || kingdom;
                    rowDiv.appendChild(kingdomLabel);

                    // จัดการข้อมูลปกติ (มี reignstart และ reignend)
                    const items = filteredData.filter(item => item.kingdomname === kingdom);
                    let stagger = 0;

                    items.forEach(item => {
                        const startLeft = getPositionLeft(item.reignstart, minYearSelected);
                        const endLeft = getPositionLeft(item.reignend, minYearSelected);
                        const itemDiv = document.createElement('div');
                        itemDiv.classList.add('timeline-item');
                        itemDiv.style.left = `${startLeft}px`;
                        itemDiv.style.width = `${Math.max(endLeft - startLeft, 80)}px`;
                        itemDiv.style.top = `${stagger * 25}px`;  // เพิ่มการปรับตำแหน่งแนวตั้ง
                        stagger = (stagger + 1) % 2;  // สลับบรรทัด

                        itemDiv.style.backgroundColor = getColorForKingdom(item.kingdomname);

                        itemDiv.innerHTML = `
                <h3>${item.name}</h3>
                <p>${formatYear(item.reignstart)} - ${formatYear(item.reignend)}</p>
            `;

                        itemDiv.addEventListener('mouseover', () => {
                            itemDiv.style.transform = 'scale(1.05)';
                            itemDiv.style.zIndex = '10';
                            itemDiv.style.backgroundColor = '#e2e6ea';
                            itemDiv.style.whiteSpace = 'normal'; // ขยายขนาดให้แสดงข้อมูลทั้งหมด
                            itemDiv.style.width = 'auto'; // ขยายขนาดตามเนื้อหาที่ต้องแสดง
                        });

                        itemDiv.addEventListener('mouseout', () => {
                            itemDiv.style.transform = 'scale(1)';
                            itemDiv.style.zIndex = '1';
                            itemDiv.style.backgroundColor = getColorForKingdom(item.kingdomname);
                            itemDiv.style.whiteSpace = 'nowrap'; // กลับมาเป็นแบบบรรทัดเดียว
                            itemDiv.style.width = `${Math.max(endLeft - startLeft, 80)}px`; // กลับไปที่ขนาดเดิม
                        });

                        itemDiv.addEventListener('click', () => {
                            const searchName = encodeURIComponent(item.name);
                            window.location.href = `family_tree.php?id=${item.id}&table=${item.kingdomname}&search=${searchName}`;
                        });

                        rowDiv.appendChild(itemDiv);
                    });

                    timelineItems.appendChild(rowDiv);
                });

                // เพิ่มแถวสำหรับข้อมูลที่มี null เรียงกันในแถวเดียว
                if (nullData.length > 0) {
                    const nullRowDiv = document.createElement('div');
                    nullRowDiv.classList.add('timeline-row');

                    const nullLabel = document.createElement('div');
                    nullLabel.classList.add('kingdom-label');
                    nullLabel.textContent = 'ไม่ทราบช่วงเวลา';
                    nullRowDiv.appendChild(nullLabel);

                    let leftPosition = maxYear + 20;  // เริ่มจากหลังปีที่มากที่สุด

                    nullData.forEach(item => {
                        const itemDiv = document.createElement('div');
                        itemDiv.classList.add('timeline-item');
                        itemDiv.style.left = `${leftPosition}px`;  // จัดเรียงข้อมูลต่อกัน
                        itemDiv.style.width = '80px';  // ตั้งค่าขนาดเริ่มต้น
                        itemDiv.style.top = '0px';  // แถวเดียวกันทั้งหมด

                        itemDiv.style.backgroundColor = getColorForKingdom(item.kingdomname);

                        itemDiv.innerHTML = `
                <h3>${item.name}</h3>
                <p>ช่วงเวลาที่ไม่ทราบ</p>
            `;

                        itemDiv.addEventListener('mouseover', () => {
                            itemDiv.style.transform = 'scale(1.05)';
                            itemDiv.style.zIndex = '10';
                            itemDiv.style.backgroundColor = '#e2e6ea';
                            itemDiv.style.whiteSpace = 'normal';
                            itemDiv.style.width = 'auto';
                        });

                        itemDiv.addEventListener('mouseout', () => {
                            itemDiv.style.transform = 'scale(1)';
                            itemDiv.style.zIndex = '1';
                            itemDiv.style.backgroundColor = getColorForKingdom(item.kingdomname);
                            itemDiv.style.whiteSpace = 'nowrap';
                            itemDiv.style.width = '80px';
                        });

                        itemDiv.addEventListener('click', () => {
                            const searchName = encodeURIComponent(item.name);
                            window.location.href = `family_tree.php?id=${item.id}&table=${item.kingdomname}&search=${searchName}`;
                        });

                        nullRowDiv.appendChild(itemDiv);

                        // ปรับตำแหน่งสำหรับ item ถัดไป
                        leftPosition += 100;  // เว้นระยะห่างระหว่าง item
                    });

                    timelineItems.appendChild(nullRowDiv);  // เพิ่มแถว null ไว้ท้ายสุด
                }

                timelineWrapper.appendChild(timelineItems);
                renderVerticalLines(minYearSelected, maxYear);
            }

            function renderVerticalLines(minYear, maxYear) {
                const existingLines = document.querySelectorAll('.vertical-line');
                existingLines.forEach(line => line.remove());

                const yearInterval = 100; // ระยะห่างระหว่างเส้นปี

                for (let year = minYear; year <= maxYear; year += yearInterval) {
                    const positionLeft = getPositionLeft(year, minYear);

                    const lineDiv = document.createElement('div');
                    lineDiv.classList.add('vertical-line');
                    lineDiv.style.left = `${positionLeft}px`;

                    const yearLabel = document.createElement('div');
                    yearLabel.classList.add('year-label');
                    yearLabel.textContent = formatYear(year);
                    yearLabel.style.left = `${positionLeft}px`;

                    timelineWrapper.appendChild(lineDiv);
                    timelineWrapper.appendChild(yearLabel);
                }
            }

            function renderYearLabels(minYear, maxYear) {
                const existingYearContainer = document.querySelector('.year-labels');
                if (existingYearContainer) {
                    existingYearContainer.remove();
                }

                const yearContainer = document.createElement('div');
                yearContainer.classList.add('year-labels');

                const yearInterval = 100; // ระยะห่างระหว่างปี

                for (let year = minYear; year <= maxYear; year += yearInterval) {
                    const positionLeft = getPositionLeft(year, minYear);

                    const yearDiv = document.createElement('div');
                    yearDiv.textContent = formatYear(year);
                    yearDiv.style.left = `${positionLeft}px`;
                    yearDiv.style.transform = 'translateX(-50%)';
                    yearDiv.style.fontWeight = 'bold';
                    yearDiv.style.fontSize = '14px';
                    yearDiv.style.borderLeft = '2px dashed #bbb';
                    yearDiv.style.paddingLeft = '5px';

                    yearContainer.appendChild(yearDiv);
                }

                timelineWrapper.insertBefore(yearContainer, timelineWrapper.firstChild);
            }

            function getPositionLeft(year, minYear) {
                const offsetFromKingdomLabel = 200; // ระยะห่างจากป้ายชื่ออาณาจักร
                const yearWidth = 180 * zoomLevel;  // ความกว้างต่อปี
                return (year - minYear) * yearWidth + offsetFromKingdomLabel;
            }

            function formatYear(year) {
                if (year === null) {
                    return 'ไม่ปรากฎ';
                }

                const format = yearFormatSelect.value;
                if (format === 'buddhist') {
                    return `พ.ศ. ${year}`;
                } else if (format === 'christian') {
                    return `ค.ศ. ${year - 543}`;
                } else if (format === 'rattanakosin') {
                    const rattanakosinYear = year - 2324;
                    if (rattanakosinYear < 0) {
                        return `ก่อน ร.ศ. ${Math.abs(rattanakosinYear)}`;
                    } else {
                        return `ร.ศ. ${rattanakosinYear}`;
                    }
                }
            }

            yearFormatSelect.addEventListener('change', () => {
                renderTimeline();
                renderYearLabels(minYearSelected, maxYear);
            });

            function getColorForKingdom(kingdom) {
                const colors = [
                    "#FFA07A", "#DDA0DD", "#88B04B", "#F5DEB3", "#92A8D1", "#F6C3C1", "#FFCC00",
                    "#C39BD3", "#76D7C4", "#F1948A", "#F7DC6F", "#85C1E9", "#D5DBDB", "#48C9B0",
                    "#AF7AC5", "#5499C7", "#F0B27A", "#1ABC9C", "#A569BD", "#DC7633"
                ];
                const kingdoms = [...new Set(timelineData.map(item => item.kingdomname))];
                const index = kingdoms.indexOf(kingdom);
                return colors[index % colors.length];
            }

            function debounce(func, wait) {
                let timeout;
                return function (...args) {
                    const later = () => {
                        clearTimeout(timeout);
                        func.apply(this, args);
                    };
                    clearTimeout(timeout);
                    timeout = setTimeout(later, wait);
                };
            }

            renderCheckboxes();
            renderTimeline();
        });
    </script>
</body>

</html>