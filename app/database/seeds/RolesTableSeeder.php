<?php

class RolesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('roles')->delete();

        $adminRole = new Role;
        $adminRole->id = 1;
        $adminRole->name = 'admin';
        $adminRole->save();

        $commentRole = new Role;
        $commentRole->id = 2;
        $commentRole->name = 'comment';
        $commentRole->save();

        $user = User::where('username','=','admin')->first();
        $user->attachRole( $adminRole );

        $user = User::where('username','=','user')->first();
        $user->attachRole( $commentRole );
    }

}
