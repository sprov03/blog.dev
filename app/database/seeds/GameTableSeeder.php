<?php


class GameTableSeeder extends Seeder {

	public function run()
	{
		$game = new Game;
		$game->game= 'First game';
		$game->save();

	}
}