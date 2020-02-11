<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserLogResource;
use App\UserLog;
use Illuminate\Http\Request;

class UserLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userLogs = UserLog::query()
            ->orderByDesc("created_at")
            ->with("user")
            ->get();

        return UserLogResource::collection($userLogs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\UserLog $userLog
     * @return \Illuminate\Http\Response
     */
    public function show(UserLog $userLog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\UserLog $userLog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserLog $userLog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\UserLog $userLog
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserLog $userLog)
    {
        //
    }
}
