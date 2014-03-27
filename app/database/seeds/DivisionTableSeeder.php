<?php

class DivisionTableSeeder extends Seeder {

    public function run()
    {
        DB::table('divisions')->delete();

        $date = new DateTime();
        $d = $date->format('Y-m-d H:i:s');

        $users = array(
            array(
                'id'      => '1',
                'division_name'      => 'Seniors',
                'division_description' => 'Seniors and Juniors',
                'created_at' => $d,
                'updated_at' => $d,
            ),
            array(
                'id'      => '2',
                'division_name'      => 'Beginners',
                'division_description' => 'Beginners',
                'created_at' => $d,
                'updated_at' => $d,
            )
        );

        DB::table('divisions')->insert( $users );
    }

}
