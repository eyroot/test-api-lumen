# test-api-lumen

Basic RESTful API Test with Lumen

## Set-up

* Clone project locally:
```
git clone https://github.com/eyroot/test-api-lumen test-api-lumen
cd test-api-lumen
```

* Composer install and create required local directories:
```
composer install
mkdir -p storage/logs
chmod 777 storage/logs
mkdir data
chmod 777 data
```

* Set-up virtual host (example is for Apache):
```
<VirtualHost *:80>
	ServerName test-api-lumen.localhost
	DocumentRoot /path/to/test-api-lumen/public
	<Directory /path/to/test-api-lumen/public>
		RewriteEngine On
		RewriteCond %{REQUEST_FILENAME} !-d
		RewriteCond %{REQUEST_FILENAME} !-f
		RewriteRule ^ index.php [QSA,L]
	</Directory>
</VirtualHost>
```

* Map test-api-lumen.localhost to local ip in /etc/hosts (on linux):
```
127.0.0.1    test-api-lumen.localhost
```

## Usage walkthrough

* add 3 entries
```
curl -X POST -H "Content-Type: application/json" -d '{"id": 1, "title":"The extraordinary dvd", "location":"yellow kitchen"}' http://test-api-lumen.localhost/dvds
curl -X POST -H "Content-Type: application/json" -d '{"id": 2, "title":"Magic dvd", "location":"blue lobby"}' http://test-api-lumen.localhost/dvds
curl -X POST -H "Content-Type: application/json" -d '{"id": 3, "title":"Another great movie",  "location":"orange room"}' http://test-api-lumen.localhost/dvds
```

* list the entries
```
curl -X GET -H "Content-Type: application/json" http://test-api-lumen.localhost/dvds
```

* update location for entry no 2
```
curl -X PUT -H "Content-Type: application/json" -d '{"location":"light blue lobby"}' http://test-api-lumen.localhost/dvds/2
```

* list the entries
```
curl -X GET -H "Content-Type: application/json" http://test-api-lumen.localhost/dvds
```

* add one more entry
```
curl -X POST -H "Content-Type: application/json" -d '{"id": 4, "title":"Another dvd", "location":"virtual reality"}' http://test-api-lumen.localhost/dvds
```

* list the entries
```
curl -X GET -H "Content-Type: application/json" http://test-api-lumen.localhost/dvds
```

* delete the entry
```
curl -X DELETE -H "Content-Type: application/json" http://test-api-lumen.localhost/dvds/4
```

* list the entries
```
curl -X GET -H "Content-Type: application/json" http://test-api-lumen.localhost/dvds
```

* search: list all dvds in location "orange room"
```
curl -X GET -H "Content-Type: application/json" "http://test-api-lumen.localhost/dvds/location/orange%20room"
```
