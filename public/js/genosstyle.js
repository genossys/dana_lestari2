$(window).on("load", function() {
    $(".judulsl2").addClass("jmuncul");
    $(".judulsl1").addClass("jmuncul");
    $(".tombol").addClass("jmuncul");
    $(".bgtekshome").addClass("bgmuncul");
    $(".animIn").addClass("muncul");

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

$(window).scroll(function() {
    var wscroll = $(this).scrollTop();
    console.log(wscroll);

    if(wscroll > $('.gambarMultiguna').offset().top - 500){
        $(".gambarMultiguna").addClass("muncul");
        $(".textMultiguna").addClass("muncul");
    }else{
        $(".gambarMultiguna").removeClass("muncul");
        $(".textMultiguna").removeClass("muncul");
    }

    if(wscroll > $('.textModalKerja').offset().top - 500){
        $(".gambarModalKerja").addClass("muncul");
        $(".textModalKerja").addClass("muncul");
    }else{
        $(".gambarModalKerja").removeClass("muncul");
        $(".textModalKerja").removeClass("muncul");
    }

    if(wscroll > $('.gambarBLoan').offset().top - 500){
        $(".gambarBLoan").addClass("muncul");
        $(".textBLoan").addClass("muncul");
    }else{
        $(".gambarBLoan").removeClass("muncul");
        $(".textBLoan").removeClass("muncul");
    }
});
