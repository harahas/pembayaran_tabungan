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

});