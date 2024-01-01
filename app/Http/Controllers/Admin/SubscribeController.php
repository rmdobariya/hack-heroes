<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use App\Models\Subscribe;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\AdminDataTableButtonHelper;
use Yajra\DataTables\Facades\DataTables;

class SubscribeController extends Controller
{
//    function __construct()
//    {
//        $this->middleware('permission:contact-us-read|contact-us-create|contact-us-update|contact-us-delete', ['only' => ['index']]);
//        $this->middleware('permission:contact-us-create', ['only' => ['create', 'store']]);
//        $this->middleware('permission:contact-us-update', ['only' => ['edit', 'update']]);
//        $this->middleware('permission:contact-us-delete', ['only' => ['destroy']]);
//    }

    public function index()
    {
        return view('admin.subscribe.index');
    }

    public function getSubscribeList(Request $request)
    {
        if ($request->ajax()) {
            $subscribe = DB::table('subscribes')
                ->orderBy('id', 'desc');

            if (!empty($request->deleted)) {
                if ((int)$request->deleted === 1) {
                    $subscribe->whereNotNull('subscribes.deleted_at');
                } else {
                    $subscribe->whereNull('subscribes.deleted_at');
                }
            }
            $subscribe = $subscribe->select('subscribes.*');
            return Datatables::of($subscribe)
                ->addColumn('action', function ($subscribe) {
                    if (is_null($subscribe->deleted_at)) {
                        $array = [
                            'id' => $subscribe->id,
                            'actions' => [
                                'delete' => $subscribe->id,
                            ]
                        ];
                    } else {
                        $array = [
                            'id' => $subscribe->id,
                            'actions' => [
                                'hard-delete' => $subscribe->id,
                                'restore' => $subscribe->id,
                            ]
                        ];
                    }
                    return AdminDataTableButtonHelper::actionButtonDropdown($array);
                })
                ->addColumn('check', function ($subscribe) {
                    return '<td>
                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                        <input class="form-check-input all_selected" type="checkbox" value=' . $subscribe->id . ' id="single_select">
                    </div>
                </td>';
                })
                ->rawColumns(['action', 'status', 'check'])
                ->make(true);
        }
    }

    public function destroy($id): JsonResponse
    {
        Subscribe::where('id', $id)->delete();
        return response()->json([
            'message' => 'Subscribe Delete Successfully'
        ]);
    }

    public function restoreSubscribe($id): JsonResponse
    {
        DB::table('subscribes')->where('id', $id)->update([
            'deleted_at' => null
        ]);
        return response()->json([
            'message' => 'Subscribe Restore Successfully'
        ]);
    }

    public function hardDelete($id): JsonResponse
    {
        DB::table('subscribes')->where('id', $id)->delete();
        return response()->json([
            'message' => 'Subscribe Delete Successfully'
        ]);
    }

    public function multipleSubscribeDelete(Request $request): JsonResponse
    {
        $subscribes = DB::table('subscribes')->whereIn('id', $request->ids)->get();
        foreach ($subscribes as $subscribe) {
            if (!is_null($subscribe->deleted_at)) {
                DB::table('subscribes')->where('id', $subscribe->id)->delete();
            } else {
                Subscribe::where('id', $subscribe->id)->delete();
            }
        }
        return response()->json([
            'message' => 'Subscribe Delete Successfully'
        ]);
    }
}
