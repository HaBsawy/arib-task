$(".alert button.btn-close").click(function () {
    $(this).parent().fadeOut();
});

$(".dropdown-toggle").click(function () {
    $(this).next(".dropdown-menu").slideToggle();
});

$(".dropdown-menu").click(function () {
    $(this).slideUp();
});
