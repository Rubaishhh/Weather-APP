function showTab(tabName) {
    var tab1 = document.getElementById("tab-notifications");
    var tab2 = document.getElementById("tab-settings");
    var content1 = document.getElementById("notifications-tab");
    var content2 = document.getElementById("settings-tab");
  
    tab1.className = "tab";
    tab2.className = "tab";
    content1.style.display = "none";
    content2.style.display = "none";
  
    if (tabName === "notifications") {
      tab1.className = "tab active";
      content1.style.display = "block";
    }
  
    if (tabName === "settings") {
      tab2.className = "tab active";
      content2.style.display = "block";
    }
  }
  
  function showNotifications() {
    var badge = document.getElementById("badge");
  
    if (badge) {
      badge.style.display = "none";
    }
  
    showTab("notifications");
  }
  
  function markAsRead(notification) {
    notification.className = "notification";
    updateBadge();
  }
  
  function updateBadge() {
    var unreadItems = document.getElementsByClassName("notification unread");
    var badge = document.getElementById("badge");
  
    var count = unreadItems.length;
  
    if (badge) {
      if (count > 0) {
        badge.innerHTML = count;
        badge.style.display = "flex";
      } else {
        badge.style.display = "none";
      }
    }
  }
  
  function toggleSetting(name, checkbox) {
    if (checkbox.checked) {
      console.log(name + " enabled");
    } else {
      console.log(name + " disabled");
    }
  }
  