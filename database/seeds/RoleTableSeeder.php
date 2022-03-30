<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $roleArray = array(['id'=>'1','role'=>'superadmin'],['id'=>'2','role'=>'admin']);

        foreach ($roleArray as $role) {
            DB::table('roles')->insert([
                'id' => $role['id'],
                'role' => $role['role']
            ]);
        }
    }
}
