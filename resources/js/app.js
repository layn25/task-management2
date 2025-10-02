import './bootstrap';

document.addEventListener("DOMContentLoaded", function () {
    const toggleBtn = document.getElementById("sidebarToggle");
    const sidebar = document.getElementById("sidebar");
    const body = document.body;

    if (toggleBtn && sidebar) {
        // Get initial state from server-side rendered data
        let isCollapsed = sidebar.classList.contains('collapsed');

        toggleBtn.addEventListener("click", (e) => {
            e.preventDefault();

            // Toggle the collapsed state
            isCollapsed = !isCollapsed;

            if (isCollapsed) {
                sidebar.classList.add('collapsed');
                body.classList.add('sidebar-collapsed');
            } else {
                sidebar.classList.remove('collapsed');
                body.classList.remove('sidebar-collapsed');
            }

            // Send state to server to persist in session
            fetch('/sidebar/toggle', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    collapsed: isCollapsed
                })
            }).catch(function(error) {
                console.error('Error saving sidebar state:', error);
            });
        });
    }
});
