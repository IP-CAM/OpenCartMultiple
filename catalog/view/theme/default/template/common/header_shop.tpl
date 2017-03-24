<div class="container-fluid shop_top">
    <div class="container photo_name shop_ph">
        <img src="<?php echo $shop_info['owner_img']?>"  class="img-circle" >
        <p><?php echo $shop_info['owner_name']?></p>
        <a href="###"><?php if($is_follow){ ?> <?php echo $text_unfollow;?> <?php }else{ ?> <?php echo $text_follow;?>  <?php } ?></a>
    </div>
</div>
<div class="container-fluid perple_nav">
    <div class="container">
        <ul class="p_nav">
            <li><a href="#">Home</a></li>
            <li><a href="#">Print</a></li>
            <?php foreach($cates as $cate){ ?>
                <li><a href="<?php echo $cate['link'];?>"><?php echo $cate['cate_name']?></a></li>
            <?php }?>
        </ul>
    </div>
</div>

<script>
    $(function(){
        if($(window).width() <= 650){
            $("#perple_p").css("marginLeft","20px").css("marginRight","20px").css("font-size","20px").css("paddingLeft","20px").css("paddingRight","20px");
            $(".nav_cen").css("marginLeft","20px").css("marginRight","20px");
            $(".fo_sh_li").css("paddingBottom","20px").css("paddingTop","20px");
            $(".p_nav li").css("font-size","14px").css("marginLeft","5px").css("marginRight","5px");
            $(".link_more li").css("font-size","16px");
            $(".share_sh").css("display","none");
            $(".share li").css("height","5px").css("width","5px").css("marginRight","55px").css("marginLeft","5px").css("marginTop","20px");
        }
    });
</script>