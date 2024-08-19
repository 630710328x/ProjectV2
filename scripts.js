document.addEventListener("DOMContentLoaded", function() {
    const tableSelect = document.getElementById('tableSelect');
    const treeContainer = document.getElementById('tree');
    const errorContainer = document.getElementById('error');
    const loadingIndicator = document.getElementById('loading');
    const searchInput = document.getElementById('searchInput');
    
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

    OrgChart.templates.filtered = Object.assign({}, OrgChart.templates.ana);
    OrgChart.templates.filtered.size = [80, 150];
    OrgChart.templates.filtered.img_0 = '';
    OrgChart.templates.filtered.field_0 = '<text data-text-overflow="ellipsis" transform="rotate(90)" style="font-size: 22px;" fill="#000000" x="60" y="-30" text-anchor="middle">{val}</text>';
    OrgChart.templates.filtered.field_1 = '';

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

                const translateGender = (gender) => {
                    if (gender === 'male') {
                        return 'ชาย';
                    } else if (gender === 'female') {
                        return 'หญิง';
                    } else {
                        return gender;
                    }
                };
                
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
                    ppid: member.ppid,
                    เพศ: translateGender(member.gender)  // ใช้ฟังก์ชัน translateGender() ที่นี่
                }));
                
                console.log('Nodes:', nodes);

                if (chart) {
                    chart.load(nodes);
                } else {
                    chart = new OrgChart(treeContainer, {
                        nodes: nodes,
                        layout: OrgChart.tree,    
                        mouseScrool: OrgChart.none,
                        align: OrgChart.ORIENTATION,
                        keyNavigation: true,
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

                    chart.on('render-link', function(sender, args) {
                        let heartCreated = false;
                    
                        // // เงื่อนไขแรก: ถ้า ppid ถูกกำหนด และยังไม่ได้สร้างหัวใจ
                        // if (args.cnode.ppid !== undefined && !heartCreated) {
                        //      args.html += '<use xlink:href="#heart" x="'+ args.p.xa +'" y="'+ args.p.ya +'" />';
                        //      heartCreated = true; // ตั้งค่าว่าหัวใจถูกสร้างแล้ว
                        //  }
                    
                        // เงื่อนไขที่สอง: ถ้ามี tag {partner} และยังไม่ได้สร้างหัวใจ
                        if (!heartCreated && args.cnode.tags && args.cnode.tags.includes('partner')) {
                            args.html += '<use xlink:href="#heart" x="'+ args.p.xa +'" y="'+ args.p.ya +'" />';
                            heartCreated = true; // ตั้งค่าว่าหัวใจถูกสร้างแล้ว
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
