## Blog.dev was initally going a blog project at Codeup.

site is live at shawnpivonka.com

Blog.dev is a side project to allow people to make a mario style game level in canvase by draging
the mouse on the screen. Im not a blogger so i decided to make a CRUD app that makes game levels 
instead of blog post.


## Getting Started

- Clone this repository
- Create a local database for this application
- Create a '.env.local.php' file inside of 'blog.dev/'
- Add the contents of 'env-template.php' to '.env.local.php'
- Add your database logins to the values
- cd into blog.dev
- ~ composer install
- ~ php artisan migrate --seed


## Official Documentation for Laravel

Documentation for the entire framework can be found on the [Laravel website](http://laravel.com/docs).

This project is useing version 4.2. Make sure that you are not using the docs for Laravel 5.

## Updates

Feb, 7th 2015
	
	Users can create levels and play all levels compleated. 

	To do list:  Allow users to create accounts.
				 Allow users to vote on levels ( bad lvls will get deleted based on votes ).
				 Improve the Level creation interface.
				 Have a area that will save the level if the creator has beat it.
				 implement images from the server into the level creator.
				 implement alternate IA for the enemey units.


