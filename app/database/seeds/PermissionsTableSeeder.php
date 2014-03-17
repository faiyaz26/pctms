<?php

class PermissionsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('permissions')->delete();


        $permissions = array(
            array(
                'id' => 1,
                'name'      => 'manage_blogs',
                'display_name'      => 'manage blogs'
            ),
            array(
                'id' => 2,
                'name'      => 'manage_posts',
                'display_name'      => 'manage posts'
            ),
            array(
                'id' => 3,
                'name'      => 'manage_comments',
                'display_name'      => 'manage comments'
            ),
            array(
                'id' => 4,
                'name'      => 'manage_users',
                'display_name'      => 'manage users'
            ),
            array(
                'id' => 5,
                'name'      => 'manage_roles',
                'display_name'      => 'manage roles'
            ),
            array(
                'id' => 6,
                'name'      => 'post_comment',
                'display_name'      => 'post comment'
            ),
        );

        DB::table('permissions')->insert( $permissions );

        DB::table('permission_role')->delete();

        $permissions = array(
            array(
                'id' => 1,
                'role_id'      => 1,
                'permission_id' => 1
            ),
            array(
                'id' => 2,
                'role_id'      => 1,
                'permission_id' => 2
            ),
            array(
                'id' => 3,
                'role_id'      => 1,
                'permission_id' => 3
            ),
            array(
                'id' => 4,
                'role_id'      => 1,
                'permission_id' => 4
            ),
            array(
                'id' => 5,
                'role_id'      => 1,
                'permission_id' => 5
            ),
            array(
                'id' => 6,
                'role_id'      => 1,
                'permission_id' => 6
            ),
            array(
                'id' => 7,
                'role_id'      => 2,
                'permission_id' => 6
            ),
        );

        DB::table('permission_role')->insert( $permissions );
    }

}
