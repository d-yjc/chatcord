document.addEventListener('emojiSelected', event => {
    const emoji = event.detail;
    const textarea = document.getElementById('body');
    textarea.focus();
    const startPos = textarea.selectionStart;
    textarea.setRangeText(emoji, startPos, startPos, 'end');
});