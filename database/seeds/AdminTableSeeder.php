<?php

use App\Admin;
use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new Admin;

        $admin->name = "Admin Forum";
        $admin->email = "admin@mail.com";
        $admin->password = bcrypt('rahasiaku');
        $admin->save();
    }
}
