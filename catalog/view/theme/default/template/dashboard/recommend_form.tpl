<?php echo $header; ?>
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

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
            </div>
            <div class="panel-body">
                <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-review" class="form-horizontal">
                    <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-author"><?php echo $entry_product_name; ?></label>
                        <div class="col-sm-10">
                            <input type="text" name="product_name" value="" placeholder="<?php echo $entry_product_name; ?>" id="input-author" class="form-control" />
                            <?php if ($error_product_name) { ?>
                            <div class="text-danger"><?php echo $error_product_name; ?></div>
                            <?php } ?>
                        </div>
                        <input type="hidden" name="product_id" />
                    </div>

                </form>
            </div>
        </div>
    </div>



    <script type="text/javascript">
        $('input[name=\'product_name\']').autocomplete({
            'source': function(request, response) {
                $.ajax({
                    url: 'index.php?route=dashboard/product/autocomplete&filter_name=' +  encodeURIComponent(request),
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
                $('input[name=\'product_name\']').val(item['label']);
                $('input[name=\'product_id\']').val(item['value']);
            }
        });
        </script></div>

</div>
<?php echo $footer; ?> 