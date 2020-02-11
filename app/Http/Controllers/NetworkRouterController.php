<?php

namespace App\Http\Controllers;

use App\Http\Resources\NetworkRouterResource;
use App\NetworkRouter;
use Illuminate\Http\Request;

class NetworkRouterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $network_routers = NetworkRouter::query()
            ->get();

        return response($network_routers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return NetworkRouterResource
     */
    public function show(NetworkRouter $router)
    {
        return new NetworkRouterResource($router);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return NetworkRouterResource
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, NetworkRouter $router)
    {
        $data = $this->validate($request, [
            "name" => "string|required",
            "host" => "string|required",
            "admin_username" => "string|required",
            "admin_password" => "nullable|string",
        ]);

        if ($data["admin_password"] === null) {
            $data["admin_password"] = "";
        }

        return new NetworkRouterResource(tap($router)->update($data));
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
