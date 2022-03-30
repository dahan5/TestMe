<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminArray = array(['username' => 'taleb.dahan@feqra.com', 'password' => bcrypt('Urfoz4p6$#@!')]
        , ['username' => 'christoph.drescher@trimetis.com', 'password' => bcrypt('12345678')]);

        foreach ($adminArray as $admin) {
            DB::table('admins')->insert([
                'id' => Uuid::uuid4(),
                'username' => $admin['username'],
                'password' => $admin['password'],
                'role_id' => '1'
            ]);
        }
    }
}
