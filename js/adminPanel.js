document.addEventListener('DOMContentLoaded', function() {
    // Tab switching functionality
    var usersTabBtn = document.querySelector('.tab-btn[data-tab="users"]');
    var contentTabBtn = document.querySelector('.tab-btn[data-tab="content"]');
    var settingsTabBtn = document.querySelector('.tab-btn[data-tab="settings"]');
    
    var usersTab = document.getElementById('users');
    var contentTab = document.getElementById('content');
    var settingsTab = document.getElementById('settings');
    
    usersTabBtn.onclick = function() {
        usersTabBtn.className = 'tab-btn active';
        contentTabBtn.className = 'tab-btn';
        settingsTabBtn.className = 'tab-btn';
        
        usersTab.className = 'tab-content active';
        contentTab.className = 'tab-content';
        settingsTab.className = 'tab-content';
    };
    
    contentTabBtn.onclick = function() {
        usersTabBtn.className = 'tab-btn';
        contentTabBtn.className = 'tab-btn active';
        settingsTabBtn.className = 'tab-btn';
        
        usersTab.className = 'tab-content';
        contentTab.className = 'tab-content active';
        settingsTab.className = 'tab-content';
    };
    
    settingsTabBtn.onclick = function() {
        usersTabBtn.className = 'tab-btn';
        contentTabBtn.className = 'tab-btn';
        settingsTabBtn.className = 'tab-btn active';
        
        usersTab.className = 'tab-content';
        contentTab.className = 'tab-content';
        settingsTab.className = 'tab-content active';
    };

    // Settings form submission
    var settingsForm = document.getElementById('settings-form');
    if (settingsForm) {
        settingsForm.onsubmit = function(e) {
            e.preventDefault();
            
            var siteName = document.getElementById('site-name').value;
            var siteUrl = document.getElementById('site-url').value;
            var timezone = document.getElementById('timezone').value;
            
            if (!siteName || !siteUrl) {
                alert('Please fill in all required fields');
                return;
            }
            
            if (!siteUrl.startsWith('http://') && !siteUrl.startsWith('https://')) {
                alert('Please enter a valid URL starting with http:// or https://');
                return;
            }
            
            alert('Settings saved successfully! (simulated)');
        };
    }

    // Add User button (simulated)
    var addUserBtn = document.querySelector('#users .btn-primary');
    if (addUserBtn) {
        addUserBtn.onclick = function() {
            alert('Add User functionality would open a form here');
        };
    }
});