$(".dropdown > a").click(function (e) {
    e.preventDefault();
    $(this).next('ul').slideToggle();
    $(this).find('svg:last-of-type').toggleClass('fa-chevron-right fa-chevron-down');
});

$(".icon").click(function () {
    $(this).siblings().find(".dropdown").hide();
    $(this).find(".dropdown").slideToggle();
});

$(".icon.sm-screen").click(function () {
    const icons = $(this).next(".icons");
    if (icons.css('display') === 'none') {
        $(this).next(".icons").css('display', 'flex');
    } else {
        $(this).next(".icons").css('display', 'none');
    }
});

$(".right-side-bar-toggle").click(function () {
    $(".right-side-bar").addClass("active");
});

$(".right-side-bar .close").click(function () {
    $(".right-side-bar").removeClass("active");
});

$("#logout").click(function (e) {
    e.preventDefault();
    $("#logout-form").submit();
});

function can(permission) {
    return permissions.includes(permission);
}

$(document).ready(function () {
    setTimeout(function () {
        $('.alert').hide();
    }, 3000);

    // If an event gets to the body
    $("body").click(function(){
        if ($(".side-bar").hasClass("active")) {
            $(".side-bar").removeClass("active");
            $(".content").removeClass("active");
        }
    });

    // Prevent events from getting pass .popup
    $(".side-bar, .left .toggle-side-bar").click(function(e){
        e.stopPropagation();
    });



    $(".left .toggle-side-bar").click(function () {
        $(".side-bar").toggleClass("active");
        $(".content").toggleClass("active");
    });
});

const CONSTANT = {
    SUPERVAN: 'supervan',
    LBFRTIP: 'lBfrtip'
}
