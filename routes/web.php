<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard::index');
    })->name('dashboard');
});

Route::get('/test-datatable', function () {
    return view('test-datatable');
});

Route::get('/test-datatable-api', function (Request $request) {
    $page = $request->input('page', 1);
    $search = $request->input('search', '');
    $perPage = 10;
    
    $data = collect(range(1, 30001))->map(function ($i) {
        return [
            'id' => $i,
            'name' => "User $i",
            'email' => "user$i@example.com",
        ];
    })->filter(function ($item) use ($search) {
        if (empty($search)) return true;
        return str_contains(strtolower($item['name']), strtolower($search));
    })->values();
    
    $total = $data->count();
    $items = $data->forPage($page, $perPage)->values();
    
    return [
        'data' => $items,
        'current_page' => (int)$page,
        'last_page' => ceil($total / $perPage),
        'total' => $total,
        'per_page' => $perPage,
        'from' => ($page - 1) * $perPage + 1,
        'to' => min($page * $perPage, $total),
    ];
});
