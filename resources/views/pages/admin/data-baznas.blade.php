<x-app-layout>
    <div class="container-fluid">
        <x-divider-root nama="Data Baznas Page" root="Data Baznas" url="{{ route('baznas') }}" />
        <!-- row -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('baznas.buat') }}" class="btn btn-primary">Tambah Data Baznas</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example5" class="display" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No Surat</th>
                                        <th>Tanggal Surat</th>
                                        <th>Biodata</th>
                                        <th>Keterangan</th>
                                        {{-- <th>Denda Layanan Rumah Sakit</th> --}}
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($baznas as $no => $row)
                                        <tr>
                                            <td>{{ $no++ + 1 }}</td>
                                            <td>{{ $row->no_surat }}</td>
                                            <td>{{ $row->tgl_surat }}</td>
                                            <td>
                                                <b>Nama</b> : {{ $row->nama }} <br>
                                                <b>Tanggal Lahir</b> :
                                                {{ $row->tgl_lahir }} <br>
                                                <b>Alamat</b> : {{ $row->alamat }}, RT {{ $row->rt }}/RW
                                                {{ $row->rw }} <br>
                                                <b>Kelurahan</b> : {{ $row->kelurahan }} <br>
                                            </td>
                                            <td>
                                                {{ $row->ket }}
                                            </td>
                                            {{-- <td>
                                                {{ $row->denda_layanan }}
                                            </td> --}}
                                            <td>
                                                <a href="{{ route('baznas.cetak', ['id' => $row->id]) }}" target="_blank" class="btn btn-warning text-white">Cetak</a>
                                                <a href="{{ route('baznas.edit', ['id' => $row->id]) }}"
                                                    class="btn btn-primary my-2">Edit</a>
                                                <form action="{{ route('baznas.destroy', ['id' => $row->id]) }}" method="POST">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Aapakah anda yakin untuk menghapus data?')">Hapus</button>
                                                </form>
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
