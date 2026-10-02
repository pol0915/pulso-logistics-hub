<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| DEMO LOGISTICS HEAD ACCOUNT
|--------------------------------------------------------------------------
|
| Temporary front-end/demo authentication only.
| Replace this later with database-backed Laravel authentication.
|
*/

$demoLogisticsHead = [
    'name' => 'Paul Roldan',
    'email' => 'logisticshead@pulso.com',
    'password' => 'logisticshead123',
    'role' => 'Logistics Head',
    'initials' => 'PR',
];


/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

Route::view(
    '/',
    'landing'
)->name('home');


Route::get(
    '/login',
    function (Request $request) {
        if (
            $request->session()->get(
                'is_logistics_head'
            )
        ) {
            return redirect()->route(
                'dashboard'
            );
        }

        return view(
            'auth.login'
        );
    }
)->name('login');


/*
|--------------------------------------------------------------------------
| LOGIN
|--------------------------------------------------------------------------
*/

Route::post(
    '/login',
    function (
        Request $request
    ) use (
        $demoLogisticsHead
    ) {
        $credentials =
            $request->validate([
                'email' => [
                    'required',
                    'email',
                ],

                'password' => [
                    'required',
                    'string',
                ],
            ]);


        $emailMatches =
            hash_equals(
                $demoLogisticsHead['email'],
                strtolower(
                    trim(
                        $credentials['email']
                    )
                )
            );


        $passwordMatches =
            hash_equals(
                $demoLogisticsHead['password'],
                $credentials['password']
            );


        if (
            !$emailMatches ||
            !$passwordMatches
        ) {
            return back()
                ->withErrors([
                    'email' =>
                        'Invalid email or password.',
                ])
                ->onlyInput(
                    'email'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | CREATE DEMO SESSION
        |--------------------------------------------------------------------------
        */

        $request
            ->session()
            ->regenerate();


        $request
            ->session()
            ->put(
                'is_logistics_head',
                true
            );


        $request
            ->session()
            ->put(
                'logistics_user',
                [
                    'name' =>
                        $demoLogisticsHead['name'],

                    'email' =>
                        $demoLogisticsHead['email'],

                    'role' =>
                        $demoLogisticsHead['role'],

                    'initials' =>
                        $demoLogisticsHead['initials'],
                ]
            );


        return redirect()
            ->route(
                'dashboard'
            )
            ->with(
                'login_success',
                'Welcome back, Paul.'
            );
    }
)->name('login.submit');


/*
|--------------------------------------------------------------------------
| LOGOUT
|--------------------------------------------------------------------------
*/

Route::post(
    '/logout',
    function (
        Request $request
    ) {
        $request
            ->session()
            ->forget([
                'is_logistics_head',
                'logistics_user',
            ]);


        $request
            ->session()
            ->invalidate();


        $request
            ->session()
            ->regenerateToken();


        return redirect()
            ->route(
                'login'
            )
            ->with(
                'logout_success',
                'You have been logged out.'
            );
    }
)->name('logout');


/*
|--------------------------------------------------------------------------
| PROTECTED VIEW HELPER
|--------------------------------------------------------------------------
|
| Since this is still a static/demo account, we can protect the pages here
| without creating middleware yet.
|
| Later, once database authentication is added, this can be replaced by
| Laravel's normal auth middleware.
|
*/

$protectedView = function (
    string $uri,
    string $view,
    string $name
) {
    Route::get(
        $uri,
        function (
            Request $request
        ) use (
            $view
        ) {
            if (
                !$request
                    ->session()
                    ->get(
                        'is_logistics_head'
                    )
            ) {
                return redirect()
                    ->route(
                        'login'
                    )
                    ->with(
                        'auth_required',
                        'Please log in as the Logistics Head to continue.'
                    );
            }


            return view(
                $view
            );
        }
    )->name(
        $name
    );
};


/*
|--------------------------------------------------------------------------
| DASHBOARD
|--------------------------------------------------------------------------
*/

$protectedView(
    '/dashboard',
    'dashboard',
    'dashboard'
);


/*
|--------------------------------------------------------------------------
| INVENTORY & ASSETS
|--------------------------------------------------------------------------
*/

$protectedView(
    '/inventory',
    'inventory.index',
    'inventory.index'
);


$protectedView(
    '/inventory/create',
    'inventory.create',
    'inventory.create'
);


$protectedView(
    '/inventory/asset-details',
    'inventory.show',
    'inventory.show'
);


$protectedView(
    '/inventory/edit',
    'inventory.edit',
    'inventory.edit'
);


/*
|--------------------------------------------------------------------------
| LOGISTICS REQUESTS
|--------------------------------------------------------------------------
*/

$protectedView(
    '/requests',
    'requests.index',
    'requests.index'
);


$protectedView(
    '/requests/create',
    'requests.create',
    'requests.create'
);


$protectedView(
    '/requests/request-details',
    'requests.show',
    'requests.show'
);


/*
|--------------------------------------------------------------------------
| BORROW & RETURN
|--------------------------------------------------------------------------
*/

$protectedView(
    '/borrow',
    'borrow.index',
    'borrow.index'
);


$protectedView(
    '/borrow/borrowing-details',
    'borrow.show',
    'borrow.show'
);


/*
|--------------------------------------------------------------------------
| PROJECTS
|--------------------------------------------------------------------------
*/

$protectedView(
    '/projects',
    'projects.index',
    'projects.index'
);


$protectedView(
    '/projects/project-details',
    'projects.show',
    'projects.show'
);


/*
|--------------------------------------------------------------------------
| DONATIONS
|--------------------------------------------------------------------------
*/

$protectedView(
    '/donations',
    'donations.index',
    'donations.index'
);


$protectedView(
    '/donations/donation-details',
    'donations.show',
    'donations.show'
);


/*
|--------------------------------------------------------------------------
| REPORTS & HISTORY
|--------------------------------------------------------------------------
*/

$protectedView(
    '/reports',
    'reports.index',
    'reports.index'
);


$protectedView(
    '/reports/inventory',
    'reports.inventory',
    'reports.inventory'
);


$protectedView(
    '/reports/requests',
    'reports.requests',
    'reports.requests'
);


$protectedView(
    '/reports/borrow',
    'reports.borrow',
    'reports.borrow'
);


$protectedView(
    '/reports/projects',
    'reports.projects',
    'reports.projects'
);


$protectedView(
    '/reports/donations',
    'reports.donations',
    'reports.donations'
);


$protectedView(
    '/reports/activity',
    'reports.activity',
    'reports.activity'
);