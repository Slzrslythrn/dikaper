<?php

namespace App\Http\Controllers;

use App\Helpers\Log;
use App\Models\Baznas;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use PDF;

class BaznasController extends Controller
{
    public function index()
    {
        $baznas = Baznas::orderBy('no_surat', 'desc')->get();
        return view('pages.admin.data-baznas', compact('baznas'));
    }

    public function buat()
    {
        $lastRecord = Baznas::orderBy('id', 'desc')->first(); // Assuming `id` is auto-incremented

    if ($lastRecord && preg_match('/460\/(\d{3})\/R\/B/', $lastRecord->kode, $matches)) {
        $lastNumber = intval($matches[1]);
        $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
    } else {
        $newNumber = '012'; // Starting point if no records found
    }

    // Construct the new code
    $newCode = "460/{$newNumber}/R/B";
        return view('pages.admin.baznas.buat', compact('newCode'));
    }

    private function validateRequest(Request $request): array
    {
        return $request->validate([
            'no_surat' => ['required'],
            'tgl_surat' => ['required'],
            'tunggakan_bpjs' => ['required'],
            'denda_layanan' => ['required'],
            'nama' => ['required'],
            'tgl_lahir' => ['required'],
            'alamat' => ['required'],
            'rt' => ['required'],
            'rw' => ['required'],
            'kelurahan' => ['required'],
            'ket' => ['required'],
        ], [
            'no_surat.required' => 'Harap Menginputkan Data',
            'tgl_surat.required' => 'Harap Menginputkan Data',
            'tunggakan_bpjs.required' => 'Harap Menginputkan Data',
            'denda_layanan.required' => 'Harap Menginputkan Data',
            'nama.required' => 'Harap Menginputkan Data',
            'tgl_lahir.required' => 'Harap Menginputkan Data',
            'alamat.required' => 'Harap Menginputkan Data',
            'rt.required' => 'Harap Menginputkan Data',
            'rw.required' => 'Harap Menginputkan Data',
            'kelurahan.required' => 'Harap Menginputkan Data',
            'ket.required' => 'Harap Menginputkan Data',
        ]);
    }

    public function simpan(Request $request)
{
    // Validate the request
    $validated = $this->validateRequest($request);

    // Attempt to save the validated data
    try {
        $simpan = Baznas::create($validated);

        if ($simpan) {
            Log::logSave('Membuat Data Baznas ' . $request->nama);
            Alert::success('Data Berhasil Dinputkan');
        } else {
            Alert::error('Data Gagal Dinputkan');
        }
    } catch (\Exception $e) {
        // Log the error and show a general error message to the user
        Log::error('Error saving Baznas data: ' . $e->getMessage());
        Alert::error('Terjadi kesalahan, data gagal disimpan.');
    }

    // Redirect to the intended route
    return redirect()->route('pages.admin.data-baznas');
}


    public function edit($id)
    {
        $baznas = Baznas::findOrFail($id);
        return view('pages.admin.baznas.edit', compact('baznas'));
    }

    public function update(Request $request, $id)
    {
        $baznas = Baznas::findOrFail($id);
        $validated = $this->validateRequest($request);

        $update = $baznas->update($validated);

        if ($update) {
            Log::logSave('Mengedit Data Baznas ' . $request->nama);
            Alert::success('Data Berhasil Diedit');
        } else {
            Alert::error('Data Gagal Diedit');
        }

        return redirect()->route('pages.admin.data-baznas');
    }

    public function cetak($id)
    {
        $baznas = Baznas::findOrFail($id);
        $qrcode = base64_encode(QrCode::format('svg')->size(50)->errorCorrection('H')->generate(route('baznas.cetak', ['id' => $id])));
        $data = [
            'date' => date('m/d/Y'),
            'baznas' => $baznas,
            'qrcode' => $qrcode
        ];

        $pdf = PDF::loadView('pages.admin.pdf-baznas', $data);

        return $pdf->stream('baznas.pdf');
    }

    public function destroy($id)
    {
        $baznas = Baznas::findOrFail($id);

        if ($baznas->delete()) {
            Log::logSave('Menghapus Data Baznas ' . $baznas->nama);
            Alert::success('Data Berhasil Dihapus');
        } else {
            Alert::error('Data Gagal Dihapus');
        }

        return redirect()->route('pages.admin.data-baznas');
    }

    public function create()
{
    $nextNoSurat = $this->generateNextNoSurat(); // misal ada metode untuk generate no surat
    return view('pages.admin.baznas.buat', compact('nextNoSurat'));
}


    public function store(Request $request)
    {
        $request->validate([
            'no_surat' => 'required|unique:baznas',
            // other validation rules...
        ]);

        $baznas = new Baznas();
        $baznas->no_surat = $request->input('no_surat');
        // set other fields...
        $baznas->save();

        return redirect()->route('pages.admin.data-baznas')->with('success', 'Baznas created successfully.');
    }

    private function generateNextNoSurat()
{
    // Ambil nomor surat terakhir dari database
    $lastSurat = DB::table('surat')->orderBy('id', 'desc')->first();

    // Jika ada nomor surat terakhir, ekstrak bagian angka, jika tidak mulai dari 1
    if ($lastSurat) {
        // Pecahkan nomor surat menjadi bagian-bagian yang lebih kecil
        $lastNoSurat = $lastSurat->no_surat; // Asumsi format terakhir seperti 460/011/R/B
        $parts = explode('/', $lastNoSurat);
        $lastNumber = (int) $parts[1]; // Ambil bagian angka
    } else {
        $lastNumber = 0;
    }

    // Increment bagian angka
    $nextNumber = $lastNumber + 1;

    // Format nomor surat berikutnya dengan leading zeros untuk angka
    $nextNoSurat = sprintf("460/%03d/R/B", $nextNumber);

    return $nextNoSurat;
}

}
