<?php $this->beginwidget(
    'booster.widgets.TbJumbotron',
    array(
        'heading' => 'Capella EMS Indonesia - Proses Instalasi',
    )
);?>
<?php $this->endwidget();?>
Sebelum Anda melangkah lebih lanjut, pastikan langkah-langkah berikut sudah dilakukan:<br>
1. Buatlah database terlebih dahulu untuk Capella EMS beserta user otorisasi<br>
2. Edit file protected/config/main.php, masukkan koneksi ke databatase,contoh :<br><br>
<i>
'db'=>array(<br>
			'connectionString' => 'mysql:host=localhost;port=5000;dbname=capellaems',//koneksi database<br>
			'emulatePrepare' => true,<br>
			'username' => 'capellaems',//user database<br>
			'password' => 'capellaems',//password database<br>
			'charset' => 'utf8',<br>
			'initSQLs'=>array('set names utf8'),<br>
			'schemaCachingDuration' => 3600,<br>
			'enableProfiling'=>true<br>
		)<br>
</i><br><br>
3. Sesuaikan parameter dengan kebutuhan<br><br>
<i>
'params'=>array(<br>
		'adminEmail'=>'romy@prismagrup.com',//nama email<br>
		'defaultPageSize'=>10,//jumlah baris data per halaman<br>
		'defaultYearFrom'=>date('Y')-1,//standard tahun sebelumnya, untuk laporan komparasi<br>
		'defaultYearTo'=>date('Y'),//standard tahun sesudahnya, untuk laporan komparasi<br>
		'sizeLimit'=>10*1024*1024,//ukuran file untuk upload<br>
		'allowedext'=>array("xls","csv","xlsx","vsd","pdf","gdb","doc","docx","jpg","gif","png","rar","zip","jpeg"),//file format yang diperbolehkan upload<br>
		'language'=>INDONESIA,//bahasa standard yang digunakan<br>
		'defaultnumberqty'=>'#,##0.00',//format untuk quantity<br>
		'defaultnumberprice'=>'#,##0.00',//format untuk harga<br>
		'dateviewfromdb'=>'d-M-Y',//format untuk tanggal<br>
		'dateviewcjui'=>'dd-mm-yy',//format untuk tanggal<br>
		'dateviewgrid'=>'dd-MM-yyyy',//format untuk tanggal<br>
		'datetodb'=>'Y-m-d',//format untuk penyimpanan tanggal<br>
		'timeviewfromdb'=>'h:m',//format untuk menampilkan waktu<br>
		'datetimeviewfromdb'=>'d-M-Y h:i',//format untuk menampilkan tanggal dan jam<br>
		'timeviewcjui'=>'h:m', //format untuk tampil jam<br>
		'datetimeviewgrid'=>'dd-MM-yyyy H:m',//format untuk menampilkan tanggal dan jam di grid<br>
		'datetimetodb'=>'Y-m-d h:i',//format penyimpanan tanggal dan jam<br>
		'install'=>true // sebagai tanda untuk instalasi awal<br>
	),<br>

</i><br><br>
4. Jika sudah siap, silahkan klik Next	
