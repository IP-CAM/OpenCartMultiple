<?php echo $header; ?>
<?php echo $column_left; ?>
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
        <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_product; ?></h3>
      </div>
      <div class="panel-body">

          <div class="table-responsive">

              <!-- Art Print -->
              <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#artPrintModal">
                  Art Print
              </button>
              <?php echo $fragmentView['artPrint'];?>

              <!-- T shirt -->
              <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#tShirtModal">
                  T-shirt
              </button>
              <?php echo $fragmentView['tShirt'];?>

              <!-- T shirt -->
              <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#phoneCaseModal">
                 Phone Case
              </button>
              <?php echo $fragmentView['phoneCase'];?>

          </div>

      </div>
    </div>
  </div>

</div>
<?php echo $footer; ?> 