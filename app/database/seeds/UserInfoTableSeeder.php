<?php

class UserInfoTableSeeder extends Seeder {

    public function run()
    {
        DB::table('user_infos')->delete();
        $date = new DateTime();
        $d = $date->format('Y-m-d H:i:s');
        $users = array(
            array(
                'user_id'      => User::where('username', '=', 'admin')->first()->id,
                'cf_handle' => 'admin', 
                'spoj_handle' => 'admin', 
                'cc_handle' => 'admin', 
                'loj_handle' => 'admin',
                'uva_handle' => 'admin',
                'sgu_handle' => 'admin',
                'hustoj_handle' => 'admin',
                'tc_handle' => 'admin',
                'created_at' => $d,
                'updated_at' => $d,
            ),
            array(
                'user_id'      => User::where('username', '=', 'user')->first()->id,
                'cf_handle' => 'admin', 
                'spoj_handle' => 'admin', 
                'cc_handle' => 'admin', 
                'loj_handle' => 'admin',
                'uva_handle' => 'admin',
                'sgu_handle' => 'admin',
                'hustoj_handle' => 'admin',
                'tc_handle' => 'admin',
                'created_at' => $d,
                'updated_at' => $d,
            )
        );

        DB::table('user_infos')->insert( $users );
    }

}
