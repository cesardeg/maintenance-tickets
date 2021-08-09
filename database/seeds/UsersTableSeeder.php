<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = "Administrador";
        $user->email = "admin@mail.com";
        $user->password = bcrypt('query*');
        $user->email_verified_at = date("Y-m-d H:i:s");
        $user->type = 'user';
        $user->save();
    }
}
