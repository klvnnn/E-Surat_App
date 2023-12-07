<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Letter;
use App\Models\Letterin;

class DashboardController extends Controller
{
    public function index()
    {
        $masuk = Letterin::where('letter_type', 'Surat Masuk')->get()->count();
        $keluar = Letter::where('letter_type', 'Surat Keluar')->get()->count();

        return view('pages.admin.dashboard',[
            'masuk' => $masuk,
            'keluar' => $keluar
        ]);
    }
}
