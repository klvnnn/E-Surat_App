<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Letter;
use App\Models\Letterin;

class PrintController extends Controller
{
    public function index()
    {
        $item = Letterin::get();

        return view('pages.admin.letter.print-incoming', [
            'item' => $item
        ]);
    }

    public function outgoing()
    {
        $item = Letter::get();

        return view('pages.admin.letter.print-outgoing', [
            'item' => $item
        ]);
    }

    public function disposisi($id)
    {
        $item = Letterin::findOrFail($id);
        $cek = Letterin::count();
        if ($cek == 0) {
            $urut = 1;
            $agenda = str_pad($urut, 3, '0', STR_PAD_LEFT);
        } else {
            $urut = (int)substr($item->id, -4);
            $agenda = str_pad($urut, 3, '0', STR_PAD_LEFT);
        }
        return view('pages.admin.letter.print-disposisi', [
            'item' => $item
        ], compact('urut','agenda'));
    }
}
