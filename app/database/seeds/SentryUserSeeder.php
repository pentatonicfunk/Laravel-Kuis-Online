<?php

class SentryUserSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        Sentry::getUserProvider()->create(array(
            'email'     => 'admin@demo.com',
            'password'  => 'admin',
            'activated' => 1,
        ));

        Sentry::getUserProvider()->create(array(
            'email'     => 'user@demo.com',
            'password'  => 'user',
            'activated' => 1,
        ));
    }

}