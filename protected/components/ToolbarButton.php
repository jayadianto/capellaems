<?php
Yii::import('zii.widgets.CPortlet');
class ToolbarButton extends CPortlet
{
    public $title='';
	public $cssToolbar='toolbar';
	public $id=0;
	public $isCreate=false;
	public $UrlCreate='adddata()';
	public $isEdit=false;
	public $UrlEdit='editdata()';
	public $isApprove=false;
	public $UrlApprove='approvedata()';
	public $isDelete=false;
	public $UrlDelete='deletedata()';
	public $isUpload=false;
	public $UrlUpload='uploaddata()';
	public $FileUpload=array("jpg","jpeg","gif","png");
	public $isDownload=false;
	public $UrlDownPDF='downpdf()';
	public $UrlDownExcel='downexcel()';
	public $isRefresh=false;
	public $UrlRefresh='refreshdata()';
	public $isSearch=false;
	public $UrlSearch='searchdata()';
	public $isHelp=false;
	public $UrlHelp='helpdata()';
	public $isRecordPage=false;
	public $OnChange='';
	public $PageSize=10;
	public $OnClick='';
	public $isHelpModif=false;
	public $UrlHelpModif='helpmodifdata()';
	public $isSave=false;
	public $UrlSave='savedata()';
	public $isCancel=false;
	public $UrlPurge='purgedata()';
	public $isPurge=false;
	public $UrlHistory='historydata()';
	public $isHistory=false;
	public $UrlCancel='canceldata()';
	public $DialogID='createdialog';
	public $DialogGrid='datagrid';
 
    protected function renderContent()
    {
        $this->render('ToolbarButton');
    }
}