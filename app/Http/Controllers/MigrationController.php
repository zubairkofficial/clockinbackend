<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use App\Models\User;

class MigrationController extends Controller
{
    public function refresh(){
        Artisan::call('migrate:fresh');
        Artisan::call('optimize:clear');
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
        ]);
        return 'Database refreshed and new user created successfully.';
    }
}
