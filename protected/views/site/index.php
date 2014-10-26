<?php 
Yii::app()->getModule('admin');
$this->pageTitle=Yii::app()->name . ' - Home';
$this->breadcrumbs=array('');?>
<?php if (Yii::app()->params['install']==true) {

$this->beginwidget(
    'booster.widgets.TbJumbotron',
    array(
        'heading' => 'Mode Instalasi',
    )
);
?>
 <p>Berhubung file config Aplikasi terdeteksi mode Instalasi,</p>
 <a href="install">Klik untuk melanjutkan</>
<?php $this->endwidget();
}
else { ?>
<div class="row clearfix">
<div class="col-md-8 column">
<?php 
$this->widget(
	'booster.widgets.TbCarousel',
	array(
		'items' => array(
			array(
				'image' => Yii::app()->baseUrl.'/images/rtp.jpg',
				'label' => 'Request to Payment',
				'caption' => 'Metode Pembelian hingga Pembayaran'
			),
			array(
				'image' => Yii::app()->baseUrl.'/images/rtp1.jpg',
				'label' => 'Request to Payment',
				'caption' => 'Metode Pembelian hingga Pembayaran'
			),
			array(
				'image' => Yii::app()->baseUrl.'/images/otc.jpg',
				'label' => 'Order to Cash',
				'caption' => 'Metode Penjualan hingga Penerimaan'
			),
		)
	)
);?>
</div>
<div class="col-md-4 column">
    <?php 
$results = Yii::app()->getDb()->createCommand();
$results->select('title,introtext,articleid')->from('article')->where('ispublish = 1 and isnewsflash = 1')->limit(2);
$results=$results->queryAll();
foreach($results AS $result)
{
	echo '<h3>'.$result['title'].'</h3>';
	echo $result['introtext'];
	echo "<br>";
	echo "<a href='".Yii::app()->createurl("article/view/",array('id'=>$result['articleid']))."'>".Catalogsys::model()->getCatalog('readmore')."</a>";
}
?><br/><br/>
</div>
</div>

<div class="row clearfix">
<div class="col-md-4 column">
 <div id="disqus_thread"></div>
<script type="text/javascript">
        /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
        var disqus_shortname = 'capella'; // required: replace example with your forum shortname

        /* * * DON'T EDIT BELOW THIS LINE * * */
        (function() {
            var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
            dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
        })();
    </script>
    <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
  
</div>
<div class="col-md-8 column">
    <?php 
$results = Yii::app()->getDb()->createCommand();
$results->select('title,introtext,articleid')->from('article')->where('ispublish = 1 and isnewsflash = 0')->limit(3);
$results=$results->queryAll();
foreach($results AS $result)
{
	echo '<h3>'.$result['title'].'</h3>';
	echo $result['introtext'];
	echo "<br>";
	echo "<a href='".Yii::app()->createurl("article/view/",array('id'=>$result['articleid']))."'>".Catalogsys::model()->getCatalog('readmore')."</a>";
}
?>
<?php $this->widget('UserOnline'); ?>
</div>
</div>

<?php } ?>
