## Blogtizen

Blogtizen is a simple blog made with Laravel framework. You can make your own blog or starting for new project with Blogtizen as a template. See the demo to know all features

## Version
- Blogtizen: 1.0.0
- Laravel: 8.x

## System Required
- PHP: 8.0 or higher

## Simple Installation

1. First, clone this repo `git clone https://github.com/themedesu/blogtizen.git`

2. Make sure your database environment already to use.

3. Copy `.env.example` to `.env` in your project directory

4. Setup with your database environtment

5. Move to the terminal, `composer install`

6. Then, run `php artisan key:generate`

7. Then, run `php artisan migrate:refresh --seed`

8. Finally, run `php artisan serve`

Now move to browser, input your laravel local development `http://localhost:8000/` 

## Login Credential

You can see the credential info for user sign-in in seeder `database/seeders/UsersTableSeeder`. If you dont change anything inside the users seeder, so the creadential will looks like:

```
username: admin@admin.com
password: admin@admin.com
```

## Things you shoud know
1. Several package for this project (see composer.json file) already costumized. If you want to publish vendor, **Please spesify the vendor that you want to publish, Do not publish all vendors**. So, it will make duplicate or even current costumized will be replaced.
2. We make the dynamic menu globally as a Provider, so make sure the database is already migrated. If not you would have an error even just for Laravel serve

## License
Blogtizen build with Laravel framework open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT). And this project includes several packages, please see the license on each package.
