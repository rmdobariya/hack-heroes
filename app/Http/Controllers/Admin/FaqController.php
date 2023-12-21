<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FaqStoreRequest;
use App\Http\Requests\Admin\SubscriptionStoreRequest;
use App\Models\Faq;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\AdminDataTableButtonHelper;
use Yajra\DataTables\Facades\DataTables;

class FaqController extends Controller
{
//    function __construct()
//    {
//        $this->middleware('permission:contact-us-read|contact-us-create|contact-us-update|contact-us-delete', ['only' => ['index']]);
//        $this->middleware('permission:contact-us-create', ['only' => ['create', 'store']]);
//        $this->middleware('permission:contact-us-update', ['only' => ['edit', 'update']]);
//        $this->middleware('permission:contact-us-delete', ['only' => ['destroy']]);
//    }

    public function create()
    {
        return view('admin.faq.create');
    }
    public function index()
    {
        return view('admin.faq.index');
    }

    public function getFaqList(Request $request)
    {
        if ($request->ajax()) {
            $faq = DB::table('faqs')

                ->orderBy('id', 'desc');

            if (!empty($request->deleted)) {
                if ((int)$request->deleted === 1) {
                    $faq->whereNotNull('faqs.deleted_at');
                } else {
                    $faq->whereNull('faqs.deleted_at');
                }
            }
            $faq = $faq->select('faqs.*');
            return Datatables::of($faq)
                ->addColumn('action', function ($faq) {
                    if (is_null($faq->deleted_at)) {
                        $array = [
                            'id' => $faq->id,
                            'actions' => [
                                'delete' => $faq->id,
                                'edit' => route('admin.faq.edit', $faq->id),
                            ]
                        ];
                    } else {
                        $array = [
                            'id' => $faq->id,
                            'actions' => [
                                'hard-delete' => $faq->id,
                                'restore' => $faq->id,
                            ]
                        ];
                    }
                    return AdminDataTableButtonHelper::actionButtonDropdown($array);
                })
                ->addColumn('check', function ($faq) {
                    return '<td>
                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                        <input class="form-check-input all_selected" type="checkbox" value=' . $faq->id . ' id="single_select">
                    </div>
                </td>';
                })
                ->rawColumns(['action', 'status','check'])
                ->make(true);
        }
    }

    public function store(FaqStoreRequest $request): JsonResponse
    {
        $validated = $request->validated();
        if ((int)$validated['edit_value'] === 0) {
            $faq = new Faq();
            $faq->question = $request->question;
            $faq->answer = $request->answer;
            $faq->save();

            return response()->json([
                'message' => 'Faq Add Successfully'
            ]);
        } else {
            $faq = Faq::find($validated['edit_value']);
            $faq->question = $request->question;
            $faq->answer = $request->answer;
            $faq->save();

            return response()->json([
                'message' => 'Faq Update Successfully'
            ]);
        }
    }

    public function edit($id)
    {
        $faq = Faq::findOrFail($id);
        return view('admin.faq.edit', [
            'faq' => $faq,
        ]);
    }

    public function destroy($id): JsonResponse
    {
        Faq::where('id', $id)->delete();
        return response()->json([
            'message' => 'Faq Delete Successfully'
        ]);
    }

    public function hardDelete($id): JsonResponse
    {
        DB::table('faqs')->where('id', $id)->delete();
        return response()->json([
            'message' => 'Faq Delete Successfully'
        ]);
    }

    public function restoreFaq($id): JsonResponse
    {
        DB::table('faqs')->where('id', $id)->update([
            'deleted_at' => null
        ]);
        return response()->json([
            'message' => 'Faq Restore Successfully'
        ]);
    }

    public function multipleFaqDelete(Request $request): JsonResponse
    {
        $faqs = DB::table('faqs')->whereIn('id', $request->ids)->get();
        foreach ($faqs as $faq) {
            if (!is_null($faq->deleted_at)) {
                DB::table('faqs')->where('id', $faq->id)->delete();
            } else {
                Faq::where('id', $faq->id)->delete();
            }
        }
        return response()->json([
            'message' => 'Faq Delete Successfully'
        ]);
    }
}
