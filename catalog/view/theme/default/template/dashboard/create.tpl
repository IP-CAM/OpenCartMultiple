<?php echo $header; ?>
<div class="container">

  <div class="row">

      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
          <div class="form-group">
              <label class="control-label" for="input-email"><?php echo $shop_name; ?></label>
              <input type="text" name="shop_name" placeholder="<?php echo $shop_name; ?>" id="input-shop-name" class="form-control" />
          </div>

          <input type="submit" value="<?php echo $shop_create_button?>" class="btn btn-primary" />

      </form>

  </div>

</div>
<?php echo $footer; ?> 