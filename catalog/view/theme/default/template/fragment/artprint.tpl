<div class="modal fade " id="artPrintModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Art Print</h4>
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
              <div style="background-color: #efefef; width:250px; height:250px; padding-top: <?php echo $artPrint['imgParam']['startY']?>px">
                <div style="background-color:#ffffff;padding:10px; margin:0 auto; width:<?php echo $artPrint['imgParam']['srcWidth']+40;?>px;border-bottom: 1px solid #c2c2c2; border-right:1px solid #c2c2c2;">
                  <div style="padding: 10px;;background-color: #<?php echo $creation['creation_color'];?>;width:<?php echo $artPrint['imgParam']['srcWidth']+20;?>px">
                    <img src="<?php echo $creation['creation_url_show']; ?>" style="width:<?php echo $artPrint['imgParam']['srcWidth'];?>px; height:<?php echo $artPrint['imgParam']['srcHeight'];?>px" />
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
        <input type="hidden" name="type_name" value="Art Print">
        <input type="hidden" name="type_id" value="1">
        <input type="hidden" name="creation_id" value="<?php echo $$creation['creation_id']?>">
        <input type="hidden" name="weight" value="0.1">
        <input type="hidden" name="type_img_no" value="0">

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-primary" value="Save changes"/>
        </div>
      </form>
    </div>
  </div>
</div>