<?php 
					/**
					 * @Project BNC v2 -> Adminuser
					 * @File /data/www/superweb/ad/tmp/tpl/media/mediaEditor.php 
					 * @Author Quang Chau Tran (quangchauvn@gmail.com) 
					 */
					if(!defined('BNC_CODE')) {
					    exit('Access Denied');
					}
					?>
<!-- 
<script type="text/javascript" src="https://getfirebug.com/firebug-lite.js"></script>
-->

<script src="<?=$_B['mod_theme']?>jquery/jquery-1.8.1.min.js" type="text/javascript" charset="utf-8"></script>


<!-- <script src="jquery/jquery-ui-1.8.21.custom.min.js"></script> -->
<!-- <script src="jquery/jquery-ui-1.8.23.custom.min.js" type="text/javascript" charset="utf-8"></script> -->
<!-- <link rel="stylesheet" href="jquery/ui-themes/smoothness/jquery-ui-1.8.23.custom.css" type="text/css" media="screen" title="no title" charset="utf-8"> -->

<script src="<?=$_B['mod_theme']?>jquery/jquery-ui-1.10.1.custom.min.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" href="<?=$_B['mod_theme']?>jquery/ui-themes/smoothness/jquery-ui-1.10.1.custom.css" type="text/css" media="screen" title="no title" charset="utf-8">


<!-- <link rel="stylesheet" href="jquery/ui-themes/smoothness/jquery-ui-1.8.21.custom.css" type="text/css"> -->


<link rel="stylesheet" href="<?=$_B['mod_theme']?>css/common.css"      type="text/css">
<link rel="stylesheet" href="<?=$_B['mod_theme']?>css/dialog.css"      type="text/css">
<link rel="stylesheet" href="<?=$_B['mod_theme']?>css/toolbar.css"     type="text/css">
<link rel="stylesheet" href="<?=$_B['mod_theme']?>css/navbar.css"      type="text/css">
<link rel="stylesheet" href="<?=$_B['mod_theme']?>css/statusbar.css"   type="text/css">
<link rel="stylesheet" href="<?=$_B['mod_theme']?>css/contextmenu.css" type="text/css">
<link rel="stylesheet" href="<?=$_B['mod_theme']?>css/cwd.css"         type="text/css">
<link rel="stylesheet" href="<?=$_B['mod_theme']?>css/quicklook.css"   type="text/css">
<link rel="stylesheet" href="<?=$_B['mod_theme']?>css/commands.css"    type="text/css">
<link rel="stylesheet" href="<?=$_B['mod_theme']?>css/fonts.css"       type="text/css">
<link rel="stylesheet" href="<?=$_B['mod_theme']?>css/theme.css"       type="text/css">

<!-- elfinder core -->
<script src="<?=$_B['mod_theme']?>js/elFinder.js"></script>
<script src="<?=$_B['mod_theme']?>js/elFinder.version.js"></script>
<script src="<?=$_B['mod_theme']?>js/jquery.elfinder.js"></script>
<script src="<?=$_B['mod_theme']?>js/elFinder.resources.js"></script>
<script src="<?=$_B['mod_theme']?>js/elFinder.options.js"></script>
<script src="<?=$_B['mod_theme']?>js/elFinder.history.js"></script>
<script src="<?=$_B['mod_theme']?>js/elFinder.command.js"></script>

<!-- elfinder ui -->
<script src="<?=$_B['mod_theme']?>js/ui/overlay.js"></script>
<script src="<?=$_B['mod_theme']?>js/ui/workzone.js"></script>
<script src="<?=$_B['mod_theme']?>js/ui/navbar.js"></script>
<script src="<?=$_B['mod_theme']?>js/ui/dialog.js"></script>
<script src="<?=$_B['mod_theme']?>js/ui/tree.js"></script>
<script src="<?=$_B['mod_theme']?>js/ui/cwd.js"></script>
<script src="<?=$_B['mod_theme']?>js/ui/toolbar.js"></script>
<script src="<?=$_B['mod_theme']?>js/ui/button.js"></script>
<script src="<?=$_B['mod_theme']?>js/ui/uploadButton.js"></script>
<script src="<?=$_B['mod_theme']?>js/ui/viewbutton.js"></script>
<script src="<?=$_B['mod_theme']?>js/ui/searchbutton.js"></script>
<script src="<?=$_B['mod_theme']?>js/ui/sortbutton.js"></script>
<script src="<?=$_B['mod_theme']?>js/ui/panel.js"></script>
<script src="<?=$_B['mod_theme']?>js/ui/contextmenu.js"></script>
<script src="<?=$_B['mod_theme']?>js/ui/path.js"></script>
<script src="<?=$_B['mod_theme']?>js/ui/stat.js"></script>
<script src="<?=$_B['mod_theme']?>js/ui/places.js"></script>

