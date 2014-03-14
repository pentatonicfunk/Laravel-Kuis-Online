##Instal
* Pastikan telah menginstall local web server (xampp / wampp / lamp, etc)
* Pastikan Service Web Server dan MysqlServer telah dalam keadaan menyala
* Salin folder "aegis kuis" pada direkori htdocs (ex . xampp/htdocs )
* Buat database dengan nama "kuis" pada mysql server
* Import kuis.sql ke dalam database kuis
* Jika anda menggunakan nama database lain atau user mysql yang lain sunting file
HTDOCS/aegis-kuis/app/config/database.php (baris 55)
* Buka pada browser dengan alamat http://localhost/aegis-kuis/public

###Default user
* Admin
* user : admin@demo.com
* password : admin

###User Biasa
* user : user@user.com
* password : user
* user : bambang@user.com
* password : bambang


##Enhanced Features :
* mobile ready
* sistem sudah termasuk untuk administrasi bank soal (kelola soal, kelola kuis, dll)
* sistem hanya mengijinkan 1 user login pada 1 tempat dan 1 browser (mencegah user yang sama membuka aplikasi di
browser / komputer berbeda)
* User diizinkin melanjutkan mengerjakan kuis, asal batas waktu belum selesai,
(misal user kehilangan koneksi internet, komputer mati, dll)
* Setelah user mengambil sebuah kuis, user tidak dapat mengambil kuis yang sama, kecuali admin menghapus riwayat
pengambilan user tersebut terjadap kuis yang dimaksud
* dan banyak lagi, selamat mencoba!