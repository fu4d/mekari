# Petunjuk Instalasi

Tentang system
Ini adalah program CRUD Sederhana menggunakan Laravel 5.2 Angular dan Jquery
Tahap Instalasi:
Dalam system ini sudah dibuatkan custom comman untuk membuat database. Sehingga untuk langkah pertama adalah menjalankan perintah "php artisan make:database db_name "
Configurasi environment

Buka file .env yang ada di root directory. Edit koneksi database yang akan digunakan pada baris berikut:
DB_CONNECTION: mysql
DB_HOST: ip_or_hostname
DB_PORT: 3306
DB_USERNAME: mysql_user
DB_PASSWORD: mysql_password
DB_DATABASE: database_name_yang barusan dibuat
Install table

lakukan perintah "php artisan migrate" untuk menginstall semua migration table yang pernah dibuat
jalankan system

kemudian jalankan server dengan melakukan perintah "php artisan serve". selanjutnya kita bisa mengakses dengan alamat http://localhost:8000/


# Dokumentasi

## Install

$ composer create-project laravel/laravel project_name --prefer-dist 5.2.*



## Test Jalankan project

$  php artisan serve


## Membuat console command untuk create database

$ php artisan make:console CreteDatabase

	* Selanjutnya buka file Create Database pada app/Console/Commands/CreateDatabase.php
		- Pada bagian handle() tambbahkan command berikut
			\DB::Statement("CREATE DATABASE ".$this->argument('name'));
		- Pada bagian protected $signature tambahkan menjadi seperti berikut
			protected $signature = 'make:database {name}' // command ini yang akan digunakan pada  console untuk membuat DB baru

		- Tambahkan fungsi berikut:
			protected  getArguments(){
				returns [
					['name', inputArgument::REQUIRED,'Database Name']
				];
			}

		- Buka  file kernel pada app/Console/Kernel.php dan  baris code $commands tambahkan nilai array seperti berikut:
			protected $commands = [
					Commands/CreateDatabase::class
				];

$ php artisan make:database db_name

## Persiapan Environment Laravel
	Buka file .env yang ada di root directory. Edit koneksi database yang akan digunakan pada baris berikut
		DB_CONNECTION: mysql
		DB_HOST: ip_or_hostname
		DB_PORT: 3306
		DB_USERNAME: mysql_user
		DB_PASSWORD: mysql_password
		DB_DATABASE: database_name


## Membuat database tabel

$ php artisa make:migration create_tablenames_table --create=tablenames

	- Buka file migration yang telah digenerate di database/migrations/000_00_000000_create_tablenames_table.php
	- Kemudian sesuaikan  fields yang akan dibuat pada bagian up(){ ... } seperti berikut ini:
		public function up(){
			Schema::create('tablenames', function (Blueprint $table){
				$table->increments('tableid');
				$table->integer('order_number');
				$table->string('fname');
				$table->string('lname');
				$table->float('subtotal',9,0);
				$table->float('shipping_fee',9,0);
				$table->float('grandtotal',10,0);
				$table->timestamps();
			});
		}

$ php artisan migrate  #  mengeksekusi file miration untuk membuat database sesuai yang telah didefinisikan sebelumnya di file migration


## Mengubah (alter) tabel

$ php artisan make:migration add_newfield_to_tablenames_table --table=orders

	- Buka file migration 0000_00_00_add_discount_to_orders_table kemudian seuaikan function dengan menambahkan fields yang dimaksud sperti berikut:
		up(){
			Schema::table('tablenames',function(Blueprint $table){
				$table->float('discount',8,0);
			});
		}

$ php artisan migrate


## Create Controller

$ php artisan make:controller NewController --resource

	- Open the generated file in app/http/controller/NewController.php and make your changing
	- if you want to use view we define view in controller function like below:

	public function functionName(){
		// put your logic here to get data
		return view('bladeName')->withData(data);
	}

## Persiapan source css, javascript, dan image
	Buat direktory css, js, dan images pada direktori public. direktory tersebut dapat dipanggil dengan tag {{asset('css/namaFile.css')}} atau {{asset('js/namaFile.js')}} atau {{asset('images/namaFile.png')}}

## Membuat blade view

untuk view sebaiknya dibuat beberapa bagian yaitu layout, component, dan page. di mana layout merupakan susunan skeleton tampilan secara general. Seadngkan component meripakan kumpulan dari part-part halaman yang biasa dan dapat digunakan secara berulang seperti head, header, footer, modal, navbar, left dan right columns. Dan yang terakhir adalah page yang merupakan kumpulan bagian yang akan menampilkan content utama dari setiap halaman. Sehingga strukturnya akan seperti ini contohnya:

- views
-- layouts
-- components
-- pages

	* membuat components  blade pada direktory views/components
		# head.blade.php
			<meta name="description" content="">
			<script type="text/javascript" src="{{asset('js/jquery-3.4.1.min.js')}}"></script>
			@yield('additionaljs')
			<link rel="stylsheet" type="text/css" href="{{asset('css/boostrap.min.css')}}"/>
			@yield('additionalcss')

		# header.blade.php
			<div class="logo">
				<a href=""><img src="{{asset('images/main/logo.png')}}" title="logo" /></a>
			</div>
			<nav class="navbar">
				<ul class="main-navbar">
					<li>Menu</li>
					<li>Menu2</li>
					<li>Menu3</li>
					<li>Menu4</li>
					<li>Menu5</li>
				</ul>
			</nav>

		# footer.blade.php
			<div class="footer-content col-sm-12">
				<div class="footer-nav col-sm-4">

				</div>
				<div class="footer-services col-sm-4">

				</div>
				<div class="footer-form col-sm-4">

				</div>
			</div>

			<div class="footer-copyright col-sm-12">

			</div>


	* membuat file layout utama dengan contoh nama base.blade.php pada direktori app/view/layouts/base.blade.php
		<html>
			<head>
				@include('components.head')
			</head>

			<body>
				<div class="container">
					<header class="row">
						@include('components.header')
					</header>

					<main id="main" class="row">
						@yield('content')
						@yield('customjs')
					</main>

					<footer class="row">
						@include('components.footer')
					</footer>
				</div>
			<body>
		</html>


	* mebuat page blade view, contoh:

## Membuat Router
	pada file app/Http/routes.php kita akan mendefinisikan rout url untuk setiap controller maupun page view yang akan diakses. Contoh:

	Route::resource('/','IndexController');
	Route::get('/halaman', function(){
		return view('test');
	});
