<?php

use App\Models\Account;
use App\Models\Contact;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'username' => 'acek',
            'first_name' => 'Acek',
            'last_name' => 'Ajah',
            'email' => 'acek@gmail.com',
            'password' => 'secret',
            'role_id' => 1,
        ]);

    }
}
