<?php

namespace App\Http\Controllers\Admin;

use App\Http\Repositories\AdminRepository;
use App\Http\Repositories\Repository;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminRequest;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        Gate::authorize('view', $user);

        $users = User::all();
        return view('admin.admin-index', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminRequest $request)
    {
        User::query()->create($request->validated());
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminRequest $request, User $user)
    {
        $request->merge([
            'password' => Hash::make($request->password)
        ]);

        $user->update($request->validated());
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back();
    }
}
