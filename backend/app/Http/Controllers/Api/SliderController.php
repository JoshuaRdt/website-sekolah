<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    $sliders = Slider::where('aktif', true)
                        ->orderBy('urutan', 'asc')
                        ->get();

        return response()->json([
            'status' => 'success',
            'data' => $sliders
        ]);
    }
}
