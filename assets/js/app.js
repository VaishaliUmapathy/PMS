let teamsData = [
    {
        teamName: "Team Alpha",
        members: [
            { name: "Alice" },
            { name: "Bob" },
            { name: "Charlie" }
        ],
        projectTitle: "AI-based Traffic Management",
        abstractSubmitted: "Yes",
        projectDetailsSubmitted: "Yes",
        approvalStatus: "Pending",
        mentor: "Dr. Smith",
        progress: [60, 80, 100] // Progress for Demo 1, Demo 2, Demo 3
    },
    {
        teamName: "Team Beta",
        members: [
            { name: "David" },
            { name: "Eva" },
            { name: "Frank" }
        ],
        projectTitle: "Smart Healthcare System",
        abstractSubmitted: "Yes",
        projectDetailsSubmitted: "No",
        approvalStatus: "Pending",
        mentor: "Dr. Clark",
        progress: [40, 60, 75]
    },
    {
        teamName: "Team Gamma",
        members: [
            { name: "Grace" },
            { name: "Hank" },
            { name: "Ivy" }
        ],
        projectTitle: "Blockchain Voting System",
        abstractSubmitted: "No",
        projectDetailsSubmitted: "No",
        approvalStatus: "Pending",
        mentor: "Dr. John",
        progress: [20, 40, 60]
    }
];

// Function to load teams data and generate individual bar charts
function loadTeamsData() {
    const cardsContainer = document.getElementById('teamsCards');
    cardsContainer.innerHTML = ''; // Clear container

    teamsData.forEach((team, index) => {
        // Create a card for each team
        const card = createTeamCard(team, index);
        cardsContainer.appendChild(card); // Add the card to the container

        // Call function to load individual bar chart for this team
        loadIndividualBarChart(team, index);
    });
}

// Function to create a team card
function createTeamCard(team, index) {
    const card = document.createElement('div');
    card.classList.add('card');
    
    // Create a canvas element for the team's chart
    const canvas = document.createElement('canvas');
    canvas.id = `teamChart-${index}`;
    canvas.width = 400;
    canvas.height = 200;

    card.innerHTML = `
        <h3>${team.teamName}</h3>
        <p><strong>Project Title:</strong> ${team.projectTitle}</p>
        <p><strong>Members:</strong> ${team.members.map(member => member.name).join(', ')}</p>
        <p><strong>Abstract Submitted:</strong> ${team.abstractSubmitted}</p>
        <p><strong>Project Details Submitted:</strong> ${team.projectDetailsSubmitted}</p>
        <p><strong>Approval Status:</strong> <span id="status-${index}">${team.approvalStatus}</span></p>
        <p><strong>Mentor:</strong> ${team.mentor}</p>
        <button class="approve" onclick="updateApprovalStatus(${index}, 'Approved')">Approve</button>
        <button class="reject" onclick="updateApprovalStatus(${index}, 'Rejected')">Reject</button>
        <button onclick="openEditModal(${index})">Edit</button>
    `;
    
    card.appendChild(canvas); // Append the chart canvas to the card
    return card; // Return the created card
}

// Function to load an individual bar chart for a specific team
function loadIndividualBarChart(team, index) {
    const ctx = document.getElementById(`teamChart-${index}`).getContext('2d');
    
    const chartData = {
        labels: ['Demo 1', 'Demo 2', 'Demo 3'], // Labels for each demo stage
        datasets: [{
            label: team.teamName,
            data: team.progress, // Progress data for this team
            backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56'], // Unique colors for each demo
            borderColor: ['#FF6384', '#36A2EB', '#FFCE56'], // Border colors for each bar
            borderWidth: 1
        }]
    };

    new Chart(ctx, {
        type: 'bar', // Bar chart
        data: chartData,
        options: {
            scales: {
                y: {
                    beginAtZero: true,  // Ensure the Y-axis starts from zero
                    max: 100            // Max progress percentage is 100%
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: (context) => {
                            return `${context.dataset.label}: ${context.raw}%`; // Display percentage
                        }
                    }
                }
            }
        }
    });
}

// Function to update the approval status of a team
function updateApprovalStatus(index, status) {
    teamsData[index].approvalStatus = status; // Update status in data
    document.getElementById(`status-${index}`).textContent = status; // Update status in the card
    showNotification(`Project status updated to ${status} for ${teamsData[index].teamName}!`);
}

// Function to open edit modal and edit project title and members
function openEditModal(index) {
    const team = teamsData[index];
    
    const newTitle = prompt("Edit Project Title:", team.projectTitle);
    if (newTitle) {
        team.projectTitle = newTitle;
    }

    const newMembers = prompt("Edit Team Members (comma-separated):", team.members.map(member => member.name).join(', '));
    if (newMembers) {
        team.members = newMembers.split(',').map(name => ({ name: name.trim() }));
    }

    loadTeamsData(); // Refresh the data displayed
}

// Function to filter teams based on search input
function filterTeams() {
    const input = document.getElementById('searchInput').value.toLowerCase();
    const filteredTeams = teamsData.filter(team => 
        team.teamName.toLowerCase().includes(input) || 
        team.projectTitle.toLowerCase().includes(input)
    );

    loadFilteredTeamsData(filteredTeams); // Load only filtered teams
}

// Function to load filtered teams
function loadFilteredTeamsData(filteredTeams) {
    const cardsContainer = document.getElementById('teamsCards');
    cardsContainer.innerHTML = ''; // Clear container

    filteredTeams.forEach((team, index) => {
        // Create a card for each team
        const card = createTeamCard(team, index);
        cardsContainer.appendChild(card); // Add the card to the container

        // Call function to load individual bar chart for this team
        loadIndividualBarChart(team, index);
    });
}

// Function to sort teams
function sortTeams() {
    const option = document.getElementById('sortOptions').value;

    if (option === "name") {
        teamsData.sort((a, b) => a.teamName.localeCompare(b.teamName));
    } else if (option === "status") {
        teamsData.sort((a, b) => a.approvalStatus.localeCompare(b.approvalStatus));
    } else if (option === "progress") {
        teamsData.sort((a, b) => Math.max(...b.progress) - Math.max(...a.progress));
    }

    loadTeamsData(); // Reload teams after sorting
}

// Function to show notification
function showNotification(message) {
    const notification = document.getElementById('notification');
    notification.textContent = message;
    notification.style.display = 'block';

    setTimeout(() => {
        notification.style.display = 'none'; // Hide after 3 seconds
    }, 3000);
}

// Function to export data as CSV
function exportData() {
    const csvContent = "data:text/csv;charset=utf-8," + 
        teamsData.map(team => `${team.teamName},${team.projectTitle},${team.approvalStatus}`).join("\n");
    
    const encodedUri = encodeURI(csvContent);
    const link = document.createElement("a");
    link.setAttribute("href", encodedUri);
    link.setAttribute("download", "teams_data.csv");
    document.body.appendChild(link); // Required for Firefox
    link.click(); // This will download the data file named "teams_data.csv".
}

// Load data on page load
document.addEventListener('DOMContentLoaded', () => {
    loadTeamsData(); // Load individual charts for all teams
});
