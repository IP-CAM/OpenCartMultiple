<?php echo $header; ?>
<div class="container">

  <div class="row">

      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
          <div class="form-group">
              <label class="control-label" for="input-email"><?php echo $entry_shop_name; ?></label>
              <input type="text" name="shop_name" placeholder="<?php echo $shop_name; ?>" value="<?php echo $shop_name?>" id="input-shop-name" class="form-control" />
              <?php if ($error_shop_name) { ?>
                <div class="text-danger"><?php echo $error_shop_name; ?></div>
              <?php } ?>
          </div>

          <input type="submit" value="<?php echo $shop_create_button?>" class="btn btn-primary" />

      </form>

  </div>

</div>
<?php echo $footer; ?> 