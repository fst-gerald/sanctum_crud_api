## Prepare project and run with Docker Compose

### Start containers
```bash
$ docker-compose up -d
```

### Install dependencies
```bash
$ docker-compose exec app bash
```
then
```bash
$ composer install
```
```bash
$ php artisan migrate --seed
```

## Run project with sail
This will only work after the installation of dependencies.

### Set environment variables
```bash
$ alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'
```

### Start project
```bash
$ sail up -d
```

### Inside container
```bash
$ sail bash
```
