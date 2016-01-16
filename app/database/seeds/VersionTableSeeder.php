<?php


class VersionTableSeeder extends Seeder {

	public function run()
	{
		$version = new Version;
		$version->versions= 'First version';
		$version->save();

	}
}