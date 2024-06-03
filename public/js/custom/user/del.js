for (var i = 0; i < document.getElementById("jumlah").value; i++) {
    document
        .getElementById("deluser-" + i)
        .addEventListener("click", function () {
            var id = $(this).data("id");
            Swal.fire({
                title: "Hapus User Ini?",
                icon: "question",
                // showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: "Delete",
                // denyButtonText: `Cancel`,
                customClass: {
                    confirmButton: "btn btn-danger",
                    cancelButton: "btn btn-secondary",
                },
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.ajax({
                        url: "/user/delete/" + id,
                        type: "GET",
                        data: "",
                        success: function (response) {
                            Swal.fire({
                                text: response.message,
                                icon: "success",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn btn-primary",
                                },
                            }).then(() => {
                                window.location.reload();
                            });
                        },
                    });
                } else {
                    Swal.fire({
                        text: "Operasi Dihentikan",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary",
                        },
                    });
                }
            });
        });
}
