<?php

use Illuminate\Database\Seeder;
use App\Models\Admin;

class adminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name' => 'atef taha',
            'email' => 'ateftaha12@gmail.com',
            'password' => bcrypt('123456789'),
        ]);
    }
}
