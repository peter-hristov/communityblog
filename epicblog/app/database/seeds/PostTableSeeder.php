<?php

class PostTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('posts')->delete();

        Post::create(array(
            'user_id' => 1,
            'title' => 'This is the first title!',
            'body' => 'This is the first body to the first title. So Awesome.',
        ));

        Post::create(array(
            'user_id' => 2,
            'title' => 'This is a WW2 title. Cause its thesecond',
            'body' => 'Here we go again',
        ));

        Post::create(array(
            'user_id' => 2,
            'title' => 'Lorem Ipsum something, something',
            'body' => 'You didn\'t think you\'d get away without this did you?',
        ));

        Post::create(array(
            'user_id' => 2,
            'title' => 'Something, something in the month of may',
            'body' => 'Something something something else would it something something else',
        ));
    }

}
