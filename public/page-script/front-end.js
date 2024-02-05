const modal = document.querySelector('.modal');
const bayar = document.querySelector('.bayar');
const hide = document.querySelector('#hide');
const element = document.querySelector('#element_tagihan').value;
const render = document.querySelector('#render_tagihan');
bayar.addEventListener('click', function (e) {
    modal.classList.add('modal-open');
})
hide.addEventListener('click', function (e) {
    modal.classList.remove('modal-open');
})
// modal.addEventListener('click', function (e) {
//     if (e.target.classList.value != 'modal-bayar') {

//         modal.classList.remove('modal-open');
//     }
// })
render.innerHTML = element
$(document).ready(function () {
    $(".list-tagihan").on("click", ".kartu", function () {

        let unique_student = $(this).data("unique_student");
        let unique_tahun_ajaran = $(this).data("unique_tahun_ajaran");
        let unique_kelas = $(this).data("unique_kelas");
        let unique_generate = $(this).data("unique_generate");
        let periode = $(this).data("periode");
        let unique_jenis_pembayaran = $(this).data("unique_jenis_pembayaran");
        let csrf = $(this).data("csrf");
        if (periode == 'SEKALI BAYAR') {
            $(".render-loader").html(loader)
            $.ajax({
                data: {
                    _token: csrf,
                    unique_student: unique_student,
                    unique_tahun_ajaran: unique_tahun_ajaran,
                    unique_kelas: unique_kelas,
                    unique_generate: unique_generate,
                    periode: periode,
                    unique_jenis_pembayaran: unique_jenis_pembayaran
                },
                url: "/bayarDenganTabungan",
                type: "POST",
                dataType: 'json',
                success: function (response) {
                    document.location.reload();
                }
            });
        } else {
            Swal.fire({
                title: "Masukan berapa bulan yang ingin dibayar!",
                input: "text",
                inputAttributes: {
                    autocapitalize: "off"
                },
                showCancelButton: true,
                confirmButtonText: "Bayar",
                showLoaderOnConfirm: true,
                preConfirm: async (jumlah) => {
                    try {
                        $(".render-loader").html(loader)
                        $.ajax({
                            data: {
                                _token: csrf,
                                unique_student: unique_student,
                                unique_tahun_ajaran: unique_tahun_ajaran,
                                unique_kelas: unique_kelas,
                                unique_generate: unique_generate,
                                periode: periode,
                                unique_jenis_pembayaran: unique_jenis_pembayaran,
                                jumlah: parseInt(jumlah)
                            },
                            url: "/bayarDenganTabunganBerjangka",
                            type: "POST",
                            dataType: 'json',
                            success: function (response) {
                                // console.log(response);
                                document.location.reload();
                            }
                        });
                    } catch (error) {
                        Swal.showValidationMessage(`
                      Request failed: ${error}
                    `);
                    }
                },
                allowOutsideClick: () => !Swal.isLoading()
            })
        }

    })

})
