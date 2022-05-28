<?php

use App\Http\Controllers\Auth\LoginController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', [LoginController::class, 'create'])->name('login');

Route::post('/login', [LoginController::class, 'store']);

Route::post('/logout', [LoginController::class, 'destroy'])->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        // this will render resources/js/Pages/Home.vue
        return Inertia::render('Home', [
            'name' => 'Jane Doe',
            'frameworks' => [
                'Laravel',
                'Vue',
                'Intertia'
            ]
        ]);
    });

    Route::get('/users', function () {
//    sleep(2);
        return Inertia::render('Users/Index', [
            'users' => User::query()
                ->when(Request::input('search'), function ($query, $search) {
                    $query->where('name', 'LIKE', "%{$search}%");
                })
                ->paginate(10)
                ->withQueryString()
                ->through(fn(User $user) => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'can' => [
                        'edit' => Auth::user()->can('edit', [User::class, Auth::user()])
                    ]
                ]),
            'time' => now()->toTimeString(),
            'filters' => Request::only(['search']),
            'can' => [
                'createUser' => Auth::user()->can('create', User::class)
            ]
        ]);
    });

    Route::get('/settings', function () {
        return Inertia::render('Settings', []);
    });

    Route::get('/users/create', function () {
        return Inertia::render('Users/Create');
    })
        ->can('create', User::class);
        //->middleware('can:create, App\Models\User');

    Route::post('/users/create', function () {
        // validate request
        $attributes = Request::validate(
            [
                'name' => 'required',
                'email' => ['required', 'email'],
                'password' => 'required'
            ]
        );
        // create user
        User::create($attributes);

        // redirect
        return redirect('/users');
    });
});

