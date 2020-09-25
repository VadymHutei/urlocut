# Urlocut

## start
```
php -S localhost:9000
```

## db
```
docker run --name urlocut_db -d --restart always -v /home/dev/urlocut/mysql_data:/var/lib/mysql -e MYSQL_ROOT_PASSWORD=root -p 3306:3306 mysql:5
```
