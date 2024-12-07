
document.addEventListener('DOMContentLoaded', () => {
    const dropdownButton = document.getElementById('profileDropdownButton');
    const dropdownMenu = document.getElementById('profileDropdownMenu');

    dropdownButton?.addEventListener('click', (event) => {
        event.stopPropagation();
        dropdownMenu?.classList.toggle('hidden');
    });

    document.addEventListener('click', () => {
        dropdownMenu?.classList.add('hidden');
    });
});
