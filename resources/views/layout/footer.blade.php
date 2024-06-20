<!--   Core JS Files   -->
<script src="{{ asset ('azzara/assets/js/core/jquery.3.2.1.min.js')}}"></script>
<script src="{{ asset ('azzara/assets/js/core/popper.min.js')}}"></script>
<script src="{{ asset ('azzara/assets/js/core/bootstrap.min.js')}}"></script>

<!-- jQuery UI -->
<script src="{{ asset ('azzara/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js')}}"></script>
<script src="{{ asset ('azzara/assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js')}}"></script>

<!-- jQuery Scrollbar -->
<script src="{{ asset ('azzara/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js')}}"></script>

<!-- Moment JS -->
<script src="{{ asset ('azzara/assets/js/plugin/moment/moment.min.js')}}"></script>

<!-- Chart JS -->
<script src="{{ asset ('azzara/assets/js/plugin/chart.js/chart.min.js')}}"></script>

<!-- jQuery Sparkline -->
<script src="{{ asset ('azzara/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js')}}"></script>

<!-- Chart Circle -->
<script src="{{ asset ('azzara/assets/js/plugin/chart-circle/circles.min.js')}}"></script>

<!-- Datatables -->
<script src="{{ asset ('azzara/assets/js/plugin/datatables/datatables.min.js')}}"></script>

<!-- Bootstrap Notify -->
<script src="{{ asset ('azzara/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js')}}"></script>

<!-- Bootstrap Toggle -->
<script src="{{ asset ('azzara/assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js')}}"></script>

<!-- jQuery Vector Maps -->
<script src="{{ asset ('azzara/assets/js/plugin/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{ asset ('azzara/assets/js/plugin/jqvmap/maps/jquery.vmap.world.js')}}"></script>

<!-- Google Maps Plugin -->
<script src="{{ asset ('azzara/assets/js/plugin/gmaps/gmaps.js')}}"></script>

<!-- Sweet Alert -->
<script src="{{ asset ('azzara/assets/js/plugin/sweetalert/sweetalert.min.js')}}"></script>

<!-- Azzara JS -->
<script src="{{ asset ('azzara/assets/js/ready.min.js')}}"></script>

<!-- Azzara DEMO methods, don't include it in your project! -->
<script src="{{ asset ('azzara/assets/js/setting-demo.js')}}"></script>
<script src="{{ asset ('azzara/assets/js/demo.js')}}"></script>

<!-- datatables -->
<script >
    $(document).ready(function() {
        $('#basic-datatables').DataTable({
        });

        $('#multi-filter-select').DataTable( {
            "pageLength": 5,
            initComplete: function () {
                this.api().columns().every( function () {
                    var column = this;
                    var select = $('<select class="form-control"><option value=""></option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                            );

                        column
                        .search( val ? '^'+val+'$' : '', true, false )
                        .draw();
                    } );

                    column.data().unique().sort().each( function ( d, j ) {
                        select.append( '<option value="'+d+'">'+d+'</option>' )
                    } );
                } );
            }
        });

        // Add Row
        $('#add-row').DataTable({
            "pageLength": 5,
        });

        var action = '<td> <div class="form-button-action"> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

        $('#addRowButton').click(function() {
            $('#add-row').dataTable().fnAddData([
                $("#addNama").val(),
                $("#addEmail").val(),
                $("#addOrganisasi").val(),
                action
                ]);
            $('#addRowModal').modal('hide');

        });
    });
</script>

<script>
    $('#logoutModal').on('shown.bs.modal', function () {
        $('#logoutConfirmBtn').focus(); // Fokus pada tombol "Logout" saat modal ditampilkan
    });
</script>

<!-- Search box -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('search-input');

        searchInput.addEventListener('input', function() {
            const keyword = searchInput.value.trim().toLowerCase();
            const searchResults = document.getElementById('search-results');
            const cards = searchResults.getElementsByClassName('col-sm-6 col-lg-3');

            for (let i = 0; i < cards.length; i++) {
                const card = cards[i];
                const cardBody = card.getElementsByClassName('card-body')[0];
                const cardText = cardBody.innerText.toLowerCase();

                if (cardText.includes(keyword)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            }
        });
    });
</script>

<!-- Sweet Alert -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.deleteButton');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function (event) {
                event.preventDefault();
                const form = button.closest('form');
                const itemName = button.closest('tr').querySelector('td:nth-child(2)').textContent;

                swal({
                    title: 'Apakah Anda yakin?',
                    text: `Anda tidak akan bisa mengembalikan data ini!`,
                    icon: 'warning',
                    buttons: {
                        cancel: {
                            text: 'Tidak, batalkan!',
                            visible: true,
                            className: 'btn btn-success'
                        },
                        confirm: {
                            text: 'Ya, hapus!',
                            className: 'btn btn-danger'
                        }
                    }
                }).then((willDelete) => {
                    if (willDelete) {
                        swal("Data Berhasil Dihapus!", {
                            icon: "success",
                            buttons : {
                                confirm : {
                                    className: 'btn btn-success'
                                }
                            }
                        }).then(() => {
                            form.submit();
                        });
                    } else {
                        swal("Data Anda aman!", {
                            icon: "info",
                            buttons: {
                                confirm: {
                                    className: 'btn btn-success'
                                }
                            }
                        });
                    }
                });
            });
        });
    });
</script>

</body>
</html>
