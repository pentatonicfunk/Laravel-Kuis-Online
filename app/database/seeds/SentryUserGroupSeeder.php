<?php

class SentryUserGroupSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users_groups')->delete();

        $userUser  = Sentry::getUserProvider()->findByLogin('user@demo.com');
        $adminUser = Sentry::getUserProvider()->findByLogin('admin@demo.com');

        $userGroup  = Sentry::getGroupProvider()->findByName('User');
        $adminGroup = Sentry::getGroupProvider()->findByName('Admin');

        // Assign the groups to the users
        $userUser->addGroup($userGroup);
        $adminUser->addGroup($userGroup);
        $adminUser->addGroup($adminGroup);
    }

}