image = document.getElementById ('image');
image.left = 0;
image.top = 0;

let isDragging = false;
image.addEventListener ("mousedown", function (e) {
    x = e.offsetX;
    y = e.offsetY;
    isDragging = true;
});
image.addEventListener ("mousemove", function (e) {
    if (!isDragging) return;
    image.left += e.offsetX - x;
    image.top += e.offsetY - y;
    image.style.left = image.left + 'px';
    image.style.top = image.top + 'px';
});
image.addEventListener ("mouseup", function (e) {
    isDragging = false;
});
