<?php $this->pageTitle=Yii::app()->name; ?>
<div class="row clearfix">
		<div class="col-md-8 column">
<?php
$this->widget(
    'booster.widgets.TbCarousel',
    array(
			'items' => array(
				array(
						'image' => Yii::app()->baseUrl.'/images/awal.jpg',
						'label' => 'Request to Payment',
						'caption' => 'Metode Bisnis Capella : Proses Pembelian Barang'
				),
				array(
						'image' => Yii::app()->baseUrl.'/images/rtp.jpg',
						'label' => 'Request to Payment',
						'caption' => 'Metode Bisnis Capella : Proses Pembelian Barang'
				),
				array(
						'image' => Yii::app()->baseUrl.'/images/rtp1.jpg',
						'label' => 'Request to Payment',
						'caption' => 'Metode Bisnis Capella : Proses Pembelian Barang'
				),
				array(
						'image' => Yii::app()->baseUrl.'/images/rtp2.jpg',
						'label' => 'Request to Payment',
						'caption' => 'Metode Bisnis Capella : Proses Pembelian Barang'
				),
				array(
						'image' => Yii::app()->baseUrl.'/images/rtp3.jpg',
						'label' => 'Request to Payment',
						'caption' => 'Metode Bisnis Capella : Proses Pembelian Barang'
				),
				array(
						'image' => Yii::app()->baseUrl.'/images/otc.jpg',
						'label' => 'Order to Cash',
						'caption' => 'Metode Bisnis Capella : Proses Penjualan Barang'
				),
				array(
						'image' => Yii::app()->baseUrl.'/images/otc1.jpg',
						'label' => 'Order to Cash',
						'caption' => 'Metode Bisnis Capella : Proses Penjualan Barang'
				),
			),
    )
);?>
</div>
<div class="col-md-4 column">
</div>
</div>
<div class="row clearfix">
            <div class="col-md-7 column">
						<?php
							$article = Article::model()->findallbysql('select articleid,title,introtext from article where isnewsflash = 0 order by createddate desc  limit 1');
							foreach ($article as $row)
							{
								echo "<h2>".$row['title']."</h2>";
								echo $row['introtext'];
								echo "<p><a class='btn btn-default' href='article?view=".$row['articleid']."'>Baca Selengkapnya</a></p>";
							}											
						?>
            </div>
             <div class="col-md-5 column">
						<?php
							$article = Article::model()->findallbysql('select articleid,title,introtext from article where isnewsflash = 1 order by createddate desc  limit 1');
							foreach ($article as $row)
							{
								echo "<h2>".$row['title']."</h2>";
								echo $row['introtext'];
								echo "<p><a class='btn btn-default' href='article?view=".$row['articleid']."'>Baca Selengkapnya</a></p>";
							}		
						?>
						</div>
    </div>
</div>
</div>