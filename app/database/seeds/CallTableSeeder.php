
<?php


class CallTableSeeder extends Seeder {

	public function run()
	{
		$data = new Call;
		$data->level_id = 1;
		$data->function = 'backgroundObj';
		$data->x = 0;
		$data->y = 85;
		$data->width= 700;
		$data->height = 15;
		$data->color = 'black';

		$data->save();
	}
}