## Blog para OlCms

### Instalar o BlogCms

```console
$ composer require orlandolibardi/blogcms
```
```console
$ php artisan vendor:publish --provider="OrlandoLibardi\BlogCms\app\Providers\OlCmsBlogServiceProvider" --tag="config"
```
```console
$ php artisan migrate
```
```console
$ composer dump-autoload
```
```console
$ php artisan db:seed --class=BlogAdminTableSeeder
```

# \o/



