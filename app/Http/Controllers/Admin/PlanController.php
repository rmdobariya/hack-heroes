<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PlanStoreRequest;
use App\Models\Plan;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\AdminDataTableButtonHelper;
use Yajra\DataTables\Facades\DataTables;

class PlanController extends Controller
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
        return view('admin.plan.create');
    }

    public function index()
    {
        return view('admin.plan.index');
    }

    public function getPlanList(Request $request)
    {
        if ($request->ajax()) {
            $plan = DB::table('plans')
                ->orderBy('id', 'desc');

            if (!empty($request->deleted)) {
                if ((int)$request->deleted === 1) {
                    $plan->whereNotNull('plans.deleted_at');
                } else {
                    $plan->whereNull('plans.deleted_at');
                }
            }
            $plan = $plan->select('plans.*');
            return Datatables::of($plan)
                ->addColumn('action', function ($plan) {
                    if (is_null($plan->deleted_at)) {
                        $array = [
                            'id' => $plan->id,
                            'actions' => [
                                'delete' => $plan->id,
                                'edit' => route('admin.plan.edit', $plan->id),
                            ]
                        ];
                    } else {
                        $array = [
                            'id' => $plan->id,
                            'actions' => [
                                'hard-delete' => $plan->id,
                                'restore' => $plan->id,
                            ]
                        ];
                    }
                    return AdminDataTableButtonHelper::actionButtonDropdown($array);
                })
                ->addColumn('check', function ($plan) {
                    return '<td>
                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                        <input class="form-check-input all_selected" type="checkbox" value=' . $plan->id . ' id="single_select">
                    </div>
                </td>';
                })
                ->rawColumns(['action', 'status', 'check'])
                ->make(true);
        }
    }

    public function store(PlanStoreRequest $request): JsonResponse
    {
        $validated = $request->validated();
        if ((int)$validated['edit_value'] === 0) {
            $plan = new Plan();
            $plan->title = $request->title;
            $plan->description = $request->description;
            $plan->amount = $request->amount;
//            $plan->start_date = $request->start_date;
//            $plan->end_date = $request->end_date;
            $plan->save();

            return response()->json([
                'message' => 'Plan Add Successfully'
            ]);
        } else {
            $plan = Plan::find($validated['edit_value']);
            $plan->title = $request->title;
            $plan->description = $request->description;
            $plan->amount = $request->amount;
//            $plan->start_date = $request->start_date;
//            $plan->end_date = $request->end_date;
            $plan->save();

            return response()->json([
                'message' => 'Plan Update Successfully'
            ]);
        }
    }

    public function edit($id)
    {
        $plan = Plan::findOrFail($id);
        return view('admin.plan.edit', [
            'plan' => $plan,
        ]);
    }

    public function destroy($id): JsonResponse
    {
        Plan::where('id', $id)->delete();
        return response()->json([
            'message' => 'Plan Delete Successfully'
        ]);
    }

    public function hardDelete($id): JsonResponse
    {
        DB::table('plans')->where('id', $id)->delete();
        return response()->json([
            'message' => 'Plan Delete Successfully'
        ]);
    }

    public function restorePlan($id): JsonResponse
    {
        DB::table('plans')->where('id', $id)->update([
            'deleted_at' => null
        ]);
        return response()->json([
            'message' => 'Plan Restore Successfully'
        ]);
    }

    public function multiplePlanDelete(Request $request): JsonResponse
    {
        $plans = DB::table('plans')->whereIn('id', $request->ids)->get();
        foreach ($plans as $plan) {
            if (!is_null($plan->deleted_at)) {
                DB::table('plans')->where('id', $plan->id)->delete();
            } else {
                Plan::where('id', $plan->id)->delete();
            }
        }
        return response()->json([
            'message' => 'Plan Delete Successfully'
        ]);
    }
}
