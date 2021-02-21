<?php

namespace App\Http\Controllers\API;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\RoleResource;
use App\Http\Requests\RoleStoreUpdateRequest;
use App\Http\Controllers\API\BaseApiController;

class RoleApiController extends BaseApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::orderBy('name')->get();

        return $this->sendResponse(null, RoleResource::collection($roles));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function paginate()
    {
        $rolesPaginate = Role::orderBy('name')->paginate();
        $rolesPaginate->setCollection(RoleResource::collection($rolesPaginate->getCollection())->collection);

        return $this->sendResponse(null, $rolesPaginate);
    }

    public function permissionsByRole(Request $request, $id)
    {
        if(!$role = Role::find($id)) {
            return $this->sendError('Not found', null, 404);
        }

        return $this->sendResponse(null, $role->permissions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleStoreUpdateRequest $request)
    {

        try {
            DB::beginTransaction();

            $role = Role::create(['name' => $request->name, 'guard_name' => 'api']);
            $role->syncPermissions($request->permissions);

            DB::commit();
            return $this->sendResponse('Save successfully', $role, 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->sendError('Internal Server Error', ['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleStoreUpdateRequest $request, $id)
    {
        if(!$role = Role::find($id)) {
            return $this->sendError('Not found', null, 404);
        }

        try {
            DB::beginTransaction();

            $role->name = $request->name;
            $role->save();
            $role->syncPermissions($request->permissions);

            DB::commit();
            return $this->sendResponse('Save successfully', $role);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->sendError('Internal Server Error', ['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
