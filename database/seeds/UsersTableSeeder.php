<?php

use App\User;
use App\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        DB::table('role_user')->truncate();

        $admin = User::create([
            'first_name' => 'admin',
            'last_name' => 'admin1',
            'email' => 'mouadine.bilal1@gmail.com',
            'password' => Hash::make('password')
        ]);
        $utilisateur1 = User::create([
            'first_name' => 'user1',
            'last_name' => 'user11',
            'email' => 'user1@gmail.com',
            'password' => Hash::make('password')
        ]);
        $utilisateur2 = User::create([
            'first_name' => 'user2',
            'last_name' => 'user22',
            'email' => 'user2@gmail.com',
            'password' => Hash::make('password')
        ]);
        $adminRole= Role::where('name','admin')->first();
        $utilisateurRole = Role::where('name','utilisateur')->first();

        $admin->roles()->attach($adminRole);
        $utilisateur1->roles()->attach($utilisateurRole);
        $utilisateur2->roles()->attach($utilisateurRole);
    }
}
