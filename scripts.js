document.addEventListener("DOMContentLoaded", function() {
    const tableSelect = document.getElementById('tableSelect');
    const treeContainer = document.getElementById('tree');
    const errorContainer = document.getElementById('error');
    const loadingIndicator = document.getElementById('loading');
    const searchInput = document.getElementById('searchInput');

    let chart;

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
        fetchFamilyData(table)
            .then(familyData => {
                if (!Array.isArray(familyData)) {
                    throw new Error('Invalid data format');
                }

                const nodes = familyData.map(member => ({
                    id: member.id,
                    pid: member.parent_id,
                    ชื่อ: member.name,
                    ตำแหน่ง: member.relationship,
                    ประสูติ: member.birth !== null ? member.birth : "ไม่ปรากฏ",
                    สวรรคต: member.death !== null ? member.death : "ไม่ปรากฏ",
                    img: member.img,
                    tags: member.tags,
                    ราชวงศ์: member.monarch !== null ? member.monarch : "ไม่ปรากฏ",
                    คู่อภิเษก: member.wife !== null ? member.wife : "ไม่ปรากฏ",
                    พระราชบุตร: member.child !== null ? member.child : "ไม่ปรากฏ",
                    พระบิดา: member.father !== null ? member.father : "ไม่ปรากฏ",
                    พระมารดา: member.mother !== null ? member.mother : "ไม่ปรากฏ",
                    วิกิพีเดีย: member.urlking !== null ? member.urlking : "ไม่ปรากฏ",
                }));

                console.log('Nodes:', nodes);

                if (chart) {
                    chart.load(nodes);
                } else {
                    chart = new OrgChart(treeContainer, {
                        nodes: nodes,
                        nodeBinding: {
                            field_0: "ชื่อ",
                            field_1: "ตำแหน่ง",
                            img_0: "img"
                        },
                        template: "diva",
                        enableSearch: true,
                        searchFields: ["ชื่อ"],
                        nodeTemplate: function(data) {
                            return `
                                <div class="node">
                                    <img src="${data.img}" alt="${data.ชื่อ}" />
                                    <div>
                                        <div>${data.ชื่อ}</div>
                                        <div>${data.ตำแหน่ง}</div>
                                        <div>${data.ประสูติ}</div>
                                        <div>${data.สวรรคต}</div>
                                        <div>${data.ราชวงศ์}</div>
                                        <div>${data.คู่อภิเษก}</div>
                                        <div>${data.พระราชบุตร}</div>
                                        <div>${data.พระบิดา}</div>
                                        <div>${data.พระมารดา}</div>
                                        <div>${data.วิกิพีเดีย}</div>
                                    </div>
                                </div>
                            `;
                        }
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

    loadFamilyData(tableSelect.value);

    tableSelect.addEventListener('change', function() {
        loadFamilyData(this.value);
    });
});
