<?php 
					/**
					 * @Project BNC v2 -> Adminuser
					 * @File /data/www/superweb/ad/tmp/tpl/seo/redirect_url.php 
					 * @Author Quang Chau Tran (quangchauvn@gmail.com) 
					 */
					if(!defined('BNC_CODE')) {
					    exit('Access Denied');
					}
					?>
<link rel="stylesheet" type="text/css" href="<?=$_B['home_theme']?>assets/global/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="<?=$_B['home_theme']?>assets/global/plugins/bootstrap-editable/bootstrap-editable/css/bootstrap-editable.css"/>
<link rel="stylesheet" type="text/css" href="<?=$_B['home_theme']?>assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css"/>
<link rel="stylesheet" type="text/css" href="<?=$_B['home_theme']?>assets/global/plugins/bootstrap-editable/inputs-ext/address/address.css"/>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" type="text/css" />
<!-- BEGIN PAGE CONTENT--> 
<div class="row">
<div class="col-md-12"> 
<form class="form-horizontal form-row-seperated" action="" id="form_slidelist" class="form-horizontal" enctype="multipart/form-data" method="POST">
<input type="hidden" value="deleteMultiID" name="action">
<div class="portlet">
<div class="portlet-title">
<div class="caption">
<i class="fa fa-navicon"></i><?php echo lang('chuyen_huong_url');?>
</div>

</div>
<div class="portlet-title">
<div class="portlet-body">
<div class="portlet light bordered" id="list-redirect">
<div class="form-group">
<a href="javascript:void(0)" class="btn green add_url" style="border-radius:3px !important"><i class="fa fa-plus"></i></a>
</div>	

<?php if(is_array($_DATA['content'])) { foreach($_DATA['content'] as $k => $v) { ?>		
<div class="form-group">
<div class="col-md-1">
<span class="cl_title"></span>
</div>
<div class="col-md-5">
<input type="text" class="form-control Urlstart" name="Urlstart[]" placeholder="Url hiện tại" value="<?=$v['url_source']?>">
<input type="hidden" name="id_url" value="<?=$v['id']?>" class="id_url">
</div>

<div class="col-md-5" style="padding-left:0px">
<input type="text" class="form-control Urlend" name="Urlend[]" placeholder="Url đích" value="<?=$v['url_destination']?>">
</div>

<div class="col-md-1" style="padding:0px">
<a class="btn red delete_url" style="border-radius:3px !important" href="javascript:void(0)">
<i class="fa fa-minus"></i>
</a>
</div>

</div> 
<?php } } ?>

</div>	
</div>
<div class="actions btn-set btnSet">	 							
<a href="javascript:void(0)" class="btn green url_save"><i class="fa fa-save"></i> <?php echo lang('update');?> </a>				
</div>	
</div>		
</div>
</form>
</div>

</div>

<!-- BEGIN PLUGINS USED BY X-EDITABLE -->
<script type="text/javascript">
var lang='<?=$_GET["lang"]?>';
</script>
<script type="text/javascript" src="<?=$_B['home_theme']?>assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="<?=$_B['home_theme']?>assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
<script type="text/javascript" src="<?=$_B['home_theme']?>assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
<script type="text/javascript" src="<?=$_B['home_theme']?>assets/global/plugins/moment.min.js"></script>
<script type="text/javascript" src="<?=$_B['home_theme']?>assets/global/plugins/jquery.mockjax.js"></script>
<script type="text/javascript" src="<?=$_B['home_theme']?>assets/global/plugins/bootstrap-editable/bootstrap-editable/js/bootstrap-editable.js"></script>
<script type="text/javascript" src="<?=$_B['home_theme']?>assets/global/plugins/bootstrap-editable/inputs-ext/address/address.js"></script>
<script type="text/javascript" src="<?=$_B['home_theme']?>assets/global/plugins/bootstrap-editable/inputs-ext/wysihtml5/wysihtml5.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="<?=$_B['mod_theme']?>css/style.css" rel="stylesheet" type="text/css" />
<!-- END X-EDITABLE PLUGIN -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script type="text/javascript">
var langUse="<?=$_GET['lang']?>";
</script>
<script src="<?=$_B['mod_theme']?>js/redirecturl.js" type="text/javascript"></script>
<script type="text/javascript">
jQuery(document).ready(function() {
redirect.init();
});
</script>
