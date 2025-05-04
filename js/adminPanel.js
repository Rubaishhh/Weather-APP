document.addEventListener('DOMContentLoaded', function() {
    const tabBtns = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');

    tabBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const tabId = this.getAttribute('data-tab');

            // Remove active class from all buttons and contents
            tabBtns.forEach(btn => btn.classList.remove('active'));
            tabContents.forEach(content => content.classList.remove('active'));

            // Add active class to clicked button and corresponding content
            this.classList.add('active');
            document.getElementById(tabId).classList.add('active');
        });
    });

    // Handle form submission for settings
    document.getElementById('settings-form').addEventListener('submit', function(e) {
        e.preventDefault();
        alert('Settings saved!');
        // Here you can add code to save settings to your backend
    });

    // Handle Add User button click
    const addUserBtn = document.querySelector('#users .btn-primary');
    addUserBtn.addEventListener('click', function() {
        alert('Add user form would open here');
        // Here you can add code to open a modal or navigate to add user page
    });

    // Handle Edit and Delete buttons
    document.querySelectorAll('#users .btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const action = this.textContent.trim();
            if (action === 'Edit') {
                alert('Edit user form would open here');
                // Add code to handle edit action
            } else if (action === 'Delete') {
                if (confirm('Are you sure you want to delete this user?')) {
                    alert('User deleted (simulated)');
                    // Add code to handle delete action
                }
            }
        });
    });

    // Handle Approve and Reject buttons in Content Moderation
    document.querySelectorAll('#content .btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const action = this.textContent.trim();
            if (action === 'Approve') {
                alert('Content approved (simulated)');
                // Add code to handle approve action
            } else if (action === 'Reject') {
                alert('Content rejected (simulated)');
                // Add code to handle reject action
            }
        });
    });
});
