<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Competency;
use Illuminate\Http\Request;

class CompetencyController extends Controller
{
    // Mengambil kompetensi beserta materi pembelajarannya
    public function index()
    {
        // ->with('learningMaterials') akan mengambil data materi sekaligus (Eager Loading)
        $competencies = Competency::where('aktif', true)
                                ->with('learningMaterials')
                                ->get();

        return response()->json([
            'status' => 'success',
            'data' => $competencies
        ]);
    }
}
