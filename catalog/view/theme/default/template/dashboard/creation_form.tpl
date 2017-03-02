<?php echo $header; ?>
<script src="./admin/view/javascript/qiniu/formdata.js" type="text/javascript"></script>
<script src="./admin/view/javascript/colorpicker/jscolor.js" type="text/javascript"></script>
<?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <button type="submit" form="form-review" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
                <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
            <h1><?php echo $heading_title; ?></h1>
            <ul class="breadcrumb">
                <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <div class="container-fluid">
        <?php if ($error_warning) { ?>
        <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
        <?php } ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
            </div>
            <div class="panel-body">
                <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-review" class="form-horizontal">
                    <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-author"><?php echo $entry_creation_name; ?></label>
                        <div class="col-sm-10">
                            <input type="text" name="creation_name" value="<?php echo $creation_name; ?>" placeholder="<?php echo $entry_creation_name; ?>" id="input-author" class="form-control" />
                            <?php if ($error_creation_name) { ?>
                            <div class="text-danger"><?php echo $error_creation_name; ?></div>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-product"><span data-toggle="tooltip" title="<?php echo $column_rank_help; ?>"><?php echo $entry_creation_description; ?></span></label>
                        <div class="col-sm-10">
                            <textarea name="creation_description" placeholder="<?php echo $entry_creation_description; ?>" class="form-control"><?php echo $creation_description; ?></textarea>
                            <input type="hidden" name="creation_id" value="<?php echo $creation_id; ?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-image"><?php echo $entry_creation_img; ?></label>
                        <div class="col-sm-10"><a href="javascript::void(0)" <?php if($text_form_type == 'add'){ ?>>class="img-upload-single"<?php }?> data-inputid="creation_url">
                                <div id="color_show"  style="width:150px">
                                    <img id="img_creation" src="<?php echo $creation_url_full; ?>" style="margin: 25px;width:100px" />
                                </div>
                                </a>
                            <input type="hidden" name="creation_url" id="creation_url" value="<?php echo $creation_url; ?>" />
                            <input type="hidden" name="creation_url_show" value="<?php echo $creation_url_show; ?>" />
                        </div>
                    </div>

                    <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-author"><?php echo $entry_creation_color; ?></label>
                        <div class="col-sm-4">
                            <input type="hidden" name="creation_color_origin" value="<?php echo $creation_color; ?>">
                            <input type="text" name="creation_color" value="<?php echo $creation_color; ?>" placeholder="<?php echo $entry_creation_color; ?>" id="input_color" class="form-control" />
                            <?php if ($error_creation_color) { ?>
                            <div class="text-danger"><?php echo $error_creation_color; ?></div>
                            <?php } ?>
                        </div>
                        <div class="col-sm-6">
                            <button class="jscolor {valueElement:'input_color', styleElement:'color_show'} btn btn-default">
                                Pick color
                            </button>
                        </div>

                    </div>

                </form>
            </div>
        </div>
    </div>

    <div class="container" style="display:none">
        <form id="cloud_upload_form" method="post" enctype="multipart/form-data">
            <input name="key" id="cloud_file_name" type="hidden" value=""/>
            <input name="token" type="hidden" value="<?php echo $qiniu_token;?>"/>
            <input name="file" id="cloud_file" type="file" />
            <input name="accept" type="hidden" />
        </form>
        <input name="img_id" id="img_id" type="hidden" value="">
        <input name="input_id" id="input_id" type="hidden" value="">
        <input name="img_dir" id="img_dir" type="hidden" value="<?php echo $img_dir;?>">
        <div class="progress"></div>
        <script>
            var domain = "<?php echo QINIU_BASE;?>";
        </script>
    </div>

</div>

</div>
<script>
    $(function(){
       $("#input_color").bind('input propertychange', function() {
           var color = $("#input_color").val();
           if(color.length == 6){
               alert(color);
           }
       });
    });

    function setTextColor(picker) {
        $("#input_color").val( picker.toString());
    }
</script>
<?php echo $footer; ?> 