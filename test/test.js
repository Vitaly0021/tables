var clicked = false, clickY;
$(document).on({
    'mousemove': function(e) {
        clicked && updateScrollPos(e);
    },
    'mousedown': function(e) {
        clicked = true;
        clickY = e.pageY;
    },
    'mouseup': function() {
        clicked = false;
        $('html').css('cursor', 'auto');
    }
});

var updateScrollPos = function(e) {
    $('html').css('cursor', 'row-resize');
    $(window).scrollTop($(window).scrollTop() + (clickY - e.pageY));
}

let el = document.querySelector("table");
let x = 0, y = 0, _tableTop = 0, left = 0;

let draggingFunction = (e) => {
    document.addEventListener('mouseup', () => {
        document.removeEventListener("mousemove", draggingFunction);
    });

    el.scrollLeft = left - e.pageX + x;
    el.scrollTop = _tableTop - e.pageY + y;
};

el.addEventListener('mousedown', (e) => {
    e.preventDefault();

    y = e.pageY;
    x = e.pageX;
    _tableTop = el.scrollTop;
    left = el.scrollLeft;

    document.addEventListener('mousemove', draggingFunction);
});