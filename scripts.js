document.addEventListener("DOMContentLoaded", function() {
    const tableSelect = document.getElementById('tableSelect');
    const treeContainer = document.getElementById('tree');
    const errorContainer = document.getElementById('error');
    const loadingIndicator = document.getElementById('loading');
    const searchInput = document.getElementById('searchInput');
    OrgChart.templates.ana.field_0 = '<text width="230" style="font-size: 18px;" fill="#000000" x="125" y="95" text-anchor="middle" class="field_0">{val}</text>';
    OrgChart.templates.ana.field_1 = '<text width="130" text-overflow="multiline" style="font-size: 14px;" fill="#000000" x="230" y="30" text-anchor="end" class="field_1">{val}</text>';
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
                    ครองราชย์: (member.reignstart !== null ? "พ.ศ. " + member.reignstart + " - " + (member.reignend !== null ? "พ.ศ. " + member.reignend : "ไม่ปรากฎ") : "ไม่ปรากฎ"),
                    ประสูติ: member.birth !== null ? "พ.ศ. " + member.birth : "ไม่ปรากฏ",
                    สวรรคต: member.death !== null ? "พ.ศ. " + member.death : "ไม่ปรากฏ",
                    img: member.img,
                    tags: member.tags,
                    ราชวงศ์: member.monarch !== null ? member.monarch : "ไม่ปรากฏ",
                    คู่อภิเษก: member.wife !== null ? member.wife : "ไม่ปรากฏ",
                    พระราชบุตร: member.child !== null ? member.child : "ไม่ปรากฏ",
                    พระบิดา: member.father !== null ? member.father : "ไม่ปรากฏ",
                    พระมารดา: member.mother !== null ? member.mother : "ไม่ปรากฏ",
                    วิกิพีเดีย: member.urlking !== null ? member.urlking : "ไม่ปรากฏ",
                    ppid: member.ppid
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

    loadFamilyData(tableSelect.value);

    tableSelect.addEventListener('change', function() {
        loadFamilyData(this.value);
    });
});
