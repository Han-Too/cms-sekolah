// $("#modalAddUser_btn").click(function (e) {

$("#modalAddUser_form").on("submit", function (e) {
    

    e.preventDefault();
    let form = $("#modalAddUser_form")[0];
    var token = $('meta[name="csrf-token"]').attr("content");
    var data = $(this).serialize();

    if ($("#nama").val() == "") {
        document.getElementById("nama").classList.add("is-invalid");
    }
    if ($("#username").val() == "") {
        document.getElementById("username").classList.add("is-invalid");
    }
    if ($("#role").val() == "") {
        document.getElementById("role").classList.add("is-invalid");
    }

    if ($("#password").val() == "") {
        document.getElementById("password").classList.add("is-invalid");
    }

    if ($("#password").val() != $("#repassword").val()) {
        document.getElementById("repassword").classList.add("is-invalid");
    }

    $.ajax({
        url: "/user/store",
        type: "POST",
        data: {
            username: $("#username").val(),
            nama: $("#nama").val(),
            role: $("#role").val(),
            password: $("#password").val(),
            repassword: $("#repassword").val(),
        },
        // dataType: "JSON",
        success: function (response) {
            // console.log(data);
            if (response.status == false) {
                Swal.fire({
                    text: "Mohon Lengkapi Data!",
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn btn-primary",
                    },
                });
            } else {
                Swal.fire({
                    text: response.message,
                    icon: "success",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn btn-primary",
                    },
                }).then(function (t) {
                    if (t.isConfirmed) {
                        window.location.reload();
                    }
                });
            }
        },
        error: function (xhr, status, error) {
            Swal.fire({
                text: "Sorry, looks like there are some errors detected, please try again.",
                icon: "error",
                buttonsStyling: false,
                confirmButtonText: "Ok, got it!",
                customClass: {
                    confirmButton: "btn btn-primary",
                },
            });
        },
    });
});
