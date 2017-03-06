<!-- Modal -->
<div class="modal fade " id="phoneCaseModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">T Shirt</h4>
      </div>

      <form action="<?php echo $action; ?>" method="post"  id="form-phoneCase" class="form-horizontal">
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
              <div style="height: 300px; width: 300px;background-image:url('./image/product/3/1.png');
background-repeat:no-repeat;background-size:300px; " id="phonecase_wrap">
                <img src="<?php echo $creation['creation_url_show'];?>" width="<?php echo $phoneCase['imgParam']['srcWidth'];?>" height="<?php echo $phoneCase['imgParam']['srcHeight'];?>"
                     style="margin-left: <?php echo $phoneCase['imgParam']['startX']; ?>px; margin-top: <?php echo $phoneCase['imgParam']['startY']; ?>px" >
              </div>
            </div>
          </div>

          <div class="form-group">
            <table class="col-sm-12" style="margin-left: 20px; margin-right: 20px">
              <tr>
                <td><a href="javascript::void(0)" class="phone_case_choice" data-img="1"><img src="./image/product/3/1.png" width="50"></a></td>
                <td><a href="javascript::void(0)" class="phone_case_choice" data-img="2"><img src="./image/product/3/2.png" width="50"></a></td>
              </tr>
            </table>
          </div>

        </div>
        <input type="hidden" name="type_name" value="Phone Case">
        <input type="hidden" name="type_id" value="3">
        <input type="hidden" name="type_img_no" value="1" id="phonecase_type_img_no">
        <input type="hidden" name="creation_id" value="<?php echo $creation['creation_id']?>">
        <input type="hidden" name="weight" value="0.1">

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-primary" value="Save changes"/>
        </div>
      </form>

      <script>
        $(function(){
          $(".phone_case_choice").click(function(){
            var img = $(this).data("img");
            $("#phonecase_wrap").css("background-image","url('./image/product/3/"+img+".png')");
            $("#phonecase_type_img_no").val(img);
          });
        });
      </script>
    </div>
  </div>
</div>