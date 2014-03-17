<?php

class UserInfoTableSeeder extends Seeder {

    public function run()
    {
        DB::table('user_infos')->delete();


        $users = array(
            array(
                'user_id'      => '1',
                'full_name'      => 'Admin',
                'cf_handle' => 'admin', 
                'spoj_handle' => 'admin', 
                'cc_handle' => 'admin', 
                'loj_handle' => 'admin'
            ),
            array(
                'user_id'      => '2',
                'full_name'      => 'User',
                'cf_handle' => 'user', 
                'cm_handle' => 'user', 
                'hustoj_handle' => 'user', 
                'sgu_handle' => 'user'
            )
        );

        DB::table('user_infos')->insert( $users );
    }

}
