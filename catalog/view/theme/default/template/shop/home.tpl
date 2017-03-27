<?php echo $header; ?>
<?php echo $header_shop; ?>

<div class="container perple_inter">
  <p id="perple_p"><?php echo $shop_info['owner_about'];?></p>
</div>
<div class="container">
  <ul class="link_more">
    <?php if($shop_info['link_facebook'] != ""){ ?><li class=""><a href="<?php echo $shop_info['link_facebook'];?>">Facebook</a></li><?php }?>
    <?php if($shop_info['link_twitter'] != ""){ ?><li class=""><a href="<?php echo $shop_info['link_twitter'];?>">Twitter</a></li><?php }?>
    <?php if($shop_info['link_instagram'] != ""){ ?><li class=""><a href="<?php echo $shop_info['link_instagram'];?>">Instagram</a></li><?php }?>
  </ul>
  <ul class="share">
    <li class="share_sh"><p>Share</p></li>
    <li class="face"><a href="###" >facebook</a></li>
    <li class="twi"><a href="###" >twiiter</a></li>
    <li class="be"><a href="###" >behave</a></li>
    <li class="rss"><a href="###" >rss</a></li>
    <li class="goo"><a href="###" >goo</a></li>
  </ul>
</div>


<div class="container works">
  <h2>Latest Products</h2>
  <?php if($product_list){
      $i=0;
     ?>
    <?php  foreach($product_list as $product){ ?>

      <?php if($i%4 == 0){ ?>  <div class="row"> <?php } ?>

      <div class="col-lg-3 col-md-3 works_list"><a href="<?php echo $product['link']?>">
          <img src="<?php echo $product['img_url']?>" class="img-responsive" alt="Responsive image" width="100%">
          <p class="w_img_bg"><?php echo $product['name']?></p>
          <u class="price">$<?php echo $product['price']?></u></a>
      </div>

    <?php if($i%4 == 3 || ($i == count($product_list)-1)){ ?>  </div> <?php } ?>
    <?php $i++;} ?>

  <?php } ?>


</div>

<?php echo $footer; ?>
