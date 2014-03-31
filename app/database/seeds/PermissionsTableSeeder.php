<?php

class PermissionsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('permissions')->delete();


        $permissions = array(
            array(
                'name'      => 'manage_blogs',
                'display_name'      => 'manage blogs'
            ),
            array(
                'name'      => 'manage_posts',
                'display_name'      => 'manage posts'
            ),
            array(
                'name'      => 'manage_users',
                'display_name'      => 'manage users'
            ),
            array(
                'name'      => 'manage_roles',
                'display_name'      => 'manage roles'
            )
        );

        DB::table('permissions')->insert( $permissions );

        DB::table('permission_role')->delete();


        $role_id = Role::where('name', '=', 'admin')->first()->id;

        $per1 = Permission::where('name' , '=', 'manage_users')->first()->id;
        $per2 = Permission::where('name' , '=', 'manage_blogs')->first()->id;
        $per3 = Permission::where('name' , '=', 'manage_posts')->first()->id;
        $per4 = Permission::where('name' , '=', 'manage_roles')->first()->id;
        $permissions = array(
            array(
                'role_id'      => $role_id,
                'permission_id' => $per1
            ),
            array(
                'role_id'      => $role_id,
                'permission_id' => $per2
            ),
            array(
                'role_id'      => $role_id,
                'permission_id' => $per3
            ),
            array(
                'role_id'      => $role_id,
                'permission_id' => $per4
            )
        );

        DB::table('permission_role')->insert( $permissions );
    }

}