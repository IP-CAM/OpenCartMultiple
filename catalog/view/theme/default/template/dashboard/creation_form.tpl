<?php echo $header; ?>
<script src="./admin/view/javascript/qiniu/formdata.js" type="text/javascript"></script>
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
                        <label class="col-sm-2 control-label" for="input-author"><?php echo $entry_collection_name; ?></label>
                        <div class="col-sm-10">
                            <input type="text" name="collection_name" value="<?php echo $collection_name; ?>" placeholder="<?php echo $entry_collection_name; ?>" id="input-author" class="form-control" />
                            <?php if ($error_collection_name) { ?>
                            <div class="text-danger"><?php echo $error_collection_name; ?></div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-product"><span data-toggle="tooltip" title="<?php echo $column_rank_help; ?>"><?php echo $entry_rank; ?></span></label>
                        <div class="col-sm-10">
                            <input type="number" name="rank" value="<?php echo $rank; ?>" placeholder="<?php echo $entry_rank; ?>" id="input-product" class="form-control" />
                            <input type="hidden" name="collection_id" value="<?php echo $collection_id; ?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-image"><?php echo $entry_collection_img; ?></label>
                        <div class="col-sm-10"><a href="javascript::void(0)" class="img-upload-single" data-inputid="collection_url">
                                <img id="img_collection" src="<?php echo $collection_url_full; ?>" /></a>
                            <input type="hidden" name="collection_url" id="collection_url" value="<?php echo $collection_url; ?>" />
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

    <script type="text/javascript"><!--
        $('.datetime').datetimepicker({
            pickDate: true,
            pickTime: true
        });
        //--></script>
    <script type="text/javascript"><!--
        $('input[name=\'product\']').autocomplete({
            'source': function(request, response) {
                $.ajax({
                    url: 'index.php?route=shop/product/autocomplete&filter_name=' +  encodeURIComponent(request),
                    dataType: 'json',
                    success: function(json) {
                        response($.map(json, function(item) {
                            return {
                                label: item['name'],
                                value: item['product_id']
                            }
                        }));
                    }
                });
            },
            'select': function(item) {
                $('input[name=\'product\']').val(item['label']);
                $('input[name=\'product_id\']').val(item['value']);
            }
        });
        //--></script></div>

</div>
<?php echo $footer; ?> 