$(document).ready(function () {
    $("#ubah-password").on("click", function () {
        $("#modal-ubah-password").modal("show")
    })
})
$("#eye").on("click", function () {
    let i = $(this).children().eq(0);
    let input = $(this).parent().children().eq(0);
    let type = input.attr("type");
    i.toggleClass("ri-eye-line");
    i.toggleClass("ri-eye-off-line");
    i.toggleClass("text-danger");
    if (type == "text") {
        input.attr("type", "password");
    } else if (type == "password") {
        input.attr("type", "text");
    }
})
$("#eye2").on("click", function () {
    let i = $(this).children().eq(0);
    let input = $(this).parent().children().eq(0);
    let type = input.attr("type");
    i.toggleClass("ri-eye-line");
    i.toggleClass("ri-eye-off-line");
    i.toggleClass("text-danger");
    if (type == "text") {
        input.attr("type", "password");
    } else if (type == "password") {
        input.attr("type", "text");
    }
})
$(".btn-close-password").on("click", function () {
    $("#new_password").val("")
    $("#confirm_password").val("")
})
$("#btn-change").on("click", function () {
    let formdata = $("form[id='form-ubah-password']").serializeArray();
    let data = {}
    $(formdata).each(function (index, obj) {
        data[obj.name] = obj.value;
    });
    let form = $("form[id='form-ubah-password']").serialize();
    if (data.new_password != data.confirm_password) {
        Swal.fire("Warning!", "Konfirmasi Password Tidak Sesuai!", "warning");
    } else {
        $.ajax({
            data: form,
            url: "/changePassword",
            type: "POST",
            dataType: 'json',
            success: function (response) {
                if (response.errors) {
                    displayErrors(response.errors)
                } else {
                    $("#new_password").val("")
                    $("#confirm_password").val("")
                    $("#modal-ubah-password").modal("hide")
                    Swal.fire("Success!", response.success, "success");
                }
            }
        });
    }
    //Hendler Error
    function displayErrors(errors) {
        // menghapus class 'is-invalid' dan pesan error sebelumnya
        $("input.form-control").removeClass("is-invalid");
        $("select.form-control").removeClass("is-invalid");
        $("div.invalid-feedback").remove();

        // menampilkan pesan error baru
        $.each(errors, function (field, messages) {
            let inputElement = $("input[name=" + field + "]");
            let selectElement = $("select[name=" + field + "]");
            let textAreaElement = $("textarea[name=" + field + "]");
            let feedbackElement = $(
                '<div class="invalid-feedback ml-2"></div>'
            );

            $(".btn-close").on("click", function () {
                inputElement.each(function () {
                    $(this).removeClass("is-invalid");
                });
                textAreaElement.each(function () {
                    $(this).removeClass("is-invalid");
                });
                selectElement.each(function () {
                    $(this).removeClass("is-invalid");
                });
            });

            $.each(messages, function (index, message) {
                feedbackElement.append(
                    $('<p class="p-0 m-0 text-center">' + message + "</p>")
                );
            });

            if (inputElement.length > 0) {
                inputElement.addClass("is-invalid");
                inputElement.next().after(feedbackElement);
            }

            if (selectElement.length > 0) {
                selectElement.addClass("is-invalid");
                selectElement.after(feedbackElement);
            }
            if (textAreaElement.length > 0) {
                textAreaElement.addClass("is-invalid");
                textAreaElement.after(feedbackElement);
            }
            inputElement.each(function () {
                if (inputElement.attr("type") == "text" || inputElement.attr("type") == "number") {
                    inputElement.on("click", function () {
                        $(this).removeClass("is-invalid");
                    });
                    inputElement.on("change", function () {
                        $(this).removeClass("is-invalid");
                    });
                } else if (inputElement.attr("type") == "date") {
                    inputElement.on("change", function () {
                        $(this).removeClass("is-invalid");
                    });
                } else if (inputElement.attr("type") == "password") {
                    inputElement.on("click", function () {
                        $(this).removeClass("is-invalid");
                    });
                } else if (inputElement.attr("type") == "email") {
                    inputElement.on("click", function () {
                        $(this).removeClass("is-invalid");
                    });
                }
            });
            textAreaElement.each(function () {
                textAreaElement.on("click", function () {
                    $(this).removeClass("is-invalid");
                });
            });
            selectElement.each(function () {
                selectElement.on("click", function () {
                    $(this).removeClass("is-invalid");
                });
            });
        });
    }
})