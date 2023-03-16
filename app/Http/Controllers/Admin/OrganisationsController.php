<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Organisation\BulkDestroyOrganisation;
use App\Http\Requests\Admin\Organisation\DestroyOrganisation;
use App\Http\Requests\Admin\Organisation\IndexOrganisation;
use App\Http\Requests\Admin\Organisation\StoreOrganisation;
use App\Http\Requests\Admin\Organisation\UpdateOrganisation;
use App\Models\Organisation;
use Brackets\AdminListing\Facades\AdminListing;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class OrganisationsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexOrganisation $request
     * @return array|Factory|View
     */
    public function index(IndexOrganisation $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Organisation::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'name', 'subscribed', 'trial_end'],

            // set columns to searchIn
            ['id', 'name', 'description'],

            function ($query) use($request) {
                if ($request->has('subscribeds')) {
                    $query->whereIn('subscribed',$request->get('subscribeds'));
                }
            }
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        $subscribeds = [
            [
                'value' => true,
                'name' => 'Yes'
            ],
            [
                'value' => false,
                'name' => 'No'
            ]
        ];

        return view('admin.organisation.index', [
            'data' => $data,
            'subscribeds' => $subscribeds
    ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.organisation.create');

        return view('admin.organisation.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreOrganisation $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreOrganisation $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Organisation
        $organisation = Organisation::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/organisations'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/organisations');
    }

    /**
     * Display the specified resource.
     *
     * @param Organisation $organisation
     * @throws AuthorizationException
     * @return void
     */
    public function show(Organisation $organisation)
    {
        $this->authorize('admin.organisation.show', $organisation);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Organisation $organisation
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Organisation $organisation)
    {
        $this->authorize('admin.organisation.edit', $organisation);


        return view('admin.organisation.edit', [
            'organisation' => $organisation,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateOrganisation $request
     * @param Organisation $organisation
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateOrganisation $request, Organisation $organisation)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Organisation
        $organisation->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/organisations'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/organisations');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyOrganisation $request
     * @param Organisation $organisation
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyOrganisation $request, Organisation $organisation)
    {
        $organisation->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyOrganisation $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyOrganisation $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Organisation::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
