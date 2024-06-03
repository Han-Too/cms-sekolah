for (var i = 0; i < document.getElementById("jumlah").value; i++) {
    document
        .getElementById("edituser-" + i)
        .addEventListener("click", function () {
            var id = $(this).data("id");
            $.ajax({
                url: "/user/get/" + id,
                type: "GET",
                data: "",
                success: function (response) {
                    $("#modalEditUser").modal("show");
                    document.getElementById("editusername").value =
                        response.data.username;
                    document.getElementById("editnama").value =
                        response.data.name;
                    document.getElementById("editemail").value =
                        response.data.email;
                    document.getElementById("edittelepon").value =
                        response.data.telepon;
                    document.getElementById("editalamat").value =
                        response.data.alamat;
                    document.getElementById("editrole").value =
                        response.data.role;

                    $("#modalEditUser_form").on("submit", function (e) {
                        e.preventDefault();
                        let form = $("#modalEditUser_form")[0];
                        var token = $('meta[name="csrf-token"]').attr(
                            "content"
                        );
                        var data = $(this).serialize();

                        if ($("#editnama").val() == "") {
                            document.getElementById("editnama").value =
                                response.data.name;
                        }
                        if ($("#editusername").val() == "") {
                            document.getElementById("editusername").value =
                                response.data.username;
                        }
                        if ($("#editrole").val() == "") {
                            document.getElementById("editrole").value =
                                response.data.role;
                        }


                        $.ajax({
                            url: "/user/edit/"+response.data.user_token,
                            type: "POST",
                            data: {
                                username: $("#editusername").val(),
                                nama: $("#editnama").val(),
                                role: $("#editrole").val(),
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
                },
            });
        });
}
