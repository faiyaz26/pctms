<?php

class DivisionTableSeeder extends Seeder {

    public function run()
    {
        DB::table('divisions')->delete();

        $date = new DateTime();
        $d = $date->format('Y-m-d H:i:s');

        $users = array(
            array(
                'division_name'      => 'Mixed',
                'division_description' => 'This division means that contestents are from different divisions',
                'created_at' => $d,
                'updated_at' => $d,
            ),
            array(
                'division_name'      => 'Team',
                'division_description' => 'Team Contest Division',
                'created_at' => $d,
                'updated_at' => $d,
            )
        );

        DB::table('divisions')->insert( $users );
    }

}
