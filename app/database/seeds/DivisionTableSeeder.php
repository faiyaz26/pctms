<?php

class DivisionTableSeeder extends Seeder {

    public function run()
    {
        DB::table('divisions')->delete();


        $users = array(
            array(
                'id'      => '1',
                'division_name'      => 'Seniors',
                'division_description' => 'Seniors and Juniors'
            ),
            array(
                'id'      => '2',
                'division_name'      => 'Beginners',
                'division_description' => 'Beginners'
            )
        );

        DB::table('divisions')->insert( $users );
    }

}
