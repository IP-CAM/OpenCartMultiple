<?php echo $header; ?>

<div class="container-fluid top">
    <h1 class="top_h1">The Personal Shop Of Artist</h1>
    <a href="<?php echo $shop_create_link;?>" class="btn_g">GET START</a>
</div>

<div class="container painters">
        <h2>Recommend Artists</h2>
        <div class="row P_list">
            <div class="col-lg-4 col-md-4 p_people" >
                <div class="p_people_p"><a href="###">
                        <div class="people_top_bg">
                            <img src="catalog/view/theme/default/image/artemplate/b1.png" class="img-responsive" alt="Responsive image" width="100%">
                            <p class="top_bg_bg">Recommended Painters</p>
                        </div>
                        <div class="photo_name">
                            <img src="catalog/view/theme/default/image/artemplate/photo_01.png"  class="img-circle">
                            <p>Adam Westbrock</p>
                        </div></a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 p_people" >
                <div class="p_people_p"><a href="###">
                        <div class="people_top_bg">
                            <img src="catalog/view/theme/default/image/artemplate/b1.png" class="img-responsive" alt="Responsive image" width="100%">
                            <p class="top_bg_bg">Recommended Painters</p>
                        </div>
                        <div class="photo_name">
                            <img src="catalog/view/theme/default/image/artemplate/photo_01.png"  class="img-circle">
                            <p>Adam Westbrock</p>
                        </div></a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 p_people" >
                <div class="p_people_p"><a href="###">
                        <div class="people_top_bg">
                            <img src="catalog/view/theme/default/image/artemplate/b1.png" class="img-responsive" alt="Responsive image" width="100%">
                            <p class="top_bg_bg">Recommended Painters</p>
                        </div>
                        <div class="photo_name">
                            <img src="catalog/view/theme/default/image/artemplate/photo_01.png"  class="img-circle">
                            <p>Adam Westbrock</p>
                        </div></a>
                </div>
            </div>
        </div>

    </div>
    <div class="container works">
        <h2>Recommend Designs</h2>
        <div class="row">
            <ul style="padding-left:0;">
                <li class="col-lg-3 col-md-3 col-sm-3 w_01_01"><a href="###">
                        <img src="catalog/view/theme/default/image/artemplate/w_01.png" class="img-responsive" alt="Responsive image" ></a>
                    <p class="w_01_p">PIZZA PARTY</p>
                    <p>by&nbsp;<a href="###"> <span>lOll3</span></a></p>
                </li>
                <li class="col-lg-3 col-md-3 col-sm-3 w_01_01"><a href="###">
                        <img src="catalog/view/theme/default/image/artemplate/w_02.png" class="img-responsive" alt="Responsive image" ></a>
                    <p class="w_01_p">PIZZA PARTY</p>
                    <p>by&nbsp;<a href="###"> <span>lOll3</span></a></p>
                </li>
                <li class="col-lg-3 col-md-3 col-sm-3 w_01_01"><a href="###">
                        <img src="catalog/view/theme/default/image/artemplate/w_01.png" class="img-responsive" alt="Responsive image" ></a>
                    <p class="w_01_p">PIZZA PARTY</p>
                    <p>by&nbsp;<a href="###"> <span>lOll3</span></a></p>
                </li>
                <li class="col-lg-3 col-md-3 col-sm-3 w_01_01"><a href="###">
                        <img src="catalog/view/theme/default/image/artemplate/w_02.png" class="img-responsive" alt="Responsive image" ></a>
                    <p class="w_01_p">PIZZA PARTY</p>
                    <p>by&nbsp;<a href="###"> <span>lOll3</span></a></p>
                </li>
            </ul>
        </div>
        <div class="row">
            <ul style="padding-left:0;">
                <li class="col-lg-3 col-md-3 col-sm-3 w_01_01"><a href="###">
                        <img src="catalog/view/theme/default/image/artemplate/w_01.png" class="img-responsive" alt="Responsive image" ></a>
                    <p class="w_01_p">PIZZA PARTY</p>
                    <p>by&nbsp;<a href="###"> <span>lOll3</span></a></p>
                </li>
                <li class="col-lg-3 col-md-3 col-sm-3 w_01_01"><a href="###">
                        <img src="catalog/view/theme/default/image/artemplate/w_02.png" class="img-responsive" alt="Responsive image" ></a>
                    <p class="w_01_p">PIZZA PARTY</p>
                    <p>by&nbsp;<a href="###"> <span>lOll3</span></a></p>
                </li>
                <li class="col-lg-3 col-md-3 col-sm-3 w_01_01"><a href="###">
                        <img src="catalog/view/theme/default/image/artemplate/w_01.png" class="img-responsive" alt="Responsive image" ></a>
                    <p class="w_01_p">PIZZA PARTY</p>
                    <p>by&nbsp;<a href="###"> <span>lOll3</span></a></p>
                </li>
                <li class="col-lg-3 col-md-3 col-sm-3 w_01_01"><a href="###">
                        <img src="catalog/view/theme/default/image/artemplate/w_02.png" class="img-responsive" alt="Responsive image" ></a>
                    <p class="w_01_p">PIZZA PARTY</p>
                    <p>by&nbsp;<a href="###"> <span>lOll3</span></a></p>
                </li>
            </ul>
        </div>
    </div>
<script>
    $(function(){
        if($(window).width() < 600){
            $("#xs_logo").css("display","none");
            $("#xs_logo_1").css("marginTop","22px").css("float","left").css("display","block");
            $(".navbar-right").css("marginLeft","0").css("padding-left","0").css("float","right");
            $(".search_frame").css("opacity","1");
            $(".form-control").css("width","150px");
            $(".search").css("padding","0").css("marginLeft","0");
            $(".search_a").css("height","").css("width","").css("padding","5px");
            $(".navbar-brand,.col-md-4,.col-lg-4").css("padding","0");
            $(".col-xs-11,.col-md-11,.col-lg-8").css("padding","0");
            $(".search_a").css("backgroundImage","url(./images/search.1.png)");
            $(".user").css("marginLeft","0");
            $(".user_a").css("backgroundImage","url(./images/user.1.png)").css("background-repeat","no-repeat");
            $(".cart").css("marginLeft","0");
            $(".cart_a").css("backgroundImage","url(./images/cart.1.png)").css("background-repeat","no-repeat");
            $(".top").css("height",""),css("backgroundSize","100%");
            $(".top_h1").css("marginTop","0").css("font-size","25px").css("marginTop","10px");
            $("#b_img").css("width","50px").css("","").css("","");

        }
    });
</script>
<?php echo $footer; ?>