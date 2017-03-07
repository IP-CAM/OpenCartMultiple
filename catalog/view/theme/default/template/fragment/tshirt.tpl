<!-- Modal -->
<div class="modal fade " id="tShirtModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">T Shirt</h4>
      </div>

      <form action="<?php echo $action; ?>" method="post"  id="form-tshirt" class="form-horizontal">
        <div class="panel-body">

          <div class="form-group required">
            <label class="col-sm-3 control-label" for="input-author"><?php echo $entry_price; ?></label>
            <div class="col-sm-6">
              <input type="text" name="price" value="<?php if(isset($tShirt['price'])){echo $tShirt['price'];}else{ echo "";}?>" id="input-price" class="form-control" />
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label" for="input-image"><?php echo $entry_creation_img; ?></label>
            <div class="col-sm-9">
              <div style="height: 300px; width: 300px;background-image:url('./image/product/2/<?php if(isset($tShirt['type_img_no'])){echo $tShirt['type_img_no'];}else{echo "1";} ?>.png');
background-repeat:no-repeat;background-size:300px; " id="tshirt_wrap">
                <img src="<?php echo $creation['creation_url_show'];?>" width="<?php echo $tShirt['imgParam']['srcWidth'];?>" height="<?php echo $tShirt['imgParam']['srcHeight'];?>"
                     style=" margin-top: 75px" >
              </div>
            </div>
          </div>

          <div class="form-group">
            <table class="col-sm-12" style="margin-left: 20px; margin-right: 20px">
              <tr>
                <td><a href="javascript::void(0)" class="t_shirt_choice" data-img="1"><img src="./image/product/2/1.png" width="50"></a></td>
                <td><a href="javascript::void(0)" class="t_shirt_choice" data-img="2"><img src="./image/product/2/2.png" width="50"></a></td>
              </tr>
            </table>
          </div>

        </div>
        <?php if(isset($tShirt['product_id'])){ ?>
          <input type="hidden" name="product_id" value="<?php echo $tShirt['product_id'];?>">
          <input type="hidden" name="image" value="<?php echo $tShirt['image'];?>">
          <input type="hidden" name="type_img_no_old" value="<?php echo $tShirt['type_img_no'];?>">
        <?php } ?>
        <input type="hidden" name="type_name" value="T-Shirt">
        <input type="hidden" name="type_id" value="2">
        <input type="hidden" name="type_img_no" value="<?php if(isset($tShirt['type_img_no'])){echo $tShirt['type_img_no'];}else{echo "1";}?>" id="tshirt_type_img_no">
        <input type="hidden" name="creation_id" value="<?php echo $creation['creation_id']?>">
        <input type="hidden" name="weight" value="0.2">

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-primary" value="Save changes"/>
        </div>
      </form>

      <script>
        $(function(){
          $(".t_shirt_choice").click(function(){
            var img = $(this).data("img");
            $("#tshirt_wrap").css("background-image","url('./image/product/2/"+img+".png')");
            $("#tshirt_type_img_no").val(img);
          });
        });
      </script>
    </div>
  </div>
</div>