<?php 
					/**
					 * @Project BNC v2 -> Adminuser
					 * @File /data/www/superweb/ad/tmp/tpl/template/blocksupport.php 
					 * @Author Quang Chau Tran (quangchauvn@gmail.com) 
					 */
					if(!defined('BNC_CODE')) {
					    exit('Access Denied');
					}
					?><link rel="stylesheet" type="text/css" href="<?=$_B['home_theme']?>assets/global/plugins/bootstrap-editable/bootstrap-editable/css/bootstrap-editable.css"/>

<!-- BEGIN PAGE CONTENT-->
<div class="row">
<div class="col-md-12">
<form class="form-horizontal form-row-seperated" action="http://dev2.webbnc.vn/template-ajaxBlockcustom-lang-<?=$_GET['lang']?>" id="form_slidelist" class="form-horizontal" enctype="multipart/form-data" method="POST">
<input type="hidden" value="deleteMultiID" name="action">
<div class="portlet">
<div class="portlet-title">
<div class="caption">
<i class="fa fa-navicon"></i><?php echo lang('hotrotructuyen');?>
</div>
<div class="actions btn-set btn-del">
<a  class="btn red continue delete_slide_select disabled"><i class="fa fa-trash-o"></i> <?php echo lang('delete');?></a>
</div>
<div class="actions btn-set">
<a href="<?=$_DATA['link_add']?>" class="btn green continue"><i class="fa fa-plus"></i> <?php echo lang('add');?></a>
</div> 
</div>
<div class="portlet-body">
<?php if(isset($_SESSION['error_submit'])) { ?>
<div class="alert alert-danger">
<button class="close" data-close="alert"></button>
<?php echo show_ss('error_submit');?>
</div>
<?php } ?> 
<?php if(isset($_SESSION['success'])) { ?>
<div class="alert alert-success">
<button class="close" data-close="alert"></button>
<?php echo show_ss('success');?>
</div>
<?php } ?> 

<div class="alert alert-danger display-hide">
<button class="close" data-close="alert"></button>
<?php echo lang('notify_error');?>
</div>

<div class="alert alert-success display-hide">
<button class="close" data-close="alert"></button>
<?php echo lang('notify_success');?>
</div> 
<div class="tabbable">
<ul class="nav nav-tabs">
<?php if(is_array($_DATA['lang_tab'])) { foreach($_DATA['lang_tab'] as $k_lang => $v_lang) { ?>
<li <?php if($k_lang==$_DATA['lang']) { ?>class="active"<?php } ?> >
<a href="<?=$v_lang['url']?>" class="lang_map_not" data-lang="<?=$k_lang?>"><?php echo lang('lang_'.$k_lang);?> </a>
</li>
<?php } } ?>
</ul>
</div>
<?php if(!empty($_DATA['content'])) { ?>
<div class="table-scrollable">
<table id="slidelist" data-lang="<?=$_GET['lang']?>" class="table table-striped table-bordered table-advance table-hover ">
<thead>
<tr>
<th width="20">
<input type="checkbox" id="checkboxAll">
</th>
<th class="highlight">
<?php echo lang('label_title_block');?>
</th>

<th width="120">
<?php echo lang('action');?>
</th>
</tr>
</thead>
<tbody>								
<?php if(is_array($_DATA['content'])) { foreach($_DATA['content'] as $k => $v) { ?>
<tr id="tr_<?=$v['id']?>" data-key="<?=$v['id']?>" data-lang="<?=$_GET['lang']?>">
<input type="hidden" name="name"  value="deleteMuti">
<input type="hidden" name="lang"  value="<?=$_GET['lang']?>">
<td class="highlight">
<input type="checkbox" name="id[]" class="checkboxes"  value="<?=$v['id']?>">
</td>

<td >
<span data-pk="<?=$v['id']?>"  data-type="text" data-lang="<?=$_GET['lang']?>" class=" editable-click  " data-original-title="<?php echo lang('click_edit');?>"><?=$v['title']?></span>
</td>

<td class="icon_btn">
<a href="/template-support-edit-<?=$v['id']?>-lang-<?=$_GET['lang']?>" class="btn default btn-xs yellow " data-placement="top" data-original-title="<?php echo lang('edit');?>"><i class="fa fa-edit"></i></a>
<a  class="btn default btn-xs red tooltips delete_slide"  data-placement="top" data-original-title="<?php echo lang('delete');?>"><i class="fa fa-trash-o"></i></a>
</td> 
</tr>



<?php } } ?>
</tbody>
</table>
</div>
<?php } else { ?>
<div class="alert alert-warning">
<center> <?php echo lang('notfound');?> </center>
</div>
<?php } ?>
<?php if(isset($content['pagination'])) { ?>
<?=$content['pagination']['pagination']?>
<?php } ?>

</div>				
</div>
</form>
</div>
</div>

<!-- BEGIN PLUGINS USED BY X-EDITABLE -->
<script type="text/javascript" src="<?=$_B['home_theme']?>assets/global/plugins/bootstrap-editable/bootstrap-editable/js/bootstrap-editable.js"></script>
<script type="text/javascript" src="<?=$_B['home_theme']?>assets/global/plugins/bootstrap-editable/inputs-ext/address/address.js"></script>
<link href="<?=$_B['mod_theme']?>css/style.css" rel="stylesheet" type="text/css" />
<!-- END X-EDITABLE PLUGIN -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?=$_B['mod_theme']?>js/blockcustomlist.js"></script>
<script type="text/javascript" laguage="javascript">
var positions_source=[<?php if(is_array($positions)) { foreach($positions as $k => $v) { ?>{value: <?=$k?>,text: "<?=$v?>"},<?php } } ?>];
    jQuery(document).ready(function() {    
       BlockCustomList.init();       
    });
</script>
<!-- END JAVASCRIPTS -->
