<?php

namespace App\Http\Controllers\Admin;


use App\Helpers\CatchCreateHelper;
use App\Http\Controllers\Controller;
use App\Models\PageTranslation;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\Admin\PageStoreRequest;
use Illuminate\Http\Request;
use App\Models\Page;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use App\Helpers\AdminDataTableButtonHelper;
use Yajra\DataTables\Facades\DataTables;

class PageController extends Controller
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
        return view('admin.page.index');
    }

    public function create()
    {
        $languages = CatchCreateHelper::getLanguage(App::getLocale());
        return view('admin.page.create',[
            'languages' => $languages
        ]);
    }

    public function store(PageStoreRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $languages = CatchCreateHelper::getLanguage(App::getLocale());
        if ((int)$validated['edit_value'] === 0) {
            $page = new Page();
            $page->slug = $request->slug;
            $page->save();
            foreach ($languages as $language) {
                PageTranslation::create([
                    'name' => $request->input($language['language_code'] . '_name'),
                    'description' => $request->input($language['language_code'] . '_description'),
                    'page_id' => $page->id,
                    'locale' => $language['language_code'],
                ]);
            }
            return response()->json([
                'message' => 'Page Add Successfully'
            ]);

        } else {
            $page = Page::find($validated['edit_value']);
            $page->slug = $request->slug;
            $page->save();

            foreach ($languages as $language) {
                PageTranslation::updateOrCreate(
                    [
                        'page_id' => $validated['edit_value'],
                        'locale' => $language['language_code'],
                    ],
                    [
                        'page_id' => $validated['edit_value'],
                        'locale' => $language['language_code'],
                        'name' => $request->input($language['language_code'] . '_name'),
                        'description' => $request->input($language['language_code'] . '_description'),
                    ]);
            }
            return response()->json([
                'message' => 'Page Update Successfully'
            ]);
        }
    }

    public function edit($id)
    {
        $page = Page::findOrFail($id);
        $languages = CatchCreateHelper::getLanguage(App::getLocale());
        return view('admin.page.edit', [
            'page' => $page,
            'languages' => $languages,
        ]);
    }

    public function destroy($id): JsonResponse
    {
        Page::where('id', $id)->delete();
        return response()->json([
            'message' => 'Page Delete Successfully'
        ]);
    }

    public function getPageList(Request $request)
    {
        if ($request->ajax()) {
            $pages = DB::table('pages')
                ->leftJoin('page_translations', 'pages.id', 'page_translations.page_id')
                ->where('page_translations.locale', App::getLocale())
                ->orderBy('id', 'desc')
                ->select('pages.*','page_translations.name');
            if (!empty($request->status) && $request->status !== 'all') {
                $pages->where('pages.status', $request->status);
            }
            return Datatables::of($pages)
                ->addColumn('action', function ($pages) {
                    $array = [
                        'id' => $pages->id,
                        'actions' => [
                            'edit' => route('admin.page.edit', [$pages->id]),
//                            'delete' => $pages->id,
//                            'status' => $pages->status,
                        ]
                    ];
                    return AdminDataTableButtonHelper::actionButtonDropdown($array);
                })

                ->addColumn('status', function ($pages) {
                    $array['status'] = $pages->status;
                    return AdminDataTableButtonHelper::statusBadge($array);
                })
                ->addColumn('check', function ($vehicle) {

                    return '<td>
                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                        <input class="form-check-input all_selected" type="checkbox" value=' . $vehicle->id . ' id="single_select">
                    </div>
                </td>';
                })
                ->rawColumns(['action', 'status','check'])
                ->make(true);
        }
    }

    public function changeStatus($id, $status): JsonResponse
    {
        Page::where('id', $id)->update(['status' => $status]);
        return response()->json([
            'message' => 'Status Change Successfully',
        ]);
    }

    public function multiplePageDelete(Request $request): JsonResponse
    {
        $pages = DB::table('pages')->whereIn('id', $request->ids)->get();
        foreach ($pages as $page) {
            if (!is_null($page->deleted_at)) {
                DB::table('pages')->where('id', $page->id)->delete();
            } else {
                Page::where('id', $page->id)->delete();
            }
        }
        return response()->json([
            'message' => 'Record Delete Successfully'
        ]);
    }
}
