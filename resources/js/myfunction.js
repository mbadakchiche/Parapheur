function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#imagePreview').css('background-image', 'url(' + e.target.result + ')')
                .hide()
                .fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

$(document).on("change", "#thumbnail", function () {
    readURL(this);
});

$(document).on("show.bs.modal", ".modal", function () {
    $('.receiversSelect').select2({
            placeholder: 'Select an option',
            theme: 'classic',
        }
    );

});


