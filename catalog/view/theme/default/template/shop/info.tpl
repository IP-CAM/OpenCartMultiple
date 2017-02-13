<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-location" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-location" class="form-horizontal">
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-name"><?php echo $entry_name; ?></label>
            <div class="col-sm-10">
              <input type="text" name="shop_name" value="<?php echo $shop_name; ?>" id="input-name" class="form-control" />
              <?php if ($error_name) { ?>
              <div class="text-danger"><?php echo $error_name; ?></div>
              <?php } ?>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-geocode"><span data-toggle="tooltip" data-container="#content" title="<?php echo $entry_owner; ?>"><?php echo $entry_owner; ?></span></label>
            <div class="col-sm-10">
              <input type="text" name="owner_name" value="<?php echo $owner_name; ?>" placeholder="<?php echo $entry_owner_des; ?>" id="input-geocode" class="form-control" />
            </div>
          </div>

          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-address"><?php echo $entry_about; ?></label>
            <div class="col-sm-10">
              <textarea type="text" name="owner_about" placeholder="<?php echo $entry_about_des; ?>" rows="5" id="input-address" class="form-control"><?php echo $owner_about; ?></textarea>
            </div>
          </div>


          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-fax"><?php echo $entry_facebook; ?></label>
            <div class="col-sm-10">
              <input type="text" name="owner_facebook" value="<?php echo $owner_facebook; ?>" placeholder="<?php echo $entry_facebook_des; ?>" id="input-fax" class="form-control" />
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-fax"><?php echo $entry_twitter; ?></label>
            <div class="col-sm-10">
              <input type="text" name="owner_twitter" value="<?php echo $owner_twitter; ?>" placeholder="<?php echo $entry_twitter_des; ?>" id="input-fax" class="form-control" />
            </div>
          </div>

          <div class="form-group" style="display: none">
            <label class="col-sm-2 control-label" for="input-image"><?php echo $entry_image; ?></label>
            <div class="col-sm-10"><a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumb; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
              <input type="hidden" name="image" value="<?php echo $image; ?>" id="input-image" />
            </div>
          </div>


        </form>
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?>