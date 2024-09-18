Proyek  ini bertujuan untuk membangun sebuah rancangan dari implementasi sistem pembayaran berbasis RFID pada cafe dengan menggunakan website berbasis arduino dan nodemcu dimana arduino uno R3 sebagai pengontrol utamanya. Sistem pembayaran ini memanfaatkan RFID sebagai metode pembayaran dan website sebagai media pemilihan menu pada cafe. Pada sistem ini terdapat dua sensor infrared yang akan mendeteksi pelanggan yang keluar masuk dari cafe. Dimana ketika ada pelanggan yang terdeteksi, maka motor dc akan membuka pintu secara otomatis dan LCD akan menampilkan teks. Kemudian untuk sistem pemilihan menu dan tempat duduk dapat dilakukan melalui website. Untuk pembayaran makanan dan minuman bisa dilakukan melalui cash atau card member dengan melakukan scan ke RFID. Jika terjadi kegagalan dalam pembayaran, maka led akan menyala dan buzzer akan berbunyi. Pada cafe juga terdapat sistem otomatisasi penghidupan lampu dan kipas ketika orang pertama yang memasuki cafe maka akan terdeteksi oleh sensor ultrasonik, dan untuk mematikannya bisa menggunakan button yang sudah tersedia.

Untuk Context Diagram seperti ini
![2](https://github.com/user-attachments/assets/5643abc2-2b17-4fec-900b-c1cc7ef199f1)

Untuk Cara Kerja :

1.Pada saat ada orang yang melewati pintu, sensor infrared 1 akan mendeteksi orang tersebut dan motor DC akan membuka pintu cafe secara otomatis. 

2.LCD 16x2 akan menampilkan selamat datang ketika ada orang terdeteksi oleh sensor infrared.

3.Sensor ultrasonik akan mendeteksi orang pertama yang datang, dan ketika terdeteksi oleh sensor ultrasonik maka fan sebagai pendingin ruangan dan LED 2 sebagai lampu cafe akan aktif. 

4.Untuk pemesanan, pelanggan akan login terlebih dahulu ke website yang sudah disediakan oleh pengelola. Pelanggan bisa memilih menu makanan dan juga minuman yang ingin dipesan sekaligus menentukan posisi duduk dari pelanggan tersebut untuk pelayan bisa mengantarkan pesanan melalui website. 

5.Pembayaran bagi pelanggan bisa dilakukan secara cash atau e-money bagi pelanggan yang sudah menjadi member dan memiliki card e-money dapat melakukan scan ditempat yang sudah di sediakan.

6.Buzzer dan LED akan menyala apabila ketika melakukan pembayaran menggunakan card member namun saldo pelanggan kurang.

7.Pada saat pelanggan meninggalkan cafe, sensor infrared 2 akan mendeteksi pelanggan tersebut dan akan membuka pintu kembali secara otomatis. 

8.Untuk melakukan top-up atau pengisian ulang saldo kartu, pelanggan bisa menghubungi admin atau contact person dari cafe dan pelanggan harus memberikan nomor kartu kepada admin.
