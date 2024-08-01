<x-app-layout>
    <div class="container-fluid">
        <x-divider-root nama="Data Rumah Sakit Page" root="Data Rumah Sakit" url="{{ route('data-rumahSakit') }}" />
        <!-- row -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('data-rumahSakit.buat') }}" class="btn btn-primary">Tambah Rumah Sakit</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example5" class="display" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                        <th>Kelas</th>
                                        <th>Strata</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($rumahsakit as $no => $row)
                                        <tr>
                                            <td>{{ $no++ + 1 }}</td>
                                            <td>{{ $row->nama }}</td>
                                            <td>{{ $row->alamat }}</td>
                                            <td>{{ $row->kelas }}</td>
                                            <td>{{ $row->starta }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="{{ route('data-rumahSakit.edit', ['id' => $row->kode]) }}"
                                                        class="btn btn-primary shadow btn-xs sharp mr-1"><i
                                                            class="fa fa-pencil"></i></a>
                                                    <form
                                                        action="{{ route('data-rumahSakit.destroy', ['id' => $row->kode]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" onclick="return confirm('Apakah anda yakin untuk menghapus data?')"
                                                            class="btn btn-danger shadow btn-xs sharp"><i
                                                                class="fa fa-trash"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('before-styles')
        <!-- Datatable -->
        <link href="{{ asset('assets/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    @endpush

    @push('after-scripts')
        <!-- Datatable -->
        <script src="{{ asset('assets/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
        <script>
            (function($) {
                "use strict"
                //example 1
                var table = $('#example').DataTable({
                    createdRow: function(row, data, index) {
                        $(row).addClass('selected')
                    }
                });

                table.on('click', 'tbody tr', function() {
                    var $row = table.row(this).nodes().to$();
                    var hasClass = $row.hasClass('selected');
                    if (hasClass) {
                        $row.removeClass('selected')
                    } else {
                        $row.addClass('selected')
                    }
                })

                table.rows().every(function() {
                    this.nodes().to$().removeClass('selected')
                });



                //example 2
                var table2 = $('#example2').DataTable({
                    createdRow: function(row, data, index) {
                        $(row).addClass('selected')
                    },

                    "scrollY": "42vh",
                    "scrollCollapse": true,
                    "paging": false
                });

                table2.on('click', 'tbody tr', function() {
                    var $row = table2.row(this).nodes().to$();
                    var hasClass = $row.hasClass('selected');
                    if (hasClass) {
                        $row.removeClass('selected')
                    } else {
                        $row.addClass('selected')
                    }
                })

                table2.rows().every(function() {
                    this.nodes().to$().removeClass('selected')
                });

                //
                var table = $('#example3, #example4, #example5').DataTable();
                $('#example tbody').on('click', 'tr', function() {
                    var data = table.row(this).data();
                });

            })(jQuery);
        </script>
    @endpush
</x-app-layout>
