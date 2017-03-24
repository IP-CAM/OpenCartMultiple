<?php echo $header; ?>

<div class="container-fluid top">
    <h1 class="top_h1">The Personal Shop Of Painters</h1>
    <a href="<?php echo $shop_create_link;?>" class="btn_g">GET START</a>
</div>

<div class="container painters">
        <h2>Recommended Painters</h2>
        <div class="row P_list">
            <?php foreach($recomend_shops as $shop){ ?>
            <div class="col-lg-4 col-md-4 p_people" >
                <div class="p_people_p"><a href="<?php echo $shop['link'];?>">
                        <div class="people_top_bg">
                            <img src="<?php echo $shop['banner_img'];?>" class="img-responsive" alt="Responsive image" width="100%">
                            <p class="top_bg_bg"></p>
                        </div>
                        <div class="photo_name">
                            <img src="<?php echo $shop['owner_img'];?>"  class="img-circle">
                            <p><?php echo $shop['owner_name'];?></p>
                        </div></a>
                </div>
            </div>
            <?php }?>
        </div>

    </div>

<?php echo $footer; ?>