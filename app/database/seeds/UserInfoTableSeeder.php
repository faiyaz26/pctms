<?php

class UserInfoTableSeeder extends Seeder {

    public function run()
    {
        DB::table('user_infos')->delete();


        $users = array(
            array(
                'user_id'      => '1',
                'cf_handle' => 'admin', 
                'spoj_handle' => 'admin', 
                'cc_handle' => 'admin', 
                'loj_handle' => 'admin',
                'uva_handle' => 'admin',
                'sgu_handle' => 'admin',
                'hustoj_handle' => 'admin'
            ),
            array(
                'user_id'      => '2',
                'cf_handle' => 'admin', 
                'spoj_handle' => 'admin', 
                'cc_handle' => 'admin', 
                'loj_handle' => 'admin',
                'uva_handle' => 'admin',
                'sgu_handle' => 'admin',
                'hustoj_handle' => 'admin'
            )
        );

        DB::table('user_infos')->insert( $users );
    }

}
