<div class="container-fluid shop_top">
    <div class="container photo_name shop_ph">
        <img src="<?php echo $shop_info['owner_img']?>"  class="img-circle" >
        <p><?php echo $shop_info['owner_name']?></p>

        <a href="javascript::void(0)" id="btn_unfollow" <?php if(!$is_follow){ ?>style="display:none" <?php } ?>><?php echo $text_unfollow;?></a>
        <a href="javascript::void(0)" id="btn_follow" <?php if($is_follow){ ?>style="display:none" <?php } ?>><?php echo $text_follow;?>  </a>
    </div>
</div>
<div class="container-fluid perple_nav">
    <div class="container">
        <ul class="p_nav">
            <li><a href="<?php echo $home_link?>">Home</a></li>
            <li><a href="<?php echo $print_link?>">Print</a></li>
            <?php foreach($cates as $cate){ ?>
                <li><a href="<?php echo $cate['link'];?>"><?php echo $cate['cate_name']?></a></li>
            <?php }?>
        </ul>
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
        }
    });
</script>

<script>
    $("#btn_follow").click(function(){

        $.ajax({
            url: 'index.php?route=common/header_shop/follow&shop_id=<?php echo $shop_id;?>' ,
            dataType: 'json',
            success: function(json) {
                if(json.code == 1){
                    $("#btn_follow").hide();
                    $("#btn_unfollow").show();
                }else{
                    alert(json.message);
                }
            }
        });
    });
    $("#btn_unfollow").click(function(){
        $.ajax({
            url: 'index.php?route=common/header_shop/unfollow&shop_id=<?php echo $shop_id;?>',
            dataType: 'json',
            success: function(json) {
                if(json.code == 1){
                    $("#btn_follow").show();
                    $("#btn_unfollow").hide();
                }else{
                    alert(json.message);
                }

            }
        });
    });
</script>