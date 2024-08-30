<x-app-layout>
    <div class="container-fluid">
        <x-divider-root nama="Nomor SKTM Berjalan" root="Nomor SKTM Berjalan" url="{{ route('data-sktm') }}" />

        <div class="row">
            <div class="col-12">
                <div class="card">
                    {{-- @dd($sktm) --}}
                    @if ($sktm->isNotEmpty())
                    <div class="card-header">
                        <h3>Nomor SKTM</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example5" class="display" style="min-width: 350px; font-size: 20px">
                                <tr>
                                    <td>Nomor SKTM : </td>
                                    {{-- <td>:</td> --}}
                                    <td><input type="text" value="{{ $sktm->first()->no_sktm }}" disabled></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    @else
                    <div class="card-header">
                        <h3>Input Nomor SKTM</h3>
                    </div>
                    <div class="card-body">
                        <form class="needs-validation" novalidate="" action="{{ route('data-sktm.tambah') }}"
                            method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="firstName">Nomor SKTM</label>
                                <input type="text" name="no_sktm"
                                    class="form-control @error('no_sktm') is-invalid @enderror" id="firstkode"
                                    placeholder="">
                                @error('no_sktm')
                                <div class="invalid-feedback" style="width: 100%;">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <hr class="mb-4">

                            <div class="d-flex">
                                <button class="btn btn-primary btn-lg btn-block" type="submit">Simpan</button>
                            </div>
                        </form>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>