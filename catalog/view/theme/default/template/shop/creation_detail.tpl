<?php echo $header; ?>
<?php echo $header_shop; ?>
<div class="container">
    <div class="row shop_index">
        <div class="col-lg-1">
        </div>
        <div class="col-lg-6 index_left">
            <img src="<?php echo $creation_info['img_url'];?>" class="img-responsive" alt="Responsive image" width="100%">
        </div>
        <div class="col-lg-4 index_right">
            <div class="index_right_name">
                <h3><span>1</span>NAME:</h3>
                <p><?php echo $creation_info['creation_name'];?></p>
            </div>
            <div class="index_right_des">
                <h3><span>1</span>DESCRIPTION:</h3>
                <p><?php echo $creation_info['creation_description'];?></p>
            </div>
            <div class="index_right_share">
                <h3><span>1</span>SHARE:</h3>
                <ul class="share">
                    <li class="face"><a href="###" >facebook</a></li>
                    <li class="twi"><a href="###" >twiiter</a></li>
                    <li class="be"><a href="###" >behave</a></li>
                    <li class="rss"><a href="###" >rss</a></li>
                    <li class="goo"><a href="###" >goo</a></li>
                    <li class="LinkedIn"><a href="###" >LinkedIn</a></li>
                    <li class="YouTube"><a href="###" >YouTube</a></li>
                    <li class="Skype"><a href="###" >Skype</a></li>
                </ul>
            </div>
        </div>
        <div class="col-lg-1">
        </div>
    </div>
</div>

<div class="container works">
    <h2>Avalible Products</h2>
    <div class="row">
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
</div>


<script>
    $(function(){
        if($(window).width() < 800){
            $("#perple_p").css("marginLeft","20px").css("marginRight","20px").css("font-size","20px").css("paddingLeft","20px").css("paddingRight","20px");
            $(".nav_cen").css("marginLeft","20px").css("marginRight","20px");
            $(".fo_sh_li").css("paddingBottom","20px").css("paddingTop","20px");
            $(".p_nav li").css("font-size","14px").css("marginLeft","5px").css("marginRight","5px");
            $(".link_more li").css("font-size","16px");
            $(".share_sh").css("display","none");
            $(".share li").css("height","5px").css("width","5px").css("marginRight","55px").css("marginLeft","5px").css("marginTop","20px");
            $(".index_right").css("paddingLeft","15px").css("paddingBottom","35px").css("paddingRight","15px").css("marginLeft","15px").css("marginRight","15px");
            $(".share").css("margin-top","0px");
        }
    });
</script>


<?php echo $footer; ?>