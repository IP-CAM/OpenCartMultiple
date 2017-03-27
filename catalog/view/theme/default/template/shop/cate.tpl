<?php echo $header; ?>
<?php echo $header_shop; ?>

<div class="container perple_inter shop_per_p">
    <p id="perple_p"><?php echo $cate_info['cate_description'];?></p>
</div>

<div class="container works">
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

    <div class="row">
        <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
        <div class="col-sm-6 text-right"><?php echo $results; ?></div>
    </div>
</div>

<script>
    $(function(){
        if($(window).width() < 800){
            $("#perple_p").css("marginLeft","20px").css("marginRight","20px").css("font-size","20px").css("paddingLeft","20px").css("paddingRight","20px");
        }
    });
</script>

<?php echo $footer; ?>