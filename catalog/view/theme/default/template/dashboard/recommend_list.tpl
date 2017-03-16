<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right"><a href="<?php echo $add; ?>" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>

      </div>
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
    <?php if ($success) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_list; ?></h3>
      </div>
      <div class="panel-body">


          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <td class="text-center"><?php echo $column_product_img; ?></td>
                  <td class="text-center"><?php echo $column_product_name; ?></td>
                  <td class="text-center"><?php echo $column_price; ?></td>
                  <td class="text-center"></td>
                </tr>
              </thead>
              <tbody>
                <?php if ($recommends) { ?>
                <?php foreach ($recommends as $recomend) { ?>
                <tr>
                    <td class="text-center"><img src="<?php echo $recomend['product_img']; ?>" width="60" height="60"/></td>
                  <td class="text-center"><?php echo $recomend['product_name']; ?></td>
                  <td class="text-center"><?php echo $recomend['price']; ?></td>
                  <td class="text-center">
                    <button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger" onclick="$('#delete_id').val('<?php echo $recomend["product_id"]; ?>');confirm('<?php echo $text_confirm; ?>') ? ($('#form-delete').submit()) : false;"><i class="fa fa-trash-o"></i></button>
                  </td>
                </tr>
                <?php } ?>
                <?php } else { ?>
                <tr>
                  <td class="text-center" colspan="10"><?php echo $text_no_results; ?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        <form action="<?php echo $delete; ?>" method="post" id="form-delete">
          <input type="hidden" value="" id="delete_id" name="product_id">
        </form>
        <div class="row">

        </div>
      </div>
    </div>
  </div>

</div>
<?php echo $footer; ?> 