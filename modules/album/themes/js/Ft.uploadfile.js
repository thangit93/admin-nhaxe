/*
 * jQuery Upload File Plugin
 * https://twitter.com/tamchilu
 */
(function ($) {
	/*
    if ($.fn.ajaxForm == undefined) {
        $.getScript("js/jquery.form.js");
    }*/
    var feature = {};
    feature.fileapi = $("<input type='file'/>").get(0).files !== undefined;
    feature.formdata = window.FormData !== undefined;

    $.fn.uploadFile = function (options) {
        // This is the easiest way to have default options.
        var s = $.extend({
            // These are the defaults.
            url: "",
            method: "POST",
            enctype: "multipart/form-data",
            formData: null,
            returnType: null,
            allowedTypes: "*",
            fileName: "file",
            formData: {},
            dynamicFormData: function () {
                return {};
            },
            maxFileSize: -1,
            multiple: true,
            dragDrop: true,
            autoSubmit: true,
            showCancel: true,
            showAbort: true,
            showDone: false,
            showDelete:false,
            showError: true,
            showStatusAfterSuccess: true,
            showStatusAfterError: true,
            onSubmit: function (files, xhr) {},
            onSuccess: function (files, response, xhr) {},
            onError: function (files, status, message) {},
            inputCallback: false,
            textareaCallback: false,
            deleteCallback: false,
            chooseCallback: false,
            afterUploadAll: false,
            uploadButtonClass: "ajax-file-upload",
            dragDropStr: "<span><b>Drag &amp; Drop Files Here</b></span>",
            chooseStr: "Choose avata",
            abortStr: "Abort",
            cancelStr: "Cancel",
            deletelStr: "Delete",
            doneStr: "Done",
            loadingStr: "Loading...",
            placeholderTextStr: "Title...",
            placeholderTextAreaStr: "Descriptions...",
            multiDragErrorStr: "Multiple File Drag &amp; Drop is not allowed.",
            extErrorStr: "is not allowed. Allowed extensions: ",
            sizeErrorStr: "is not allowed. Allowed Max size: ",
            uploadErrorStr: "Upload is not allowed"
        }, options);

        this.fileCounter = 1;
        this.fCounter = 0; //failed uploads
        this.sCounter = 0; //success uploads
        this.tCounter = 0; //total uploads
        var formGroup = "ajax-file-upload-" + (new Date().getTime());
        this.formGroup = formGroup;
        this.hide();
        this.errorLog = $("<div></div>"); //Writing errors
        this.after(this.errorLog);
        this.responses = [];
        if (!feature.formdata) //check drag drop enabled.
        {
            s.dragDrop = false;
        }

        
        var obj = this;

        var uploadLabel = $('<div>' + $(this).html() + '</div>');
        $(uploadLabel).addClass(s.uploadButtonClass);

        //wait form ajax Form plugin and initialize		
        (function checkAjaxFormLoaded() {
            if ($.fn.ajaxForm) {

                if (s.dragDrop) {
                    var dragDrop = $('<div class="ajax-upload-dragdrop pvm phl uiBoxWhite" style="vertical-align:top;"></div>');
                    $(obj).before(dragDrop);
                    $(dragDrop).append(uploadLabel);
                    $(dragDrop).append($(s.dragDropStr));
                    setDragDropHandlers(obj, s, dragDrop);

                } else {
                    $(obj).before(uploadLabel);
                }

                createCutomInputFile(obj, formGroup, s, uploadLabel);

            } else window.setTimeout(checkAjaxFormLoaded, 10);
        })();

        this.startUpload = function () {
            $("." + this.formGroup).each(function (i, items) {
                if ($(this).is('form')) $(this).submit();
            });
        }
        this.stopUpload = function () {
            $(".ajax-file-upload-red").each(function (i, items) {
                if ($(this).hasClass(obj.formGroup)) $(this).click();
            });
        }

        this.getResponses = function () {
            return this.responses;
        }
        var checking = false;

        function checkPendingUploads() {
            if (s.afterUploadAll && !checking) {
                checking = true;
                (function checkPending() {
                    if (obj.sCounter != 0 && (obj.sCounter + obj.fCounter == obj.tCounter)) {
                        s.afterUploadAll(obj);
                        checking = false;
                    } else window.setTimeout(checkPending, 100);
                })();
            }

        }

        function setDragDropHandlers(obj, s, ddObj) {
            ddObj.on('dragenter', function (e) {
                e.stopPropagation();
                e.preventDefault();
                //$(this).css('border', '2px solid #A5A5C7');
                //$(this).css('width', '924px');
            });
            ddObj.on('dragover', function (e) {
                e.stopPropagation();
                e.preventDefault();
            });
            ddObj.on('drop', function (e) {
                //$(this).css('border', '2px dotted #A5A5C7');
                //$(this).css('width', '924px');
                e.preventDefault();
                obj.errorLog.html("");
                var files = e.originalEvent.dataTransfer.files;
                if (!s.multiple && files.length > 1) {
                    if (s.showError) $("<div><font color='red'>" + s.multiDragErrorStr + "</font></div>").appendTo(obj.errorLog);
                    return;
                }
                serializeAndUploadFiles(s, obj, files);
            });

            $(document).on('dragenter', function (e) {
                e.stopPropagation();
                e.preventDefault();
            });
            $(document).on('dragover', function (e) {
                e.stopPropagation();
                e.preventDefault();
                //ddObj.css('border', '2px dotted #A5A5C7');
                //ddObj.css('width', '924px');
            });
            $(document).on('drop', function (e) {
                e.stopPropagation();
                e.preventDefault();
                //ddObj.css('border', '2px dotted #A5A5C7');
                //ddObj.css('width', '924px');
            });

        }

        function getSizeStr(size) {
            var sizeStr = "";
            var sizeKB = size / 1024;
            if (parseInt(sizeKB) > 1024) {
                var sizeMB = sizeKB / 1024;
                sizeStr = sizeMB.toFixed(2) + " MB";
            } else {
                sizeStr = sizeKB.toFixed(2) + " KB";
            }
            return sizeStr;
        }

        function serializeData(extraData) {
            var serialized = [];
            if (jQuery.type(extraData) == "string") {
                serialized = extraData.split('&');
            } else {
                serialized = $.param(extraData).split('&');
            }
            var len = serialized.length;
            var result = [];
            var i, part;
            for (i = 0; i < len; i++) {
                serialized[i] = serialized[i].replace(/\+/g, ' ');
                part = serialized[i].split('=');
                result.push([decodeURIComponent(part[0]), decodeURIComponent(part[1])]);
            }
            return result;
        }

        function serializeAndUploadFiles(s, obj, files) {
            for (var i = 0; i < files.length; i++) {
                if (!isFileTypeAllowed(obj, s, files[i].name)) {
                    if (s.showError) $("<div><font color='red'><b>" + files[i].name + "</b> " + s.extErrorStr + s.allowedTypes + "</font></div>").appendTo(obj.errorLog);
                    continue;
                }
                if (s.maxFileSize != -1 && files[i].size > s.maxFileSize) {
                    if (s.showError) $("<div><font color='red'><b>" + files[i].name + "</b> " + s.sizeErrorStr + getSizeStr(s.maxFileSize) + "</font></div>").appendTo(obj.errorLog);
                    continue;
                }
                var ts = s;
                var fd = new FormData();
                var fileName = s.fileName.replace("[]", "");
                fd.append(fileName, files[i]);
                var extraData = s.formData;
                if (extraData) {
                    var sData = serializeData(extraData);
                    for (var j = 0; j < sData.length; j++) {
                        if (sData[j]) {
                            fd.append(sData[j][0], sData[j][1]);
                        }
                    }
                }
                ts.fileData = fd;

                var pd = new createProgressDiv(obj, s);
                pd.filename.html(obj.fileCounter + "). " + files[i].name);
                var form = $("<form style='display:block; position:absolute;left: 150px;' class='" + obj.formGroup + "' method='" + s.method + "' action='" + s.url + "' enctype='" + s.enctype + "'></form>");
                form.appendTo('body');
                var fileArray = [];
                fileArray.push(files[i].name);
                ajaxFormSubmit(form, ts, pd, fileArray, obj);
                obj.fileCounter++;


            }
        }

        function isFileTypeAllowed(obj, s, fileName) {
            var fileExtensions = s.allowedTypes.toLowerCase().split(",");
            var ext = fileName.split('.').pop().toLowerCase();
            if (s.allowedTypes != "*" && jQuery.inArray(ext, fileExtensions) < 0) {
                return false;
            }
            return true;
        }

        function createCutomInputFile(obj, group, s, uploadLabel) {

            var fileUploadId = "ajax-upload-id-" + (new Date().getTime());

            var form = $("<form method='" + s.method + "' action='" + s.url + "' enctype='" + s.enctype + "'></form>");
            var fileInputStr = "<input type='file' id='" + fileUploadId + "' name='" + s.fileName + "'/>";
            if (s.multiple) {
                if (s.fileName.indexOf("[]") != s.fileName.length - 2) // if it does not endwith
                {
                    s.fileName += "[]";
                }
                fileInputStr = "<input type='file' id='" + fileUploadId + "' name='" + s.fileName + "' multiple/>";
            }
            var fileInput = $(fileInputStr).appendTo(form);

            fileInput.change(function () {

                obj.errorLog.html("");
                var fileExtensions = s.allowedTypes.toLowerCase().split(",");
                var fileArray = [];

                if (this.files) //support reading files
                {
                    for (i = 0; i < this.files.length; i++) {
                        fileArray.push(this.files[i].name);
                    }
                } else {
                    var filenameStr = $(this).val();
                    fileArray.push(filenameStr);
                    if (!isFileTypeAllowed(obj, s, filenameStr)) {
                        if (s.showError) $("<div><font color='red'><b>" + filenameStr + "</b> " + s.extErrorStr + s.allowedTypes + "</font></div>").appendTo(obj.errorLog);
                        return;
                    }

                }
                uploadLabel.unbind("click");
                form.hide();
                createCutomInputFile(obj, group, s, uploadLabel);

                form.addClass(group);
                if (feature.fileapi && feature.formdata) //use HTML5 support and split file submission
                {
                    form.removeClass(group); //Stop Submitting when.
                    var files = this.files;
                    serializeAndUploadFiles(s, obj, files);
                } else {
                    var fileList = "";
                    for (var i = 0; i < fileArray.length; i++) {
                        fileList += obj.fileCounter + "). " + fileArray[i] + "<br>";
                        obj.fileCounter++;
                    }
                    var pd = new createProgressDiv(obj, s);
                    pd.filename.html(fileList);
                    ajaxFormSubmit(form, s, pd, fileArray, obj);
                }



            });
            
	         form.css({'margin':0,'padding':0});
            var uwidth=$(uploadLabel).width()+10;
            if(uwidth == 10)
            	uwidth =120;
            	uwidth =96;
            	
            var uheight=uploadLabel.height()+10;
            if(uheight == 10)
            	uheight = 35;

			uploadLabel.css({position: 'relative',overflow:'hidden',cursor:'default'});
			fileInput.css({position: 'absolute','cursor':'pointer',  
							'top': '0px',
							'width': uwidth,  
							'height':uheight,
							'left': '0px',
							'z-index': '100',
							'opacity': '0.0',
							'filter':'alpha(opacity=0)',
							'-ms-filter':"alpha(opacity=0)",
							'-khtml-opacity':'0.0',
							'-moz-opacity':'0.0'
							});
	         form.appendTo(uploadLabel);

            //dont hide it, but move it to 
           /* form.css({	
                margin: 0,
                padding: 0,
                display: 'block',
                position: 'absolute',
                left: '50px'
            });
           if (navigator.appVersion.indexOf("MSIE ") != -1) //IE Browser
            {
                uploadLabel.attr('for', fileUploadId);
            } else {
                uploadLabel.click(function () {
                    fileInput.click();
                });
            }*/


        }


        function createProgressDiv(obj, s) {
            this.statusbar = $("<div class='ajax-file-upload-statusbar' data-item=''></div>");
            this.filename = $("<div class='ajax-file-upload-filename'></div>").appendTo(this.statusbar).hide();
            this.progressDiv = $("<div class='ajax-file-upload-progress'>").appendTo(this.statusbar).hide();
            this.progressImg = $("<div class='ajax-file-upload-file'><img alt='' src='' width='' /><div class='placeholderStatus' style='margin-top: 6px'>" + s.loadingStr + "</div></div>").appendTo(this.statusbar);
            this.progressbar = $("<div class='ajax-file-upload-bar " + obj.formGroup + "'></div>").appendTo(this.progressDiv);
            this.abort = $("<div class='ajax-file-upload-red " + obj.formGroup + "'>" + s.abortStr + "</div>").appendTo(this.statusbar).hide();
            this.cancel = $("<div class='ajax-file-upload-red'>" + s.cancelStr + "</div>").appendTo(this.statusbar).hide();
            this.done = $("<div class='ajax-file-upload-green'>" + s.doneStr + "</div>").appendTo(this.statusbar).hide();
            this.del = $("<div class=''>" + s.deletelStr + "</div>").appendTo(this.statusbar).hide();
            this.choose = $("<div class=''>" + s.chooseStr + "</div>").appendTo(this.statusbar).hide();
            this.input = $("<div class='ajax-file-upload-input'><input type='text' maxlength='170' placeholder='" + s.placeholderTextStr + "' /></div>").appendTo(this.statusbar);
            this.textarea = $("<div class='ajax-file-upload-textarea'><textarea maxlength='500' placeholder='" + s.placeholderTextAreaStr + "'></textarea></div>").appendTo(this.statusbar);
            $(this.statusbar).insertBefore(obj.errorLog);
            return this;
        }


        function ajaxFormSubmit(form, s, pd, fileArray, obj) {
            var currentXHR = null;
            var options = {
                cache: false,
                contentType: false,
                processData: false,
                forceSync: false,
                data: s.formData,
                formData: s.fileData,
                dataType: s.returnType,
                beforeSubmit: function (formData, $form, options) {
                    if (s.onSubmit.call(this, fileArray) != false) {
                        var dynData = s.dynamicFormData();
                        if (dynData) {
                            var sData = serializeData(dynData);
                            if (sData) {
                                for (var j = 0; j < sData.length; j++) {
                                    if (sData[j]) {
                                        if (s.fileData != undefined) options.formData.append(sData[j][0], sData[j][1]);
                                        else options.data[sData[j][0]] = sData[j][1];
                                    }
                                }
                            }
                        }
                        obj.tCounter += fileArray.length;
                        window.setTimeout(checkPendingUploads, 1000); //not so critical
                        return true;
                    }
                    pd.statusbar.append("<div><font color='red'>" + s.uploadErrorStr + "</font></div>");
                    pd.cancel.show()
                    form.remove();
                    pd.cancel.click(function () {
                        pd.statusbar.remove();
                    });
                    return false;
                },
                beforeSend: function (xhr, o) {
                $(".uiLayerPageWrapper").removeClass('nal_');
            	$(".uiLayerPageWrapper").addClass("overlay_");
            	$( '#footer' ).hide();
            	$(".ajax-file-upload span").text("Thêm ảnh");
            	
                    pd.progressDiv.show();
                    pd.cancel.hide();
                    pd.done.hide();
                    if (s.showAbort) {
                        pd.abort.show();
                        pd.abort.click(function () {
                            xhr.abort();
                        });
                    }
                    if (!feature.formdata) //For iframe based push
                    {
                        pd.progressbar.width('5%');
                    } else pd.progressbar.width('1%'); //Fix for small files
                },
                uploadProgress: function (event, position, total, percentComplete) {
                    var percentVal = percentComplete + '%';
                    if (percentComplete > 1) pd.progressbar.width(percentVal)
                },
                success: function (data, message, xhr) {
                	myObj = $.parseJSON(data);
                    obj.responses.push(data);
                    pd.progressbar.width('100%')
					pd.statusbar.attr( "data-item", 'order_'+myObj.id )
                    pd.del.addClass('ajax-file-upload-del')
                    pd.choose.addClass('ajax-file-upload-choose')
                    pd.progressbar.parent().hide()
                    pd.progressImg.find(".placeholderStatus").remove()
                    pd.progressImg.find("img").attr('src', myObj.linkFile)
                    pd.progressImg.find("img").attr('alt', '')
                    pd.abort.hide();
                    s.onSuccess.call(this, fileArray, data, xhr);
                    var input = pd.input.find("input");
                     input.keyup (function() {
                        	if(s.inputCallback) s.inputCallback.call(this,data,input.val());
                            });
                    var textarea = pd.textarea.find("textarea");
                     textarea.keyup (function() {
                        	if(s.textareaCallback) s.textareaCallback.call(this,data,textarea.val());
                            });
                    if (s.showStatusAfterSuccess) {
                        if (s.showDone) {
                            pd.done.show();
                            pd.done.click(function () {
                                pd.statusbar.hide("slow");
                                pd.statusbar.remove();
                            });
                        } else {
                            pd.done.hide();
                        }
                        if(s.showDelete)
                        {
                        	
                        	 pd.del.click(function () {
                        		if(s.deleteCallback) s.deleteCallback.call(this, data,pd);
                            });
                            pd.choose.click(function () {
                        		if(s.chooseCallback) s.chooseCallback.call(this, data,pd);
                            });
                            var n = $('div.ajax-file-upload-file').length;
                			if(n==1){
                			pd.choose.trigger( "click" );
                			}
                        }
                        else
                        {
	                        pd.del.hide();
	                    }
                    } else {
                        pd.statusbar.hide("slow");
                        pd.statusbar.remove();

                    }
                    form.remove();
                    obj.sCounter += fileArray.length;
                },
                error: function (xhr, status, errMsg) {
                    pd.abort.hide();
                    if (xhr.statusText == "abort") //we aborted it
                    {
                        pd.statusbar.hide("slow");
                    } else {
                        s.onError.call(this, fileArray, status, errMsg);
                        if (s.showStatusAfterError) {
                            pd.progressDiv.hide();
                            pd.statusbar.append("<font color='red'>ERROR: " + errMsg + "</font>");
                        } else {
                            pd.statusbar.hide();
                            pd.statusbar.remove();
                        }
                    }

                    form.remove();
                    obj.fCounter += fileArray.length;

                }
            };
            if (s.autoSubmit) {
                form.ajaxSubmit(options);
            } else {
                if (s.showCancel) {
                    pd.cancel.show();
                    pd.cancel.click(function () {
                        form.remove();
                        pd.statusbar.remove();
                    });
                }
                form.ajaxForm(options);

            }

        }
        return this;

    }


}(jQuery));