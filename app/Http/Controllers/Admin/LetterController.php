<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Letter;
use Illuminate\Support\Facades\Storage;

class LetterController extends Controller
{

    public function index()
    {
        //
    }

    public function keluar()
    {
        $item = Letter::get();
        $ambil = Letter::all()->where('letter_type', 'Surat Keluar')->last();
        $cek = Letter::all()->where('letter_type', 'Surat Keluar')->count();
        if ($cek == 0) {
            $urut = 1;
            $angkaFormatted = str_pad($urut, 3, '0', STR_PAD_LEFT);
        } else {
            $urut = (int)substr($ambil->letter_no, -4) + 1;
            $angkaFormatted = str_pad($urut, 3, '0', STR_PAD_LEFT);
        }

        return view('pages.admin.letter.create-keluar', ['item' => $item], compact('urut', 'angkaFormatted'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'letter_date' => 'required',
            'letter_no' => 'required',
            'letter_code' => '',
            'letter_unit' => '',
            'pertalian' => '',
            'regarding' => 'required',
            'department' => 'required',
            'letter_type' => 'required',
        ]);

        if ($validatedData['letter_type'] == 'Surat Masuk') {
            $redirect = 'surat-masuk';
        } else {
            $redirect = 'surat-keluar';
        }

        Letter::create($validatedData);

        return redirect()
            ->route($redirect)
            ->with('success', 'Sukses! 1 Data Berhasil Disimpan');
    }

    public function outgoing_mail()
    {

        $item = Letter::where('letter_type', 'Surat Keluar')->latest()->get();

        return view('pages.admin.letter.outgoing', [
            'item' => $item,
        ]);
    }

    public function show($id)
    {
        $item = Letter::findOrFail($id);

        return view('pages.admin.letter.show', [
            'item' => $item,
        ]);
    }

    public function edit($id)
    {
        $items = Letter::where('letter_type', 'Surat Keluar')->get();
        $item = Letter::findOrFail($id);

        return view('pages.admin.letter.edit', [
            'item' => $item,
        ], compact('items'));
    }

    public function update(Request $request, $id)
    {

        $validatedData = $request->validate([
            'letter_no' => 'required',
            'letter_code' => '',
            'letter_unit' => '',
            'forward' => '',
            'pertalian' => '',
            'letter_date' => 'required',
            'regarding' => 'required',
            'department' => 'required',
            'letter_type' => 'required',
            'letter_file' => 'mimes:jpeg,png,jpg,pdf|file',
        ]);

        $item = Letter::findOrFail($id);

        if($request->file('letter_file')){
            $filename1 = time() .'.'. $request->letter_file->extension();
            $validatedData['letter_file'] = Storage::putFileAs('public/letter-file', $request->letter_file, $filename1);
        }

        // if ($validatedData['letter_type'] == 'Surat Masuk'){
        //     if($request->file('letter_disposisi')){
        //         $filename2 = time() .'.'. $request->letter_disposisi->extension();
        //         $validatedData['letter_disposisi'] = Storage::putFileAs('public/letter-disposisi', $request->letter_disposisi, $filename2);
        //     }
        // }

        if ($validatedData['letter_type'] == 'Surat Masuk') {
            $redirect = 'surat-masuk';
        } else {
            $redirect = 'surat-keluar';
        }

        $item->update($validatedData);
        if ($request->hasFile('letter_file')) {
            if ($validatedData['letter_type'] == 'Surat Keluar'){
            Letter::where('id', $id)->update([
                'letter_file' => $filename1,
            ]);
            }
        }

        return redirect()
            ->route($redirect)
            ->with('success', 'Sukses! 1 Data Berhasil Diubah');
    }

    public function destroy(Request $request)
    {
        $item = Letter::findorFail($request->deleteOut_id);

        if ($item->letter_type == 'Surat Masuk') {
            $redirect = 'surat-masuk';
        } else {
            $redirect = 'surat-keluar';
        }

        Storage::delete($item->letter_file);

        $item->delete();

        return redirect()
            ->route($redirect)
            ->with('success', 'Sukses! 1 Data Berhasil Dihapus');
    }

    public function reset_out()
    {
        $cek = Letter::count();
        if ($cek == 0) {
            return redirect()->back()
                ->with('warning', 'Data Masih Kosong! Inputkan Data terlebih dahulu');
        } else {
            Letter::truncate();
            return redirect()->back()
                ->with('success', 'Data Telah di reset, inputkan data baru! Selamat Bekerja');
        }
    }
}
