document.addEventListener("DOMContentLoaded", function() {
    // Profile view toggle
    
    // Team members view toggle
    const viewButtons = document.querySelectorAll(".view-button");

    viewButtons.forEach(function(button) {
        button.addEventListener("click", function() {
            const flexContainer = button.closest('.team').querySelector('.flex-container');
            if (flexContainer.style.display === "none" || flexContainer.style.display === "") {
                flexContainer.style.display = "flex";  // Use flex to display in horizontal
                button.textContent = "Hide";
            } else {
                flexContainer.style.display = "none";
                button.textContent = "View";
            }
        });
    });
});
