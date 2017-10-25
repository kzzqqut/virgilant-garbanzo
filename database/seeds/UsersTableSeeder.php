<?php
/**
 * Created by PhpStorm.
 * User: kzzqqut
 * Date: 10/25/17
 * Time: 9:12 PM
 */

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new \App\User();
        $user->name = 'admin';
        $user->email = 'admin@example.org';
        $user->password = bcrypt('qwerty123');
        $user->plain = 'qwerty123';
        $user->save();

        $permission = new Permission();
        $permission->name = 'Roles & Permissions';
        $permission->save();

        $role = new Role();
        $role->name = 'Admin';
        $role->save();
        $role->givePermissionTo($permission);

        $user->assignRole($role);


        $user = new \App\User();
        $user->name = 'user';
        $user->email = 'user@example.org';
        $user->password = bcrypt('qwerty123');
        $user->plain = 'qwerty123';
        $user->save();

        $permission = new Permission();
        $permission->name = 'Manage objects';
        $permission->save();

        $role = new Role();
        $role->name = 'SimpleUser';
        $role->save();
        $role->givePermissionTo($permission);

        $role = new Role();
        $role->name = 'Verified';
        $role->save();
        $role->givePermissionTo($permission);

        $user->assignRole($role);
    }
}