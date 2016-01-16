<?php


class LevelTableSeeder extends Seeder {

	public function run()
	{
		$lvl = new Level;
		$lvl->game_id = 1;
		$lvl->level_name = 'First Lvl';
		$lvl->save();
	}
}