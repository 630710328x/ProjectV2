<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Family Tree</title>
    <script src="https://balkan.app/js/OrgChart.js"></script>
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

        #tree {
            width: 100%;
            height: 85.5vh;
            border: 0px solid #ccc;
        }

        .orgchart .node img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .node.female rect {
            fill: #fdb0c0;
        }

        .node.male rect {
            fill: #ADD8E6;
        }

        #searchInput {
            margin: 10px;
            padding: 8px;
            width: 200px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        #resetSearch {
            margin-left: 10px;
            padding: 8px 12px;
            background-color: #007bff;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        #resetSearch:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <header>
        <h1>Family Tree</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="family_tree.php" class="active">Family Tree</a></li>
                <li><a href="timeline.php">Timeline</a></li>
            </ul>
        </nav>
    </header>
    <div id="controls">
        <label for="tableSelect">เลือกอาณาจักร : </label>
        <select id="tableSelect" name="tableSelect" aria-label="Select Family Table">
            <option value="funan">ฟูนาน</option>
            <option value="tampornling">อาณาจักรตามพรลิงค์</option>
            <option value="janela">เจนละ</option>
            <option value="hripunchai">หริภุญชัย</option>
            <option value="srivichai">อาณาจักรศรีวิชัย</option>
            <option value="panakorn">อาณาจักรพระนคร</option>
            <option value="lavo">อาณาจักรละโว้</option>
            <option value="sukothai">อาณาจักรสุโขทัย</option>
            <option value="lanna">อาณาจักรล้านนา</option>
            <option value="ayuttaya">อาณาจักรอยุธยา</option>
            <option value="lanchang">อาณาจักรล้านช้าง</option>
            <option value="kamenravak">สมัยละแวก</option>
            <option value="ratanakosin">กรุงรัตนโกสินทร์</option>
        </select>
        <input type="text" id="searchInput" placeholder="ค้นหาชื่อ..." />
        <button id="resetSearch">รีเซ็ต</button>
    </div>
    <div id="loading" style="display:none;">Loading...</div>
    <div id="tree" aria-live="polite"></div>
    <div id="error" role="alert" style="display:none; color:red;"></div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const tableSelect = document.getElementById('tableSelect');
            const searchInput = document.getElementById('searchInput');
            const resetButton = document.getElementById('resetSearch');
            const treeContainer = document.getElementById('tree');
            const errorContainer = document.getElementById('error');
            const loadingIndicator = document.getElementById('loading');
            let allNodes = [];
            let chart;

            OrgChart.templates.ana.defs =
                `<g transform="matrix(0.05,0,0,0.05,-12,-9)" id="heart">
        <path fill="#F57C00" d="M438.482,58.61c-24.7-26.549-59.311-41.655-95.573-41.711c-36.291,0.042-70.938,15.14-95.676,41.694l-8.431,8.909  
        l-8.431-8.909C181.284,5.762,98.663,2.728,45.832,51.815c-2.341,2.176-4.602,4.436-6.778,6.778 
        c-52.072,56.166-52.072,142.968,0,199.134l187.358,197.581c6.482,6.843,17.284,7.136,24.127,0.654 
        c0.224-0.212,0.442-0.43,0.654-0.654l187.29-197.581C490.551,201.567,490.551,114.77,438.482,58.61z"/>
    <g>`;

            OrgChart.templates.ana.field_0 =
                '<text data-width="230" data-text-overflow="ellipsis" style="font-size: 20px;" fill="#000000" x="125" y="100" text-anchor="middle">{val}</text>';
            OrgChart.templates.ana.field_1 =
                '<text data-width="130" data-text-overflow="ellipsis" style="font-size: 16px;" fill="#000000" x="230" y="30" text-anchor="end">{val}</text>';

            const fetchFamilyData = (table) => {
                return fetch(`fetch_family_data.php?table=${table}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`Network response was not ok: ${response.statusText}`);
                        }
                        return response.json();
                    })
                    .catch(error => {
                        console.error('Fetch error:', error);
                        throw error;
                    });
            };

            const loadFamilyData = (table) => {
                loadingIndicator.style.display = 'block';
                return fetchFamilyData(table)
                    .then(familyData => {
                        if (!Array.isArray(familyData)) {
                            throw new Error('Invalid data format');
                        }

                        allNodes = familyData.map(member => ({
                            id: member.id,
                            pid: member.parent_id,
                            ชื่อ: member.name,
                            ตำแหน่ง: member.relationship,
                            ครองราชย์: (member.reignstart !== null ? "พ.ศ. " + member.reignstart + " - " + (member.reignend !== null ? "พ.ศ. " + member.reignend : "ไม่ปรากฎ") : "ไม่ปรากฎ"),
                            ประสูติ: member.birth !== null ? "พ.ศ. " + member.birth : "ไม่ปรากฏ",
                            สวรรคต: member.death !== null ? "พ.ศ. " + member.death : "ไม่ปรากฏ",
                            img: member.img,
                            tags: member.tags,
                        }));

                        if (chart) {
                            chart.load(allNodes);
                        } else {
                            chart = new OrgChart(treeContainer, {
                                nodes: allNodes,
                                layout: OrgChart.tree,
                                mouseScrool: OrgChart.none,
                                align: OrgChart.ORIENTATION,
                                keyNavigation: false,
                                filterBy: ['เพศ', 'ราชวงศ์'],
                                editForm: {
                                    buttons: {
                                        edit: null,
                                        share: null,
                                        pdf: null,
                                        remove: null
                                    }
                                },
                                toolbar: {
                                    layout: true,
                                    zoom: true,
                                    fit: true,
                                    expandAll: true
                                },
                                nodeBinding: {
                                    field_0: "ชื่อ",
                                    field_1: "ตำแหน่ง",
                                    img_0: "img",
                                },
                                tags: {
                                    filter: {
                                        template: 'filtered'
                                    }
                                },
                                template: "ana",
                                enableSearch: true,
                                searchFields: ["ชื่อ"],
                            });
                        }

                        errorContainer.style.display = 'none';
                    })
                    .catch(error => {
                        console.error('Error fetching data:', error);
                        errorContainer.textContent = `An error occurred: ${error.message}`;
                        errorContainer.style.display = 'block';
                    })
                    .finally(() => {
                        loadingIndicator.style.display = 'none';
                    });
            };

            // Debounce function to limit how often the search function runs
            const debounce = (func, wait) => {
                let timeout;
                return function (...args) {
                    const later = () => {
                        clearTimeout(timeout);
                        func(...args);
                    };
                    clearTimeout(timeout);
                    timeout = setTimeout(later, wait);
                };
            };

            // Recursively find and include all descendants of a node
            const findDescendants = (nodeId, nodes) => {
                let descendants = [];
                nodes.forEach(node => {
                    if (node.pid === nodeId) {
                        descendants.push(node);
                        descendants = descendants.concat(findDescendants(node.id, nodes));
                    }
                });
                return descendants;
            };

            // Handle search input
            const handleSearch = debounce(function () {
                const searchTerm = searchInput.value.toLowerCase();
                if (chart) {
                    let filteredNodes = allNodes.filter(node => {
                        return node.ชื่อ.toLowerCase().includes(searchTerm);
                    });

                    let finalNodes = new Set(filteredNodes);

                    filteredNodes.forEach(node => {
                        const descendants = findDescendants(node.id, allNodes);
                        descendants.forEach(descendant => finalNodes.add(descendant));
                    });

                    chart.load([...finalNodes]);
                }
            }, 300);

            searchInput.addEventListener('input', handleSearch);

            // Handle reset search input
            resetButton.addEventListener('click', function () {
                searchInput.value = '';
                handleSearch();  // Refresh the chart with all nodes
                alert('ค้นหาได้ถูกรีเซ็ตแล้ว');
            });

            // Load family data and highlight the node
            loadFamilyData(tableSelect.value).then(highlightNode);

            // Highlight the node based on URL parameters
            function highlightNode() {
                const urlParams = new URLSearchParams(window.location.search);
                const selectedId = urlParams.get('id');
                const searchName = urlParams.get('search');

                if (searchName) {
                    searchInput.value = decodeURIComponent(searchName);
                    handleSearch();  // Perform search automatically
                }

                if (selectedId && chart) {
                    const nodeElement = chart.getNodeElement(selectedId);
                    if (nodeElement) {
                        nodeElement.style.border = "3px solid red";
                        nodeElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                }
            }

            // Handle URL parameters for table selection and highlighting nodes
            const urlParams = new URLSearchParams(window.location.search);
            const selectedTable = urlParams.get('table');

            // If table is specified in the URL, load that table's data
            if (selectedTable) {
                tableSelect.value = selectedTable;
                loadFamilyData(selectedTable).then(highlightNode);
            }

            tableSelect.addEventListener('change', function () {
                loadFamilyData(this.value).then(highlightNode);
            });
        });
    </script>

</body>

</html>