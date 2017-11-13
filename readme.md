# README #

This is the sample Voucher Pool Rest API. The methods implemented are:

* /api/recipients : list all recipients
* /api/generateVouchers : generate vouchers
* /api/useVoucher : use voucher code
* /api/getValidVoucher : return valid voucher for a given email
* /api/getUsedVoucher : return used voucher for a given email

## Application Archtecture ##

The application is using the 'Lumen' framework. The access to the database is done using its 'ORM' feature. For 'unity testing' purposes, I used the 'Repository Pattern'.

All the application logic is in the service layer (VoucherService.php). For 'unity testing' purposes, the repositories are injected by 'Dependency Injection'.

The My SQL was generate with migrations using the command 'Php Artisan Migrate'.

The routes are redirected to VoucherController.php, wich is resposible for input validantion and call service layer.

The unit tests using 'Phpunit' are over the service layer, where the repositories are 'Mocked'. All the VoucherService.php bussiness rules are covered by tests.

## How do I get set up? ##

* Install PHP 7.1
* Install composer
* Lumem Micro Framework is already installed
* To access the application run in command line: php -S localhost:8000 -t public
* Database configuration in Mysql free provider. Connection parameters in.env file:
	* DB_CONNECTION=mysql
	* DB_HOST=sql10.freemysqlhosting.net
	* DB_PORT=3306
	* DB_DATABASE=sql10204405
	* DB_USERNAME=sql10204405
	* DB_PASSWORD=e3Xq4jwcsl
* How to run tests: ./vendor/bin/phpunit .\tests\TestVouvherService.php

## Postman Collection Runner ##

Postman exported file is in the root directory PhpVoucher.postman_collection.json
