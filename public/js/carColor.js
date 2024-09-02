document.addEventListener('DOMContentLoaded', function () {
    const colorPicker = document.getElementById("nativeColorPicker1");
    const changeColorBtn = document.getElementById("color");

    if (colorPicker && changeColorBtn) {
        function handColorChange() {
            changeColorBtn.value = '';
            changeColorBtn.value = colorPicker.value.replace('#', '');
            changeColorBtn.dispatchEvent(new Event('input'));
        }
        colorPicker.addEventListener('input', handColorChange);
    }
});