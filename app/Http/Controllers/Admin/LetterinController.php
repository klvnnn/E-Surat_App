<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Letterin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LetterinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $item = Letterin::get();
        return view('pages.admin.letter.create-masuk',['item' => $item]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'letter_date' => 'required',
            'letter_no' => 'required',
            'forward' => '',
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

        Letterin::create($validatedData);

        return redirect()
            ->route($redirect)
            ->with('success', 'Sukses! 1 Data Berhasil Disimpan');
    }

    public function incoming_mail()
    {
        $item = Letterin::where('letter_type', 'Surat Masuk')->latest()->get();

        return view('pages.admin.letter.incoming', ['item' => $item]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Letterin::findOrFail($id);
        $cek = Letterin::count();
        if ($cek == 0) {
            $urut = 1;
            $agendaMasuk = str_pad($urut, 3, '0', STR_PAD_LEFT);
        } else {
            $urut = (int)substr($item->id, -4);
            $agendaMasuk = str_pad($urut, 3, '0', STR_PAD_LEFT);
        }
        return view('pages.admin.letter.show', [
            'item' => $item,
        ], compact('urut', 'agendaMasuk'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $items = Letterin::where('letter_type', 'Surat Masuk')->get();
        $item = Letterin::findOrFail($id);

        return view('pages.admin.letter.edit', [
            'item' => $item,
        ], compact('items'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $validatedData = $request->validate([
            'letter_no' => 'required',
            'forward' => '',
            'pertalian' => '',
            'letter_date' => 'required',
            'regarding' => 'required',
            'department' => 'required',
            'letter_type' => 'required',
            'letter_file' => 'mimes:jpeg,png,jpg,pdf|file',
            'letter_disposisi' => 'mimes:jpeg,png,jpg,pdf|file',
        ]);

        $item = Letterin::findOrFail($id);

        if($request->file('letter_file')){
            $filename1 = time() .'.'. $request->letter_file->extension();
            $validatedData['letter_file'] = Storage::putFileAs('public/letter-file', $request->letter_file, $filename1);
            // $validatedData['letter_file'] = $request->file('letter_file')->store('public/letter-file');
        }

        if ($validatedData['letter_type'] == 'Surat Masuk'){
            if($request->file('letter_disposisi')){
                $filename2 = time() .'.'. $request->letter_disposisi->extension();
                $validatedData['letter_disposisi'] = Storage::putFileAs('public/letter-disposisi', $request->letter_disposisi, $filename2);
            }
        }

        if ($validatedData['letter_type'] == 'Surat Masuk') {
            $redirect = 'surat-masuk';
        } else {
            $redirect = 'surat-keluar';
        }

        $item->update($validatedData);
        if ($request->hasFile('letter_file')) {
            if ($validatedData['letter_type'] == 'Surat Masuk'){
            Letterin::where('id', $id)->update([
                'letter_file' => $filename1,
            ]);
            }
        }
        if ($request->hasFile('letter_disposisi')) {
            if ($validatedData['letter_type'] == 'Surat Masuk'){
            Letterin::where('id', $id)->update([
                'letter_disposisi' => $filename2,
            ]);
            } 
        }

        return redirect()
            ->route($redirect)
            ->with('success', 'Sukses! 1 Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $item = Letterin::find($request->delete_id);

        if ($item->letter_type == 'Surat Masuk') {
            $redirect = 'surat-masuk';
        } else {
            $redirect = 'surat-keluar';
        }

        Storage::delete($item->letter_file);
        Storage::delete($item->letter_disposisi);

        $item->delete();

        return redirect()
            ->route($redirect)
            ->with('success', 'Sukses! 1 Data Berhasil Dihapus');
    }

    public function reset_in()
    {
        $cek = Letterin::count();
        if ($cek == 0) {
            return redirect()->back()
                ->with('warning', 'Data Masih Kosong! Inputkan Data terlebih dahulu');
        } else {
            Letterin::truncate();
            return redirect()->back()
                ->with('success', 'Data Telah di reset, inputkan data baru! Selamat Bekerja');
        }
    }
}
