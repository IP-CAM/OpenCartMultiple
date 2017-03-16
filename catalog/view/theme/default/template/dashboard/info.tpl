<?php echo $header; ?>

<script src="./admin/view/javascript/qiniu/formdata.js" type="text/javascript"></script>

</script>
<?php echo $column_left; ?>
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
            <label class="col-sm-2 control-label" for="input-address"><?php echo $entry_about; ?></label>
            <div class="col-sm-10">
              <textarea type="text" name="owner_about" placeholder="<?php echo $entry_about_des; ?>" rows="5" id="input-address" class="form-control"><?php echo $owner_about; ?></textarea>
            </div>
          </div>


          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-fax"><?php echo $entry_facebook; ?></label>
            <div class="col-sm-10">
              <input type="text" name="link_facebook" value="<?php echo $link_facebook; ?>" placeholder="<?php echo $entry_facebook_des; ?>" id="input-fax" class="form-control" />
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-fax"><?php echo $entry_twitter; ?></label>
            <div class="col-sm-10">
              <input type="text" name="link_twitter" value="<?php echo $link_twitter; ?>" placeholder="<?php echo $entry_twitter_des; ?>" id="input-fax" class="form-control" />
            </div>
          </div>

        <div class="form-group">
          <label class="col-sm-2 control-label" for="input-fax"><?php echo $entry_instagram; ?></label>
          <div class="col-sm-10">
            <input type="text" name="link_instagram" value="<?php echo $link_instagram; ?>" placeholder="<?php echo $entry_instagram_des; ?>" id="input-fax" class="form-control" />
          </div>
        </div>

          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-image"><?php echo $entry_image; ?></label>
            <div class="col-sm-10"><a href="javascript::void(0)" class="img-upload-single" data-inputid="owner_img">
                <img id="img_avatar" src="<?php echo $owner_img_url; ?>" alt="" width="100" height="100" /></a>
              <input type="hidden" name="owner_img" id="owner_img" value="<?php echo $owner_img; ?>" />
            </div>
          </div>

         <div class="form-group">
            <label class="col-sm-2 control-label" for="input-image"><?php echo $entry_image; ?></label>
            <div class="col-sm-10"><a href="javascript::void(0)" class="img-upload-single" data-inputid="banner_url">
                <img id="img_banner" src="<?php echo $banner_img_url; ?>" /></a>
              <input type="hidden" name="banner_img" id="banner_url" value="<?php echo $banner_img; ?>" />
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
        <input name="file" id="cloud_file" type="file"/>
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
<?php echo $footer; ?>