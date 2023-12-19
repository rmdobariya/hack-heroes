<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SubscriptionStoreRequest;
use App\Models\ContactUs;
use App\Models\Subscription;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\AdminDataTableButtonHelper;
use Yajra\DataTables\Facades\DataTables;

class SubscriptionController extends Controller
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
        return view('admin.subscription.create');
    }
    public function index()
    {
        return view('admin.subscription.index');
    }

    public function getSubscriptionList(Request $request)
    {
        if ($request->ajax()) {
            $subscription = DB::table('subscriptions')
                ->orderBy('id', 'desc');

            if (!empty($request->deleted)) {
                if ((int)$request->deleted === 1) {
                    $subscription->whereNotNull('subscriptions.deleted_at');
                } else {
                    $subscription->whereNull('subscriptions.deleted_at');
                }
            }
            $subscription = $subscription->select('subscriptions.*');
            return Datatables::of($subscription)
                ->addColumn('action', function ($subscription) {
                    if (is_null($subscription->deleted_at)) {
                        $array = [
                            'id' => $subscription->id,
                            'actions' => [
//                                'delete' => $subscription->id,
                                'edit' => route('admin.subscription.edit', $subscription->id),
                            ]
                        ];
                    } else {
                        $array = [
                            'id' => $subscription->id,
                            'actions' => [
                                'hard-delete' => $subscription->id,
                                'restore' => $subscription->id,
                            ]
                        ];
                    }
                    return AdminDataTableButtonHelper::actionButtonDropdown($array);
                })
//                ->addColumn('check', function ($subscription) {
//                    return '<td>
//                    <div class="form-check form-check-sm form-check-custom form-check-solid">
//                        <input class="form-check-input all_selected" type="checkbox" value=' . $subscription->id . ' id="single_select">
//                    </div>
//                </td>';
//                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
    }

    public function store(SubscriptionStoreRequest $request): JsonResponse
    {
        $validated = $request->validated();
        if ((int)$validated['edit_value'] === 0) {
            $subscription = new Subscription();
            $subscription->title = $request->title;
            $subscription->description = $request->description;
            $subscription->price = $request->price;
            $subscription->save();

            return response()->json([
                'message' => 'Subscription Add Successfully'
            ]);
        } else {
            $subscription = Subscription::find($validated['edit_value']);
            $subscription->title = $request->title;
            $subscription->description = $request->description;
            $subscription->price = $request->price;
            $subscription->save();

            return response()->json([
                'message' => 'Subscription Update Successfully'
            ]);
        }
    }

    public function edit($id)
    {
        $subscription = Subscription::findOrFail($id);
        return view('admin.subscription.edit', [
            'subscription' => $subscription,
        ]);
    }

    public function destroy($id): JsonResponse
    {
        Subscription::where('id', $id)->delete();
        return response()->json([
            'message' => 'Subscription Delete Successfully'
        ]);
    }
}
