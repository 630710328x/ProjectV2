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
            });
    };

    const loadFamilyData = (table) => {
        loadingIndicator.style.display = 'block';
        fetchFamilyData(table)
            .then(familyData => {
                if (familyData.error) {
                    throw new Error(familyData.error);
                }

                const nodes = familyData.map(member => ({
                    id: member.id,
                    pid: member.parent_id,
                    name: member.name,
                    relationship: member.relationship,
                    birth: member.birth !== null ? member.birth : "ไม่ปรากฏ",
                    death: member.death !== null ? member.death : "ไม่ปรากฏ",
                    img: member.img,
                    tags: member.tags
                }));

                if (chart) {
                    chart.load(nodes);
                } else {
                    chart = new OrgChart(treeContainer, {
                        nodes: nodes,
                        nodeBinding: {
                            field_0: "name",
                            field_1: "relationship",
                            img_0: "img"
                        },
                        template: "diva",
                        enableSearch: true,
                        searchFields: ["name"],
                        nodeTemplate: function(data) {
                            return `
                                <div class="node">
                                    <img src="${data.img}" alt="${data.name}" />
                                    <div>
                                        <div>${data.name}</div>
                                        <div>${data.relationship}</div>
                                        <div>Birth: ${data.birth}</div>
                                        <div>Death: ${data.death}</div>
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