<!-- elfinder commands -->
<script src="<?=$_B['mod_theme']?>js/commands/back.js"></script>
<script src="<?=$_B['mod_theme']?>js/commands/forward.js"></script>
<script src="<?=$_B['mod_theme']?>js/commands/reload.js"></script>
<script src="<?=$_B['mod_theme']?>js/commands/up.js"></script>
<script src="<?=$_B['mod_theme']?>js/commands/home.js"></script>
<script src="<?=$_B['mod_theme']?>js/commands/copy.js"></script>
<script src="<?=$_B['mod_theme']?>js/commands/cut.js"></script>
<script src="<?=$_B['mod_theme']?>js/commands/paste.js"></script>
<script src="<?=$_B['mod_theme']?>js/commands/open.js"></script>
<script src="<?=$_B['mod_theme']?>js/commands/rm.js"></script>
<script src="<?=$_B['mod_theme']?>js/commands/info.js"></script>
<script src="<?=$_B['mod_theme']?>js/commands/duplicate.js"></script>
<script src="<?=$_B['mod_theme']?>js/commands/rename.js"></script>
<script src="<?=$_B['mod_theme']?>js/commands/help.js"></script>
<script src="<?=$_B['mod_theme']?>js/commands/getfile.js"></script>
<script src="<?=$_B['mod_theme']?>js/commands/mkdir.js"></script>
<script src="<?=$_B['mod_theme']?>js/commands/mkfile.js"></script>
<script src="<?=$_B['mod_theme']?>js/commands/upload.js"></script>
<script src="<?=$_B['mod_theme']?>js/commands/download.js"></script>
<script src="<?=$_B['mod_theme']?>js/commands/edit.js"></script>
<script src="<?=$_B['mod_theme']?>js/commands/quicklook.js"></script>
<script src="<?=$_B['mod_theme']?>js/commands/quicklook.plugins.js"></script>
<script src="<?=$_B['mod_theme']?>js/commands/extract.js"></script>
<script src="<?=$_B['mod_theme']?>js/commands/archive.js"></script>
<script src="<?=$_B['mod_theme']?>js/commands/search.js"></script>
<script src="<?=$_B['mod_theme']?>js/commands/view.js"></script>
<script src="<?=$_B['mod_theme']?>js/commands/resize.js"></script>
<script src="<?=$_B['mod_theme']?>js/commands/sort.js"></script>	
<script src="<?=$_B['mod_theme']?>js/commands/netmount.js"></script>	

<!-- elfinder languages -->

<script src="<?=$_B['mod_theme']?>js/i18n/elfinder.vi.js"></script>

<!-- elfinder dialog -->
<script src="<?=$_B['mod_theme']?>js/jquery.dialogelfinder.js"></script>

<!-- elfinder 1.x connector API support -->
<script src="<?=$_B['mod_theme']?>js/proxy/elFinderSupportVer1.js"></script>

<!-- elfinder custom extenstions -->
<script src="<?=$_B['mod_theme']?>extensions/jplayer/elfinder.quicklook.jplayer.js"></script>



<script type="text/javascript" charset="utf-8">
    // Helper function to get parameters from the query string.
    function getUrlParam(paramName) {
        var reParam = new RegExp('(?:[\?&]|&amp;)' + paramName + '=([^&]+)', 'i') ;
        var match = window.location.search.match(reParam) ;

        return (match && match.length > 1) ? match[1] : '' ;
    }

    $().ready(function() {
        var funcNum = getUrlParam('CKEditorFuncNum');

        var elf = $('#finder').elfinder({
            url : 'http://cdn.anvui.vn/code/connector.php?bncUpload=<?=$bncUpload?>',
            lang : 'vi',
            getFileCallback : function(file) {
                window.opener.CKEDITOR.tools.callFunction(funcNum, file.url);
                window.close();
            },
            resizable: false
        }).elfinder('instance');
    });
</script>

<div id="finder"></div>	


