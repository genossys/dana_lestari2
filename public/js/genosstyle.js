$(window).on("load", function() {
    $(".judulsl2").addClass("jmuncul");
    $(".judulsl1").addClass("jmuncul");
    $(".tombol").addClass("jmuncul");
    $(".bgtekshome").addClass("bgmuncul");
});

$(".multiple-items").on("beforeChange", function() {
    //change color here
    $(".judulsl2").removeClass("jmuncul");
    $(".judulsl1").removeClass("jmuncul");
    $(".tombol").removeClass("jmuncul");
    $(".bgtekshome").removeClass("bgmuncul");
});

$(".multiple-items").on("afterChange", function() {
    //change color here
    $(".judulsl2").addClass("jmuncul");
    $(".judulsl1").addClass("jmuncul");
    $(".tombol").addClass("jmuncul");
    $(".bgtekshome").addClass("bgmuncul");
});
