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

            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
              Launch demo modal
            </button>

            <!-- Modal -->
            <div class="modal fade " id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                  </div>

                  <form action="<?php echo $action; ?>" method="post"  id="form-review" class="form-horizontal">
                    <div class="panel-body">

                        <div class="form-group required">
                          <label class="col-sm-3 control-label" for="input-author"><?php echo $entry_price; ?></label>
                          <div class="col-sm-6">
                            <input type="text" name="price" value="" id="input-price" class="form-control" />
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-3 control-label" for="input-image"><?php echo $entry_creation_img; ?></label>
                          <div class="col-sm-9">
                            <div style="background-color: #efefef; width:180px; height:180px; padding: 15px;">
                            <div style="background-color:#ffffff;padding:10px; margin: auto auto; width:<?php echo $creation_url_width+40;?>px;
                                        border-bottom: 1px solid #c2c2c2; border-right:1px solid #c2c2c2;">
                              <div style="padding: 10px;;background-color: #<?php echo $creation_color;?>;width:<?php echo $creation_url_width+20;?>px">
                                <img src="<?php echo $creation_url_full; ?>" style="width:<?php echo $creation_url_width;?>px; height:<?php echo $creation_url_height;?>px" />
                              </div>
                            </div>
                            </div>
                          </div>
                        </div>

                    </div>
                    <input type="hidden" name="type_name" value="Art Print">
                    <input type="hidden" name="type_id" value="1">
                    <input type="hidden" name="creation_id" value="<?php echo $creation_id?>">
                    <input type="hidden" name="weight" value="0.1">


                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="Save changes"/>
                  </div>
                  </form>
                </div>
              </div>
            </div>

          </div>

      </div>
    </div>
  </div>

</div>
<?php echo $footer; ?> 