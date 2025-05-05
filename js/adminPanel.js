document.addEventListener('DOMContentLoaded', function () {
    const tabButtons = document.querySelectorAll('.tab-btn');
    const tabContents = [
      document.getElementById('users'),
      document.getElementById('content'),
      document.getElementById('settings')
    ];

    tabButtons.forEach(function (btn, index) {
      btn.onclick = function () {
        // Deactivate all tabs
        tabButtons.forEach(function (b) {
          b.className = 'tab-btn';
        });
        tabContents.forEach(function (content) {
          content.className = 'tab-content';
        });

        // Activate current tab
        btn.className = 'tab-btn active';
        tabContents[index].className = 'tab-content active';
      };
    });

    const settingsForm = document.getElementById('settings-form');
    if (settingsForm) {
      settingsForm.onsubmit = function (e) {
        e.preventDefault();
        const siteName = document.getElementById('site-name').value;
        const siteUrl = document.getElementById('site-url').value;
        const timezone = document.getElementById('timezone').value;

        if (!siteName || !siteUrl) {
          alert('Please fill in all required fields');
          return;
        }

        if (!siteUrl.startsWith('http://') && !siteUrl.startsWith('https://')) {
          alert('Please enter a valid URL starting with http:// or https://');
          return;
        }

        alert('Settings saved successfully!');
      };
    }

    const addUserBtn = document.querySelector('#users .btn-primary');
    if (addUserBtn) {
      addUserBtn.onclick = function () {
        alert('Add User functionality would open a form here');
      };
    }
  });