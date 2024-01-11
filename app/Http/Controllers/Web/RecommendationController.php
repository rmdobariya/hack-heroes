<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RecommendationController extends Controller
{
    public function index($id,$child_id)
    {
        $user = Auth::guard('web')->user();
        $recommendation = DB::table('recommendations')->where('id', $id)->first();
        return view('website.recommendation.index', [
            'user' => $user,
            'recommendation' => $recommendation,
            'child_id' => $child_id,
        ]);
    }
}
