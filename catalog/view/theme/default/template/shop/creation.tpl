<?php echo $header; ?>
<?php echo $header_shop; ?>
<div class="container print_all">
    <div class="row ">
        <div class="col-lg-2 col-xs-5 col-md-3 all_left">
            <h3><span>1</span>Classify</h3>
            <div style="height:2px; background:#E0E0E0;overflow:hidden;"></div>
            <ul class="pri_class">
                <li class="cla_all"><a href="<?php echo $cate_link;?>">All</a></li>
                <li class="cla_cup"><a href="<?php echo $cate_link.'&type_id=1';?>">Cup</a></li>
                <li class="cla_tshirt"><a href="<?php echo $cate_link.'&type_id=2';?>">T-shirt</a></li>
                <li class="cla_polo"><a href="<?php echo $cate_link.'&type_id=3';?>">Polo</a></li>
                <li class="cla_pillow"><a href="<?php echo $cate_link.'&type_id=4';?>">Pillow</a></li>
                <li class="cla_wall"><a href="<?php echo $cate_link.'&type_id=5';?>">Wallpaper</a></li>
            </ul>
        </div>
        <div class="col-lg-1">
        </div>
        <div class="col-lg-9 col-xs-6 col-md-7 all_right">
            <div class="row">
                <?php if(isset($creation_list)){ ?>
                    <?php foreach($creation_list as $creation){ ?>
                        <div class="col-lg-4 col-xs-11 col-md-6 works_list print_list"><a href="<?php echo $creation['link'];?>">
                                <img src="<?php echo $creation['img_url'];?>" class="img-responsive" alt="Responsive image" width="100%">
                                <p class="w_img_bg print_photo"><?php echo $creation['creation_name'];?></p>
                        </div>
                    <?php }?>
                <?php }?>

                <?php if(isset($product_list)){ ?>
                <?php foreach($product_list as $product){ ?>
                <div class="col-lg-4 col-xs-11 col-md-6 works_list print_list"><a href="<?php echo $product['link']?>">
                        <img src="<?php echo $product['img_url']?>" class="img-responsive" alt="Responsive image" width="100%">
                        <p class="w_img_bg print_photo"><?php echo $product['name']?></p>
                        <u class="price">$<?php echo $product['price']?></u></a>
                </div>
                <?php }?>
                <?php }?>


            </div>
            <div class="row">
                <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
                <div class="col-sm-6 text-right"><?php echo $results; ?></div>
            </div>
        </div>

    </div>

</div>




<script>
    $(function(){
        if($(window).width() < 800){
            $(".all_left").css("marginLeft","15px");
            $(".all_left h3").css("font-size","10px");
            $(".all_left span").css("width","5px").css("height","5px").css("line-height","4px");
            $(".pri_class").css("paddingLeft","0");
            $(".pri_class li").css("font-size","12px");
            $(".works_list").css("paddingLeft","10px").css("paddingTop","10px");
            $(".print_list p,.print_list u").css("font-size","5px");
        }
    });
</script>

<?php echo $footer; ?>