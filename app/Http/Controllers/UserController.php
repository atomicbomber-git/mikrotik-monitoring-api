<?php

namespace App\Http\Controllers;

use App\Constants\UserLevel;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        $this->authorize("viewAny", User::class);

        $users = User::query()
            ->select([
                "id",
                "name",
                "username",
                "level",
            ])
            ->orderBy("level")
            ->get();

        return response()->view("user.index", compact(
            "users"
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user->level === UserLevel::SUPER_ADMINISTRATOR) {
            return redirect()
                ->route("user.index", 400)
                ->with("messages", [
                    [
                        "state" => "danger",
                        "content" => "Data gagal dihapus"
                    ],
                    [
                        "state" => "danger",
                        "content" => "User dengan level Super Administrator tidak dapat dihapus."
                    ]
                ]);
        }

        DB::beginTransaction();

        $user->user_logs()->forceDelete();
        $user->forceDelete();

        DB::commit();

        return redirect()
            ->route("user.index")
            ->with("messages", [
                [
                    "state" => "success",
                    "content" => "Data berhasil dihapus"
                ]
            ]);
    }
}
