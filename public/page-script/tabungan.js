$(document).ready(function () {
    let table = $("#table-tabungan-sukarela").DataTable({
        responsive: true,
        responsive: !0,
        language: {
            paginate: {
                previous: "<i class='ri-arrow-left-s-line'>",
                next: "<i class='ri-arrow-right-s-line'>",
            },
        },
        drawCallback: function () {
            $(".dataTables_paginate > .pagination").addClass(
                "pagination-rounded"
            );
        },
        autoWidth: false,
        serverSide: true,
        ajax: {
            url: "/dataTableSukarela",
            type: "GET",
            data: function (d) {
                // 5 = 1 + 4
                // Hamni { nama, umur, alamat, ttl }
                d.unique_student = $("#pilih-siswa").val();
                d.tgl_awal = $('#tgl_awal').val();
                d.tgl_akhir = $('#tgl_akhir').val();
            },
        },
        // drawCallback: function (response) {
        //     console.log(response.cek);
        // },
        columns: [
            {
                data: null,
                orderable: false,
                render: function (data, type, row, meta) {
                    var pageInfo = $("#table-tabungan-sukarela").DataTable().page.info();
                    var index = meta.row + pageInfo.start + 1;
                    return index;
                },
            },
            {
                data: "tanggal",
            },
            {
                data: "nama",
            },
            {
                data: "masuk",
            },
            {
                data: "keluar",
            },
            {
                data: "action",
                orderable: true,
                searchable: true,
            },
        ],
        columnDefs: [
            {
                targets: [3], // index kolom atau sel yang ingin diatur
                className: "text-center", // kelas CSS untuk memposisikan isi ke tengah
            },
            {
                searchable: false,
                orderable: false,
                targets: 0, // Kolom nomor, dimulai dari 0
            },
        ],
    });
    let table2 = $("#table-tabungan-wajib").DataTable({
        responsive: true,
        responsive: !0,
        language: {
            paginate: {
                previous: "<i class='ri-arrow-left-s-line'>",
                next: "<i class='ri-arrow-right-s-line'>",
            },
        },
        drawCallback: function () {
            $(".dataTables_paginate > .pagination").addClass(
                "pagination-rounded"
            );
        },
        autoWidth: false,
        serverSide: true,
        ajax: {
            url: "/dataTableWajib",
            type: "GET",
            data: function (d) {
                // 5 = 1 + 4
                // Hamni { nama, umur, alamat, ttl }
                d.unique_student = $("#pilih-siswa").val();
                d.tgl_awal = $('#tgl_awal').val();
                d.tgl_akhir = $('#tgl_akhir').val();
            },
        },
        columns: [
            {
                data: null,
                orderable: false,
                render: function (data, type, row, meta) {
                    var pageInfo = $("#table-tabungan-sukarela").DataTable().page.info();
                    var index = meta.row + pageInfo.start + 1;
                    return index;
                },
            },
            {
                data: "tanggal",
            },
            {
                data: "nama",
            },
            {
                data: "masuk",
            },
            {
                data: "keluar",
            },
            {
                data: "action",
                orderable: true,
                searchable: true,
            },
        ],
        columnDefs: [
            {
                targets: [3], // index kolom atau sel yang ingin diatur
                className: "text-center", // kelas CSS untuk memposisikan isi ke tengah
            },
            {
                searchable: false,
                orderable: false,
                targets: 0, // Kolom nomor, dimulai dari 0
            },
        ],
    });
    let table3 = $("#table-tabungan-transport").DataTable({
        responsive: true,
        responsive: !0,
        language: {
            paginate: {
                previous: "<i class='ri-arrow-left-s-line'>",
                next: "<i class='ri-arrow-right-s-line'>",
            },
        },
        drawCallback: function () {
            $(".dataTables_paginate > .pagination").addClass(
                "pagination-rounded"
            );
        },
        autoWidth: false,
        serverSide: true,
        ajax: {
            url: "/dataTableTransport",
            type: "GET",
            data: function (d) {
                // 5 = 1 + 4
                // Hamni { nama, umur, alamat, ttl }
                d.unique_student = $("#pilih-siswa").val();
                d.tgl_awal = $('#tgl_awal').val();
                d.tgl_akhir = $('#tgl_akhir').val();
            },
        },
        columns: [
            {
                data: null,
                orderable: false,
                render: function (data, type, row, meta) {
                    var pageInfo = $("#table-tabungan-transport").DataTable().page.info();
                    var index = meta.row + pageInfo.start + 1;
                    return index;
                },
            },
            {
                data: "tanggal",
            },
            {
                data: "nama",
            },
            {
                data: "masuk",
            },
            {
                data: "keluar",
            },
            {
                data: "action",
                orderable: true,
                searchable: true,
            },
        ],
        columnDefs: [
            {
                targets: [3], // index kolom atau sel yang ingin diatur
                className: "text-center", // kelas CSS untuk memposisikan isi ke tengah
            },
            {
                searchable: false,
                orderable: false,
                targets: 0, // Kolom nomor, dimulai dari 0
            },
        ],
    });
    $("#pilih-siswa").on("change", function () {
        table.ajax.reload()
        table2.ajax.reload()
        table3.ajax.reload()
        $.ajax({
            data: { unique_student: $(this).val() },
            url: "/ambilSaldo",
            type: "get",
            dataType: 'json',
            success: function (response) {
                $("#saldo-sukarela").html(response.saldoSukarela);
                $("#saldo-wajib").html(response.saldoWajib);
                $("#saldo-transport").html(response.saldoTransport);
            }
        });
    });
    $("#tgl_awal").on("change", function () {
        table.ajax.reload()
        table2.ajax.reload()
        table3.ajax.reload()
    });
    $("#tgl_akhir").on("change", function () {
        table.ajax.reload()
        table2.ajax.reload()
        table3.ajax.reload()
    });
    // Ketika button tambah tabung di klik
    $("#btn-add-data").on("click", function () {
        $("#title-modal").html("Tambah Transaksi");
        $("#btn-action").html(`<button type="button" class="btn btn-primary" id="tambah-data">Tambah</button>`)
        $("#modal-tabungan-siswa").modal("show");
    })
    // KETIKA TOMBOL TAMBAH DI KLIK
    $("#modal-tabungan-siswa").on("click", "#tambah-data", function () {
        let form = $("form[id='form-nabung']").serialize();

        $.ajax({
            data: form,
            url: "/tambahDataNabung",
            type: "POST",
            dataType: 'json',
            success: function (response) {
                // logikanya menage tampilan jika 1. ada yang tidak tervalidasi(errors) 2. jika success menyimpan data 
                if (response.errors) {
                    displayErrors(response.errors);
                } else if (response.success) {
                    table.ajax.reload()
                    table2.ajax.reload()
                    table3.ajax.reload()
                    $("#unique_student").val("")
                    $("#jenis_tabungan").val("")
                    $("#tanggal").val("")
                    $("#masuk").val(0)
                    $("#keluar").val(0)
                    $("#modal-tabungan-siswa").modal("hide");
                    Swal.fire("Succes!", response.success, "success");
                } else if (response.kurang) {
                    Swal.fire("Warning!", response.kurang, "warning");
                }
            }
        });
    })

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
                inputElement.after(feedbackElement);
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
                selectElement.on("change", function () {
                    $(this).removeClass("is-invalid");
                });
            });
        });
    }

});