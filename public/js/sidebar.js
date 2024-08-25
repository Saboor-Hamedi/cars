// resources/js/app.js
function openSidebar() {
  const sidebar = document.getElementById('sidebar');
  const sidebarOpen = document.getElementById('sidebar-open');
  if (sidebar) {
    sidebar.classList.remove('hidden');// Toggle visibility
    sidebar.classList.remove('sidebar-open')
  }
  if (sidebarOpen) {
    sidebarOpen.style.display = 'none';
  }
}

function closeSidebar() {
  const sidebar = document.getElementById('sidebar');
  const sidebarOpen = document.getElementById('sidebar-open');
  if (sidebar) {
    sidebar.classList.add('hidden'); // Only close the sidebar
  }
  if (sidebarOpen) {
    sidebarOpen.style.display = 'block';
  }
}

document.addEventListener('DOMContentLoaded', function () {
  window.closeSidebar = closeSidebar;
  window.openSidebar = openSidebar;
});