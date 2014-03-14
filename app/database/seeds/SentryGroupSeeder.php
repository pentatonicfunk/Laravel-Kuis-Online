<?php

class SentryGroupSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('groups')->delete();

        Sentry::getGroupProvider()->create(array(
            'name'        => 'User',
            'permissions' => array(
                'admin' => 0,
            )));

        Sentry::getGroupProvider()->create(array(
            'name'        => 'Admin',
            'permissions' => array(
                'admin' => 1,
            )));
    }

}