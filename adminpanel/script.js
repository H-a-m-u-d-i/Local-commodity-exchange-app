function toggleSubmenu(menuId) {
    // Toggle the display of the submenu
    const submenu = document.getElementById(menuId);
    if (submenu) {
        const isDisplayed = submenu.style.display === 'block';
        submenu.style.display = isDisplayed ? 'none' : 'block';
    }
}

function showContent(sectionId) {
    // Hide all sections
    const sections = document.querySelectorAll('.section');
    sections.forEach(section => {
        section.classList.remove('active');
    });

    // Show the selected section
    const activeSection = document.getElementById(sectionId);
    if (activeSection) {
        activeSection.classList.add('active');
    }
}

// Optionally, you can show the first section by default
document.addEventListener('DOMContentLoaded', () => {
    showContent('addCategory'); // Show the first section by default
});
