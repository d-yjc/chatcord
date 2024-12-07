document.addEventListener('DOMContentLoaded', () => {
    const emojiPickerButton = document.getElementById('emojiPickerButton');
    const emojiPickerMenu = document.getElementById('emojiPickerMenu');

    emojiPickerButton.addEventListener('click', () => {
        emojiPickerMenu.classList.toggle('hidden');
    });

    emojiPickerMenu.addEventListener('click', (event) => {
        event.stopPropagation();
    });
});
