<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		// DB::table('ObjectDataTableSeeder')->delete();
		// DB::table('LevelTableSeeder')->delete();
		// DB::table('GameTableSeeder')->delete();
		// DB::table('VersionTableSeeder')->delete();
		// DB::table('CommentTableSeeder')->delete();
		// DB::table('PostTableSeeder')->delete();
		// DB::table('UserTableSeeder')->delete();

		$this->call('UserTableSeeder');
		$this->call('PostTableSeeder');
		$this->call('CommentTableSeeder');
		$this->call('VersionTableSeeder');
		$this->call('GameTableSeeder');
		$this->call('LevelTableSeeder');
		$this->call('CallTableSeeder');
	}

}
