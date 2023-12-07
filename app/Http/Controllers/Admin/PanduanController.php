<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Panduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PanduanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $item = Panduan::get();

        return view('pages.admin.letter.panduan', [
            'item' => $item
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.letter.create-panduan');
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
            'title' => 'required|max:255',
            'file' => 'mimes:pdf|file',
        ]);

        $panduan = time() . '.' . $request->file->extension();
        $validatedData['file'] = Storage::putFileAs('public/letter-panduan', $request->file, $panduan);

        Panduan::create([
            'title' => $request->title,
            'file' => $panduan,
        ]);
        // Panduan::create($validatedData);
        // if ($request->hasFile('file')) {
        //     Panduan::create([
        //         'file' => $panduan,
        //     ]);
        // }

        return redirect()
            ->route('panduan')
            ->with('success', 'Sukses! 1 Data Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Panduan::findOrFail($id);

        return view('pages.admin.letter.edit-panduan', [
            'item' => $item,
        ]);
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
            'title' => 'required|max:255',
            'file' => 'mimes:pdf|file',
        ]);

        if ($request->hasFile('file')) {
            $old_file = Panduan::find($id)->file;
            Storage::delete('public/letter-panduan' . $old_file);

            // FILE BARU //
            // ubah nama file gambar baru dengan angka random
            $panduan = time() . '.' . $request->file->extension();
            $validatedData['file'] = Storage::putFileAs('public/letter-panduan', $request->file, $panduan);

            // update data sliders
            Panduan::where('id', $id)->update([
                'title' => $request->title,
                'file' => $panduan,
            ]);
        } else {
            // jika user tidak mengupload gambar
            // update data sliders hnaya untuk title dan caption
            Panduan::where('id', $id)->update([
                'title' => $request->title,
            ]);
        }
        return redirect()
        ->route('panduan')
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
        $item = Panduan::find($request->deletePanduan_id);
        Storage::delete($item->letter_panduan);
        $item->delete();

        return redirect()
            ->route('panduan')
            ->with('success', 'Sukses! 1 Data Berhasil Dihapus');
    }
}
