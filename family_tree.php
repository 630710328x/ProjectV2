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

        #controls {
            margin: 10px;
            padding: 10px;
            border: 2px;
            /* เพิ่มเส้นขอบสีน้ำเงิน */
            border-radius: 8px;
            /* เพิ่มความโค้งมนให้กับขอบ */
            background-color: #ffffff;
            /* สีพื้นหลัง */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            /* เพิ่มเงาให้กับ container */
        }

        #tree {
            width: 100%;
            height: 80vh;
            border: 2px;
            /* เพิ่มเส้นขอบสีเทา */
            border-radius: 8px;
            /* เพิ่มความโค้งมนให้กับขอบ */
            background-color: #ffffff;
            /* สีพื้นหลัง */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            /* เพิ่มเงาให้กับ container */
        }


        .orgchart .node img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .filter rect,
        .filter image,
        .filter text,
        .filter use {
            filter: blur(10px);
        }

        .boc-edit-form.female .boc-edit-form-header,
        .boc-edit-form.female .boc-img-button {
            background-color: #FFB6C1 !important;
        }

        .boc-edit-form.male .boc-edit-form-header,
        .boc-edit-form.male .boc-img-button {
            background-color: #87CEFA !important;
        }

        .boc-edit-form.searched .boc-edit-form-header,
        .boc-edit-form.searched .boc-img-button {
            background-color: #FFD700 !important;
        }

        [data-l-id] path {
            stroke: #000000;
        }

        [data-n-id] rect:hover {
            filter: drop-shadow(4px 5px 5px #aeaeae);
        }

        #searchInput {
            margin: 10px;
            padding: 8px;
            width: 200px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease, border-color 0.3s ease;
            position: relative;
        }

        #searchInput:focus {
            border-color: #007bff;
            box-shadow: 0 4px 8px rgba(0, 123, 255, 0.2);
            outline: none;
        }

        #resetSearch {
            margin-left: 10px;
            padding: 8px 12px;
            background-color: #007bff;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        #resetSearch:hover {
            background-color: #0056b3;
            box-shadow: 0 4px 8px rgba(0, 123, 255, 0.2);
        }

        #autoCompleteContainer {
            border: 1px solid #ccc;
            max-height: 150px;
            overflow-y: auto;
            background-color: #ffffff;
            position: absolute;
            z-index: 1000;
            width: 200px;
            border-radius: 4px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 5px;
            transform: translateX(17px);
        }

        .suggestion-item {
            padding: 10px;
            cursor: pointer;
            border-bottom: 1px solid #eee;
            transition: background-color 0.2s ease;
        }

        .suggestion-item:last-child {
            border-bottom: none;
        }

        .suggestion-item:hover {
            background-color: #f8f9fa;
        }

        .autocomplete-wrapper {
            position: relative;
            display: inline-block;
        }

        #tableSelect {
            padding: 8px 12px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url('data:image/svg+xml;charset=US-ASCII,<svg%20xmlns="http://www.w3.org/2000/svg"%20viewBox="0%200%2024%2024"%20fill="none"%20stroke="%23007bff"%20stroke-width="2"%20stroke-linecap="round"%20stroke-linejoin="round"%20class="feather%20feather-chevron-down"><polyline%20points="6%209%2012%2015%2018%209"></polyline></svg>');
            background-repeat: no-repeat;
            background-position: right 10px center;
            background-size: 16px;
            width: 180px;
        }

        #tableSelect:focus {
            border-color: #007bff;
            box-shadow: 0 4px 8px rgba(0, 123, 255, 0.2);
            outline: none;
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
            <option value="cotraboon">อาณาจักรโคตรบูร</option>
            <option value="lanchang">อาณาจักรล้านช้าง</option>
            <option value="kamenravak">สมัยละแวก</option>
            <option value="ratanakosin">กรุงรัตนโกสินทร์</option>
        </select>

        <div class="autocomplete-wrapper">
            <input type="text" id="searchInput" placeholder="ค้นหาชื่อ..." autocomplete="off" />
            <div id="autoCompleteContainer" aria-live="polite" role="listbox"></div>
        </div>
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
            const autoCompleteContainer = document.getElementById('autoCompleteContainer');
            const treeContainer = document.getElementById('tree');
            const errorContainer = document.getElementById('error');
            const loadingIndicator = document.getElementById('loading');
            let allNodes = [];
            let chart;
            let isTableChanged = false;

            OrgChart.templates.ana.defs = '<g transform="matrix(0.05,0,0,0.05,-12,-9)" id="heart"><path fill="#F57C00" d="M438.482,58.61c-24.7-26.549-59.311-41.655-95.573-41.711c-36.291,0.042-70.938,15.14-95.676,41.694l-8.431,8.909  l-8.431-8.909C181.284,5.762,98.663,2.728,45.832,51.815c-2.341,2.176-4.602,4.436-6.778,6.778 c-52.072,56.166-52.072,142.968,0,199.134l187.358,197.581c6.482,6.843,17.284,7.136,24.127,0.654 c0.224-0.212,0.442-0.43,0.654-0.654l187.29-197.581C490.551,201.567,490.551,114.77,438.482,58.61z"/><g>';

            OrgChart.templates.ana.field_0 =
                '<text data-width="230" data-text-overflow="ellipsis" style="font-size: 20px;" fill="#000000" x="125" y="100" text-anchor="middle">{val}</text>';
            OrgChart.templates.ana.field_1 =
                '<text data-width="130" data-text-overflow="ellipsis" style="font-size: 16px;" fill="#000000" x="230" y="30" text-anchor="end">{val}</text>';
            // กำหนด template สำหรับโหนดเพศชาย
            OrgChart.templates.male = Object.assign({}, OrgChart.templates.ana);
            OrgChart.templates.male.node = '<rect x="0" y="0" height="110" width="250" fill="#87CEFA" stroke-width="2" stroke="#000000" rx="15" ry="15"></rect>';

            // กำหนด template สำหรับโหนดเพศหญิง
            OrgChart.templates.female = Object.assign({}, OrgChart.templates.ana);
            OrgChart.templates.female.node = '<rect x="0" y="0" height="110" width="250" fill="#FFB6C1" stroke-width="2" stroke="#000000" rx="15" ry="15"></rect>';

            // Define custom template for searched node
            OrgChart.templates.searched = Object.assign({}, OrgChart.templates.ana);
            OrgChart.templates.searched.node = '<rect x="0" y="0" height="110" width="250" fill="#FFD700" stroke-width="2" stroke="#000000" rx="15" ry="15"></rect>';

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
                searchInput.value = ''; // Explicitly clear the search input when loading new data
                document.title = `${tableSelect.options[tableSelect.selectedIndex].text} Family Tree`; // Update title

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
                            ราชวงศ์: member.monarch !== null ? member.monarch : "ไม่ปรากฏ",
                            คู่สมรส: member.wife !== null ? member.wife : "ไม่ปรากฏ",
                            พระราชบุตร: member.child !== null ? member.child : "ไม่ปรากฏ",
                            บิดา: member.father !== null ? member.father : "ไม่ปรากฏ",
                            มารดา: member.mother !== null ? member.mother : "ไม่ปรากฏ",
                            tags: member.tags,
                            latitude: member.latitude,
                            longitude: member.longitude,
                            เพศ: member.gender === 'Female' ? 'หญิง' : 'ชาย',
                            ppid: member.ppid,
                            img: member.img ? member.img : 'https://www.pinclipart.com/picdir/big/165-1655940_account-human-person-user-icon-username-png-icon.png',
                            วิกิพีเดีย: member.urlking !== null ? member.urlking : "ไม่ปรากฏ"
                        }));

                        if (chart) {
                            chart.load(allNodes);
                        } else {
                            chart = new OrgChart(treeContainer, {
                                nodes: allNodes,
                                layout: OrgChart.normal,
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
                                    layout: false,
                                    zoom: true,
                                    fit: true,
                                    expandAll: false
                                },
                                nodeBinding: {
                                    field_0: "ชื่อ",
                                    field_1: "ตำแหน่ง",
                                    img_0: "img",
                                },
                                tags: {
                                    male: {
                                        template: "male"
                                    },
                                    female: {
                                        template: "female"
                                    },
                                    searched: {
                                        template: "searched" // Custom template for searched nodes
                                    }
                                },
                                template: "ana",
                                enableSearch: false,
                            });


                            chart.filterUI.on('add-filter', function (sender, args) {
                                var names = Object.keys(sender.filterBy);
                                var index = names.indexOf(args.name);
                                if (index == names.length - 1) {
                                    args.html += `<div data-btn-reset style="color: #039BE5;">reset</div>`;
                                }
                            });
                        }
                        chart.on('render-link', function (sender, args) {
                            if (args.cnode.ppid != undefined) {
                                args.html += '<use xlink:href="#heart" x="' + args.p.xa + '" y="' + args.p.ya + '"/>';
                            }
                            // ตรวจสอบว่า cnode มีแท็ก partner
                            if (args.cnode.tags && args.cnode.tags.includes('partner')) {
                                var hasMatchingChild = false;

                                // วนลูปตรวจสอบว่า node ลูกๆ มีค่า ppid ตรงกับ id ของ cnode หรือไม่
                                chart.config.nodes.forEach(function (node) {
                                    if (node.ppid == args.cnode.id) {
                                        hasMatchingChild = true;  // ถ้ามี node ลูกที่มีค่า ppid ตรงกับ id ของ cnode
                                    }
                                });

                                // ถ้าไม่มี node ลูกที่มีค่า ppid ตรงกับ id ของ cnode จึงจะแสดงหัวใจ
                                if (!hasMatchingChild) {
                                    args.html += '<use xlink:href="#heart" x="' + args.p.xa + '" y="' + args.p.ya + '"/>';
                                }
                            }
                        });

                        chart.filterUI.on('add-item', function (sender, args) {
                            var count = 0;
                            var totalCount = 0;
                            for (var i = 0; i < sender.instance.config.nodes.length; i++) {
                                var data = sender.instance.config.nodes[i];
                                if (data[args.name] != undefined) {
                                    totalCount++;

                                    if (data[args.name] == args.value) {
                                        count++;
                                    }
                                }
                            }

                            var dataAllAttr = '';
                            if (args.text == '[All]') {
                                count = totalCount;
                                dataAllAttr = 'data-all';
                            }
                            args.html = `<div class="filter-item">
                    <input ${dataAllAttr} type="checkbox" id="${args.value}" name="${args.value}" ${args.checked ? 'checked' : ''}>
                    <label for="${args.value}">${args.text} (${count})</label>
                </div>`;
                        });
                        chart.filterUI.on('update', function (sender, args) {
                            var btnResetElement = sender.element.querySelector('[data-btn-reset]');
                            btnResetElement.addEventListener('click', function (e) {
                                sender.filterBy = null;
                                sender.update();
                                sender.instance.draw();
                            });
                        });

                        chart.filterUI.on('show-items', function (sender, args) {
                            var filterItemElements = sender.element.querySelectorAll('.filter-item');
                            for (var i = 0; i < filterItemElements.length; i++) {
                                filterItemElements[i].addEventListener('mouseenter', function (e) {
                                    var val = e.target.querySelector('input').id;
                                    if (val != args.name) {//[All]
                                        for (var j = 0; j < sender.instance.config.nodes.length; j++) {
                                            var data = sender.instance.config.nodes[j];
                                            if (data[args.name] == val) {
                                                var nodeElement = sender.instance.getNodeElement(data.id);
                                                nodeElement.classList.add('filter-item-hovered');
                                            }
                                        }
                                    }
                                });

                                filterItemElements[i].addEventListener('mouseleave', function (e) {
                                    var val = e.target.querySelector('input').id;
                                    if (val != args.name) {//[All]
                                        for (var j = 0; j < sender.instance.config.nodes.length; j++) {
                                            var data = sender.instance.config.nodes[j];
                                            if (data[args.name] == val) {
                                                var nodeElement = sender.instance.getNodeElement(data.id);
                                                nodeElement.classList.remove('filter-item-hovered');
                                            }
                                        }
                                    }
                                });
                            }
                        });


                        chart.onInit(function (args) {
                            this.filterUI.show('title');
                        });

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

            const handleSearch = debounce(function () {
                const searchTerm = searchInput.value.trim().toLowerCase(); // Trim whitespace

                autoCompleteContainer.innerHTML = ''; // Clear previous search results

                if (searchTerm) {
                    // Search for nodes that match the term and have non-null latitude and longitude
                    const suggestions = allNodes
                        .filter(node =>
                            node.latitude !== null &&
                            node.longitude !== null &&
                            node.ชื่อ.toLowerCase().includes(searchTerm)
                        )
                        .slice(0, 5); // Limit to 5 suggestions

                    // Display suggestions with images and names
                    if (suggestions.length > 0) {
                        suggestions.forEach(node => {
                            const suggestionItem = document.createElement('div');
                            suggestionItem.classList.add('suggestion-item');

                            // Create and style image
                            const img = document.createElement('img');
                            img.src = node.img ? node.img : 'default_image.jpg'; // Fallback image
                            img.alt = node.ชื่อ;
                            img.style.width = '30px';
                            img.style.height = '30px';
                            img.style.borderRadius = '50%'; // Circular image
                            img.style.marginRight = '10px';

                            // Fallback for broken images
                            img.onerror = () => {
                                img.src = 'default_image.jpg';
                            };

                            // Create span for displaying name
                            const nameSpan = document.createElement('span');
                            nameSpan.textContent = node.ชื่อ;

                            // Append image and name to suggestion item
                            suggestionItem.appendChild(img);
                            suggestionItem.appendChild(nameSpan);

                            // Click event to select name from suggestions
                            suggestionItem.addEventListener('click', function () {
                                searchInput.value = node.ชื่อ; // Set selected name in input
                                autoCompleteContainer.style.display = 'none'; // Hide suggestions

                                // Trigger the search on selection
                                handleSearch();
                            });

                            // Append suggestion item to container
                            autoCompleteContainer.appendChild(suggestionItem);
                        });
                    } else {
                        // No results found
                        const noResultItem = document.createElement('div');
                        noResultItem.classList.add('no-result');
                        noResultItem.textContent = 'No results found';
                        autoCompleteContainer.appendChild(noResultItem);
                    }

                    // Find matching node
                    let matchedNode = allNodes.find(node =>
                        node.latitude !== null &&
                        node.longitude !== null &&
                        node.ชื่อ.toLowerCase() === searchTerm
                    );

                    let displayNode = matchedNode;

                    if (matchedNode) {
                        // If node has 'partner' tag, switch to partner node for display
                        if (matchedNode.tags && matchedNode.tags.includes('partner')) {
                            const partnerNode = allNodes.find(node => node.id === matchedNode.pid);
                            if (partnerNode) {
                                displayNode = partnerNode; // Display partner node in tree
                            }
                        }

                        // Find descendants and partners
                        const descendants = findDescendants(displayNode.id, allNodes);
                        const partners = descendants.flatMap(descendant =>
                            allNodes.filter(node => node.pid === descendant.id && node.tags && node.tags.includes('partner'))
                        );

                        // Highlight the matched node
                        matchedNode.tags = matchedNode.tags.includes('partner') ? ['searched', 'partner'] : ['searched'];

                        // Load nodes in tree view
                        const nodesToLoad = [displayNode, ...descendants, ...partners];
                        chart.load([...new Set(nodesToLoad)]); // Use Set to avoid duplicates

                        // After search, if the node has 'partner', display its name in the search box
                        if (matchedNode.tags.includes('partner')) {
                            searchInput.value = matchedNode.ชื่อ; // Set the name of the matched node in the input
                        }
                    }
                } else {
                    chart.load(allNodes); // Load all nodes if no search term
                }
            }, 150);

            // Event listener for input
            searchInput.addEventListener('input', function () {
                autoCompleteContainer.style.display = 'block'; // Show suggestions when typing
                handleSearch(); // Trigger handleSearch when input changes
            });

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


            searchInput.addEventListener('input', handleSearch);

            resetButton.addEventListener('click', function () {
                searchInput.value = '';
                autoCompleteContainer.innerHTML = '';

                // คืนค่าสีของโหนดทั้งหมดตามเพศ และเก็บแท็ก partner ถ้ามี
                allNodes.forEach(node => {
                    let newTags = [];

                    // เก็บแท็ก partner ไว้ถ้ามี
                    if (node.tags && node.tags.includes('partner')) {
                        newTags.push('partner');
                    }

                    // ตั้งค่าแท็กตามเพศ
                    if (node.เพศ === 'ชาย') {
                        newTags.push('male');
                    } else if (node.เพศ === 'หญิง') {
                        newTags.push('female');
                    }

                    node.tags = newTags; // ตั้งค่าแท็กใหม่
                });

                chart.load(allNodes); // โหลดโหนดทั้งหมดเมื่อรีเซ็ตการค้นหา
                setTimeout(function () {
                    alert('ค้นหาได้ถูกรีเซ็ตแล้ว');
                }, 300);
            });


            loadFamilyData(tableSelect.value).then(() => {
                isTableChanged = false;
                highlightNode();
            });

            function highlightNode() {
                const urlParams = new URLSearchParams(window.location.search);
                const selectedId = urlParams.get('id');
                const searchName = urlParams.get('search');

                if (searchName && !isTableChanged) {
                    searchInput.value = decodeURIComponent(searchName);
                    handleSearch();
                } else {
                    searchInput.value = '';  // Clear search input if table is changed or no searchName in URL
                }

                if (selectedId && chart) {
                    const nodeElement = chart.getNodeElement(selectedId);
                    if (nodeElement) {
                        nodeElement.style.border = "3px solid red";
                        nodeElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                }
            }

            const urlParams = new URLSearchParams(window.location.search);
            const selectedTable = urlParams.get('table');

            if (selectedTable) {
                tableSelect.value = selectedTable;
                loadFamilyData(selectedTable).then(() => {
                    isTableChanged = false;
                    highlightNode();
                });
            }

            tableSelect.addEventListener('change', function () {
                searchInput.value = '';  // Clear search input immediately on kingdom change
                autoCompleteContainer.innerHTML = '';
                const newUrl = window.location.href.split('?')[0]; // Remove query parameters
                window.history.replaceState({}, document.title, newUrl); // Replace URL without reloading
                isTableChanged = true;
                loadFamilyData(this.value).then(() => {
                    isTableChanged = false;
                    highlightNode();
                });
            });
        });

    </script>

</body>

</html>