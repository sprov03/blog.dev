<?php


class CommentTableSeeder extends Seeder {

	public function run()
	{
		$user = User::all()->random();

		$post1 = new Comment;
		
		$post1->user_id = $user->id;
		$post1->post_id= 2;
		$post1->comment = "That's Awsome man";

		$post1->save();
	}
}