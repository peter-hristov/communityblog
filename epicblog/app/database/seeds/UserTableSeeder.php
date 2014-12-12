<?php

class UserTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        User::create(array(
            'email' => 'moonyy@abv.bg',
            'username' => 'FamousCake',
            'password' => '123'
        ));

        User::create(array(
            'email' => 'EpicBro@epic.com',
            'username' => 'someoneUnimportatn',
            'password' => '123'
        ));

        User::create(array(
            'email' => 'suchEmail',
            'username' => 'someone',
            'password' => '123'
        ));
    }

}