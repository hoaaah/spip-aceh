<p align="center">
    <a href="https://bosstan.id" target="_blank">
        <img src="https://bosstan.id/avatars/HQXB-nf5MZpB_tF7sUb5npjtlAbn_WnB.png" height="100px">
    </a>
    <h1 align="center">AssessPIP</h1>
    <br>
</p>



Aplikasi ini adalah aplikasi untuk Survai Awal Pendahuluan SPIP. Anda dapat menggunakan aplikasi ini untuk kuisioner SPIP dalam rangka mengisi Form 2A dan 2B Maturitas SPIP.

Aplikasi ini disusun dalam rangka maturitas SPIP pada Perwakilan BPKP Prov. Aceh

DIRECTORY STRUCTURE
-------------------

      assets/             contains assets definition
      commands/           contains console commands (controllers)
      config/             contains application configurations
      controllers/        contains Web controller classes
      mail/               contains view files for e-mails
      models/             contains model classes
      runtime/            contains files generated during runtime
      tests/              contains various tests for the basic application
      vendor/             contains dependent 3rd-party packages
      views/              contains view files for the Web application
      web/                contains the entry script and Web resources



REQUIREMENTS
------------

The minimum requirement by this project template that your Web server supports PHP 5.4.0.


INSTALLATION
------------

Unduh aplikasi kemudian copy aplikasi pada folder www/htdocs anda. Kemudian jalankan [Composer](https://getcomposer.org/download/). Update dari terminal dengan perintah berikut.

```
cd .../spip/

composer update
```

Restore database `db.sql` pada database anda.


CONFIGURATION
-------------

### Database

Ubah file `config/db.php` dengan real database, for example:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yii2basic',
    'username' => 'root',
    'password' => '1234',
    'charset' => 'utf8',
];
```

### Parameter

Aplikasi menyimpan parameter Pemda dan Unit Kerja pada file konfigurasi, bukan database.

Ubah file `config/params.php` dengan real data, for example:

```php
return [
    'adminEmail' => 'admin@example.com',
    'pemda_id' => '01.05',
    'tahun' => 2018,
    'unit' => [
        1 => "Inspektorat Kabupaten Aceh Tengah",
        2 => "Badan Kepegawaian dan Pengembangan SDM",
        3 => "Badan Pengelola Keuangan Kabupaten Aceh Tengah",
        4 => "Badan Perencanaan Pembangunan Daerah",
        5 => "Dinas Pekerjaan Umum dan Penataan Ruang",
        6 => "Dinas Kesehatan",
        7 => "Dinas Komunikasi dan Informatika",
        8 => "Dinas Penanaman Modal dan Perizinan",
        9 => "Dinas Perikanan",
        10 => "Dinas Pertanian",
        11 => "Dinas Pendidikan",
    ]
];

```

### User Configuration

Aplikasi menyimpan konfigurasi user pada file, bukan database.

Ubah file `models/user.php` dan ubah username dan password anda. for example:

```php
    private static $users = [
        '100' => [
            'id' => '100',
            'username' => 'admin',
            'password' => 'admin',
            'authKey' => 'test100key',
            'accessToken' => '100-token',
        ],
        '101' => [
            'id' => '101',
            'username' => 'demo',
            'password' => 'demo',
            'authKey' => 'test101key',
            'accessToken' => '101-token',
        ],
    ];

```

Anda dapat mengubah password admin anda, namun username admin tidak boleh diubah karena username ini yang dapat melakukan validasi. Sedangkan user demo dapat anda ubah sesuai kebutuhan anda.


### Akses App

Secara default anda dapat mengakses aplikasi pada `http://localhost/spip/web`. Namun untuk kenyamanan penggunaan anda dapat membuat alias pada konfigurasi apache anda.

## Creator

AssessPIP was created by and is maintained by **[Heru Arief Wijaya](http://belajararief.com/)**.

* https://twitter.com/hoaaah
* https://github.com/hoaaah