<?php


class PostTableSeeder extends Seeder {

	public function run()
	{
		$post1 = new Post;
		$post1->title = 'first test';
		$post1->body= 'lasdjfa;lfja;lfjas;flajsdf;laj';
		$post1->user_id = 1;
		$post1->save();

		$post2 = new Post;
		$post2->title = 'second test';
		$post2->body = 'second a;lsdfja;lfja;sdlkfjas;lfas;fja;laskdftest';
		$post2->user_id = 1;
		$post2->save();

		$post3 = new Post;
		$post3->title = 'second test';
		$post3->body = 'third alsdja;kfja;slfkjasdf;l test';
		$post3->user_id = 1;
		$post3->save();
	}
}