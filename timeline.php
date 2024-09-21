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
    <title>Timeline with Timestamps</title>
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
        }

        .timeline-item {
            border: 1px solid #ced4da;
            border-radius: 8px;
            background-color: #ffffff;
            text-align: center;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease-in-out, z-index 0.2s ease;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            padding: 10px;
            font-size: 12px;
            min-width: 80px;
            position: absolute;
            z-index: 1;
        }

        .timeline-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            z-index: 10;
        }

        .timeline-item h3 {
            margin: 0;
            font-size: 14px;
            color: #333;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .timeline-item p {
            margin: 2px 0;
            font-size: 12px;
            color: #333;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .timeline-item p:last-child {
            font-weight: bold;
            color: #333;
        }

        .timeline-item .timestamp {
            font-size: 12px;
            color: #888;
            margin-top: 5px;
        }

        #toggle-zoom {
            position: fixed;
            bottom: 20px;
            left: 20px;
            z-index: 1000;
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 12px 24px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        #toggle-zoom:hover {
            background-color: #0056b3;
            transform: translateY(-3px);
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.2);
        }

        #toggle-zoom:active {
            transform: translateY(0);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .button-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
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
                <li><a href="index.php">Home</a></li>
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
            </select>
        </div>
        <div class="button-container">
            <button id="toggle-zoom">ดูภาพรวม</button>
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

            let zoomLevel = 1;
            const zoomFactor = 2;
            let isZoomedOut = false;
            const toggleZoomButton = document.getElementById('toggle-zoom');
            let minYearSelected, maxYear;

            toggleZoomButton.addEventListener('click', () => {
                if (isZoomedOut) {
                    zoomLevel = 1;
                    toggleZoomButton.textContent = 'ดูภาพรวม';
                } else {
                    zoomLevel = 1 / 60;
                    toggleZoomButton.textContent = 'ดูแบบปกติ';
                }
                isZoomedOut = !isZoomedOut;
                renderTimeline();
                renderYearLabels(minYearSelected, maxYear);
            });

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
                    label.appendChild(document.createTextNode(kingdom));
                    filterContainer.appendChild(label);

                    const legendItem = document.createElement('div');
                    legendItem.style.display = 'flex';
                    legendItem.style.alignItems = 'center';
                    legendItem.style.marginRight = '20px';
                    legendItem.style.fontSize = '16px';
                    legendItem.style.fontWeight = 'bold';
                    legendItem.style.textAlign = 'center';
                    legendItem.innerHTML = `
                        <div style="background-color: ${getColorForKingdom(kingdom)}; width: 20px; height: 20px; border-radius: 50%;"></div>
                        <span style="margin-left: 10px;">${kingdom}</span>
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

                const filteredData = timelineData.filter(item =>
                    item.reignstart !== null && selectedKingdoms.includes(item.kingdomname)
                );

                if (filteredData.length === 0) {
                    return;
                }

                const allYears = filteredData.flatMap(item => [item.reignstart, item.reignend]);
                minYearSelected = Math.min(...filteredData.map(item => item.reignstart));
                maxYear = Math.max(...allYears);

                filteredData.sort((a, b) => a.reignstart - b.reignstart);

                renderYearLabels(minYearSelected, maxYear);

                const timelineItems = document.createElement('div');
                timelineItems.classList.add('timeline-items');

                const kingdoms = [...new Set(filteredData.map(item => item.kingdomname))];
                kingdoms.forEach((kingdom, index) => {
                    const rowDiv = document.createElement('div');
                    rowDiv.classList.add('timeline-items');
                    rowDiv.style.marginBottom = '80px';
                    rowDiv.style.paddingTop = '30px';
                    rowDiv.style.position = 'relative';

                    const kingdomLabel = document.createElement('div');
                    kingdomLabel.classList.add('kingdom-label');
                    kingdomLabel.textContent = kingdom;
                    kingdomLabel.style.position = 'absolute';
                    kingdomLabel.style.left = '0px';
                    kingdomLabel.style.top = '50%';
                    kingdomLabel.style.transform = 'translateY(-50%)';
                    kingdomLabel.style.fontWeight = 'bold';
                    kingdomLabel.style.fontSize = '18px';
                    kingdomLabel.style.color = '#333';

                    rowDiv.appendChild(kingdomLabel);

                    const items = filteredData.filter(item => item.kingdomname === kingdom);
                    items.forEach(item => {
                        const itemDiv = document.createElement('div');
                        itemDiv.classList.add('timeline-item');
                        itemDiv.style.left = `${getPositionLeft(item.reignstart, minYearSelected)}px`;
                        itemDiv.style.width = `${getWidth(item.reignstart, item.reignend)}px`;
                        itemDiv.style.backgroundColor = getColorForKingdom(item.kingdomname);

                        itemDiv.innerHTML = `
        <h3>${item.name}</h3>
        <p>${formatYear(item.reignstart)} - ${formatYear(item.reignend)}</p>
    `;

                        // Add click event to redirect to family_tree.php with search parameter
                        itemDiv.addEventListener('click', () => {
                            const searchName = encodeURIComponent(item.name);
                            window.location.href = `family_tree.php?id=${item.id}&table=${item.kingdomname}&search=${searchName}`;
                        });

                        itemDiv.addEventListener('mouseenter', () => {
                            itemDiv.style.zIndex = '999';
                        });

                        itemDiv.addEventListener('mouseleave', () => {
                            itemDiv.style.zIndex = '1';
                        });

                        rowDiv.appendChild(itemDiv);
                    });


                    timelineItems.appendChild(rowDiv);
                });

                timelineWrapper.appendChild(timelineItems);
            }


            function renderYearLabels(minYear, maxYear) {
                const existingYearContainer = document.querySelector('.year-labels');
                if (existingYearContainer) {
                    existingYearContainer.remove();
                }

                const yearContainer = document.createElement('div');
                yearContainer.classList.add('year-labels');
                yearContainer.style.position = 'relative';
                yearContainer.style.height = '40px';
                yearContainer.style.marginBottom = '20px';
                yearContainer.style.whiteSpace = 'nowrap';

                const yearInterval = isZoomedOut ? 100 : 10;

                for (let year = minYear; year <= maxYear; year += yearInterval) {
                    const yearDiv = document.createElement('div');
                    yearDiv.textContent = formatYear(year);
                    yearDiv.style.position = 'absolute';
                    yearDiv.style.left = `${getPositionLeft(year, minYear)}px`;
                    yearDiv.style.transform = 'translateX(20%)';
                    yearDiv.style.fontWeight = 'bold';
                    yearDiv.style.fontSize = isZoomedOut ? '12px' : '14px';
                    yearContainer.appendChild(yearDiv);
                }

                timelineWrapper.insertBefore(yearContainer, timelineWrapper.firstChild);
            }

            function formatYear(year) {
                if (year === null) {
                    return 'ไม่ปรากฎ'; // ถ้าปีเป็น null ให้แสดง null
                }

                const format = yearFormatSelect.value;
                if (format === 'buddhist') {
                    return `พ.ศ. ${year}`;
                } else {
                    return `ค.ศ. ${year - 543}`; // แปลง พ.ศ. เป็น ค.ศ.
                }
            }

            yearFormatSelect.addEventListener('change', () => {
                renderTimeline();
                renderYearLabels(minYearSelected, maxYear);
            });

            function getPositionLeft(year, minYear) {
                const yearWidth = 150 * zoomLevel;
                return (year - minYear) * yearWidth;
            }

            function getWidth(startYear, endYear) {
                const yearWidth = 150 * zoomLevel;
                return (endYear - startYear + 1) * yearWidth;
            }

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