<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RecommendationController extends Controller
{
    public function index($id, $child_id)
    {
        $user = Auth::guard('web')->user();
        DB::table('dashboard_score')->where('child_id', $child_id)->where('user_id', $user->id)->update([
            'view_recommendations_for' => date('Y-m-d')
        ]);
        $recommendation = DB::table('recommendations')->where('id', $id)->first();
        return view('website.recommendation.index', [
            'user' => $user,
            'recommendation' => $recommendation,
            'child_id' => $child_id,
        ]);
    }
}
