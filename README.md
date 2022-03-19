
# Vending Machine API Application

<p align="center">
  <img src="http://img.shields.io/static/v1?label=License&message=MIT&color=green&style=for-the-badge"/>
  <img src="http://img.shields.io/static/v1?label=PHP&message=7.4&color=red&style=for-the-badge&logo=php"/>
  <img src="http://img.shields.io/static/v1?label=Laravel&message=8.0.2&color=red&style=for-the-badge&logo=laravel"/>
  <img src="http://img.shields.io/static/v1?label=TESTES&message=%3E20&color=GREEN&style=for-the-badge"/>
  <img src="http://img.shields.io/static/v1?label=STATUS&message=EM%20DESENVOLVIMENTO&color=RED&style=for-the-badge"/>
  <br>Aplikasi vending machine berbasis restfull API
</p>



### Instalasi 
- clone repositori
- install defedensi ``composer install``
- buat file envirotment dan koneksi database ```.env```
- migrasi database dan data sample dengan perintah ```php artisan migrate --seed```
- jalankan server ```php artisan serve```

### Endpoint API
- login aplikasi path ```localhost:8000/api/login``` contoh client jquery:
    ```javascript 
        var form = new FormData();
            form.append("email", "admin@admin.com");
            form.append("password", "password");

        var settings = {
                "url": "localhost:8000/api/login",
                "method": "POST",
                "timeout": 0,
                "processData": false,
                "mimeType": "multipart/form-data",
                "contentType": false,
                "data": form
            };

        $.ajax(settings).done(function (response) {
                console.log(response);
        });
    ```
- Proses order ```localhost:8000/api/masukan-uang``` contoh:
    ```javascript
    var form = new FormData();
    form.append("uang", "2000");
    var settings = {
                        "url": "localhost:8000/api/masukan-uang",
                        "method": "POST",
                        "timeout": 0,
                        "headers": {
                            "Accept": "application/json",
                            "Authorization": "Bearer 11|bt44pnm9se1VwYvKQpD6D7q4DHO88wjjE5qEuUqk"
                        },
                        "processData": false,
                        "mimeType": "multipart/form-data",
                        "contentType": false,
                        "data": form
                    };

    $.ajax(settings).done(function (response) {
            console.log(response);
    });
    ```
- Proses terima makanan ```localhost:8000/api/pilih-makanan``` contoh:
    ```javascript
        var form = new FormData();
        form.append("makanan", "biskuit");
        form.append("order_id", "2");

        var settings = {
                        "url": "localhost:8000/api/pilih-makanan",
                        "method": "POST",
                        "timeout": 0,
                        "headers": {
                            "Authorization": "Bearer 11|bt44pnm9se1VwYvKQpD6D7q4DHO88wjjE5qEuUqk"
                        },
                        "processData": false,
                        "mimeType": "multipart/form-data",
                        "contentType": false,
                        "data": form
                 };

        $.ajax(settings).done(function (response) {
                console.log(response);
        });
    ```
