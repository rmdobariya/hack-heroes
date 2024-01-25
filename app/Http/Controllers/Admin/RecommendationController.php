<?php

namespace App\Http\Controllers\Admin;


use App\Helpers\CatchCreateHelper;
use App\Helpers\ImageUploadHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RecommendationUpdateStoreRequest;
use App\Imports\RecommendationDataImport;
use App\Jobs\RecommendationJob;
use App\Models\PageTranslation;
use App\Models\Recommendation;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\Admin\PageStoreRequest;
use Illuminate\Http\Request;
use App\Models\Page;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use App\Helpers\AdminDataTableButtonHelper;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class RecommendationController extends Controller
{
//    function __construct()
//    {
//        $this->middleware('permission:page-read|page-create|page-update|page-delete', ['only' => ['index']]);
//        $this->middleware('permission:page-create', ['only' => ['create', 'store']]);
//        $this->middleware('permission:page-update', ['only' => ['edit', 'update']]);
//        $this->middleware('permission:page-delete', ['only' => ['destroy']]);
//    }
    public function index()
    {
        return view('admin.recommendation.index');
    }

    public function create()
    {
        return view('admin.recommendation.create');
    }

    public function store(RecommendationUpdateStoreRequest $request): JsonResponse
    {
//        if ((int)$request['edit_value'] === 0) {
//            ini_set('memory_limit', '-1');
//            $excelData = Excel::toArray(new RecommendationDataImport, $request->excel_file);
//            $chunks = array_chunk($excelData[0], 170);
//            foreach ($chunks as $chunk) {
//                unset($chunk[0]);
//                dispatch(new RecommendationJob($chunk));
//            }
//            return response()->json([
//                'message' => 'Recommendation Add Successfully'
//            ]);
//
//        } else {
        $recommendation = Recommendation::find($request['edit_value']);
        $image = $recommendation->image;
        $pdf = $recommendation->pdf;
        if ($request->hasfile('image')) {
            $image = ImageUploadHelper::imageUpload($request->file('image'), 'assets/web/recommendation');
        }
        if ($request->hasfile('pdf')) {
            $pdf = ImageUploadHelper::imageUpload($request->file('pdf'), 'assets/web/recommendation/pdf');
        }
        $validationRules = [
            'pdf' => ($pdf === null) ? 'required|mimes:pdf' : 'sometimes|mimes:pdf',
        ];

        $request->validate($validationRules);
        $recommendation->recommendation_type = $request['recommendation_type'];
        $recommendation->title_for_recommendation = $request['title_for_recommendation'];
        $recommendation->sub_text_for_recommendation = $request['sub_text_for_recommendation'];
        $recommendation->recommendation = $request['recommendation'];
        $recommendation->tags_for_associated_risk = $request['tags_for_associated_risk'];
        $recommendation->reasoning = $request['reasoning'];
        $recommendation->tags_for_age_appropriateness = $request['tags_for_age_appropriateness'];
        $recommendation->tag_for_frequency = $request['tag_for_frequency'];
        $recommendation->tag_if_affiliate = $request['tag_if_affiliate'];
        $recommendation->tag_if_resource = $request['tag_if_resource'];
        $recommendation->tags_for_visual_grouping = $request['tags_for_visual_grouping'];
        $recommendation->image = $image;
        $recommendation->pdf = $pdf;
        $recommendation->save();

        return response()->json([
            'message' => 'Recommendation Update Successfully'
        ]);
//        }
    }

    public function edit($id)
    {
        $recommendation = Recommendation::findOrFail($id);
        return view('admin.recommendation.edit', [
            'recommendation' => $recommendation,
        ]);
    }

    public
    function destroy($id): JsonResponse
    {
        Recommendation::where('id', $id)->delete();
        return response()->json([
            'message' => 'Recommendation Delete Successfully'
        ]);
    }

    public
    function getRecommendationList(Request $request)
    {
        if ($request->ajax()) {
            $recommendations = DB::table('recommendations')
                ->orderBy('id', 'desc')
                ->select('recommendations.*');
            if (!empty($request->status) && $request->status !== 'all') {
                $recommendations->where('recommendations.status', $request->status);
            }
            return Datatables::of($recommendations)
                ->addColumn('action', function ($recommendations) {
                    $array = [
                        'id' => $recommendations->id,
                        'actions' => [
                            'edit' => route('admin.recommendation.edit', [$recommendations->id]),
                            'detail-page' => route('admin.recommendation.show', $recommendations->id),
//                            'delete' => $recommendations->id,
//                            'status' => $recommendations->status,
                        ]
                    ];
                    return AdminDataTableButtonHelper::actionButtonDropdown($array);
                })
                ->addColumn('status', function ($recommendations) {
                    $array['status'] = $recommendations->status;
                    return AdminDataTableButtonHelper::statusBadge($array);
                })
//                ->addColumn('check', function ($vehicle) {
//
//                    return '<td>
//                    <div class="form-check form-check-sm form-check-custom form-check-solid">
//                        <input class="form-check-input all_selected" type="checkbox" value=' . $vehicle->id . ' id="single_select">
//                    </div>
//                </td>';
//                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
    }

    public function show($id)
    {
        $recommendation = DB::table('recommendations')->where('id', $id)->first();
        return view('admin.recommendation.show', ['recommendation' => $recommendation]);
    }
}
