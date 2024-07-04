document.addEventListener("DOMContentLoaded", function() {
    const tableSelect = document.getElementById('tableSelect');
    const treeContainer = document.getElementById('tree');
    const errorContainer = document.getElementById('error');
    const loadingIndicator = document.getElementById('loading');
    const searchInput = document.getElementById('searchInput');

    let chart;

    const loadFamilyData = (table) => {
        loadingIndicator.style.display = 'block';

        fetch(`fetch_family_data.php?table=${table}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`Network response was not ok: ${response.statusText}`);
                }
                return response.json();
            })
            .then(familyData => {
                if (familyData.error) {
                    throw new Error(familyData.error);
                }

                const nodes = familyData.map(member => ({
                    id: member.id,
                    pid: member.parent_id,
                    ppid: member.ppid,
                    name: member.name,
                    relationship: member.relationship,
                    birth: member.birth,
                    death: member.death,
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
                errorContainer.textContent = 'An error occurred while fetching data. Please try again later.';
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

    searchInput.addEventListener('input', function() {
        chart.search(this.value);
    });
});
