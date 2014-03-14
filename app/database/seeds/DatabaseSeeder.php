<?php

class DatabaseSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

        // $this->call('UserTableSeeder');
        $this->call('SoalsTableSeeder');
        $this->call('LembarsTableSeeder');
        $this->call('SoalhaslembarsTableSeeder');
        $this->call('UserjawablembarsTableSeeder');
        $this->call('UjiansTableSeeder');
        $this->call('SoalujiansTableSeeder');
        $this->call('SentryGroupSeeder');
        $this->call('SentryUserSeeder');
        $this->call('SentryUserGroupSeeder');
    }

}