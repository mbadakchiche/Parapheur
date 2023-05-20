# MESRS_Courrier
## About courrier installation 
clone the repo using : 
``` cmd
git clone https://kamelher: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@github.com/Univesity-of-msila/courrier.git
```
### commands
update your app Url in .env file.
``` env
APP_URL=http://localhost:8001
```

Run the bellow command:
```
docker-compose up -d
```
``` cmd 
docker-compose exec apache cd /app && composer update && php artisan storage:link && php artisan migrate
```
## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
