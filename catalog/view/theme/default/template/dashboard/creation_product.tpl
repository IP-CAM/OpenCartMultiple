<?php echo $header; ?>
<?php echo $column_left; ?>
<style>
    .pro_name{font-size:16px; margin-top:10px}
    .pro_price{font-size:13px; margin-top:5px;}
</style>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right"><a href="<?php echo $add; ?>" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>

      </div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <?php if ($success) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_product; ?></h3>
      </div>
      <div class="panel-body">

          <div class="table-responsive">
              <table class="table table-bordered table-hover">
                  <tbody>
                     <tr>
                         <!-- Art Print -->
                         <td class="text-center">
                             <?php if(isset($product['artPrint']['product_id'])){ ?>
                                <img src="<?php echo $base_url.$product['artPrint']['image']; ?>" width="200" height="200">
                                <p class="pro_price">$<?php echo $product['artPrint']['price'];?></p>
                             <?php }else{ ?>

                             <?php }?>
                             <p class="pro_name">Art Print</p>
                             <div class="pro_list_btn">
                                 <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#artPrintModal">
                                     Edit
                                 </button>
                             </div>
                             <?php echo $fragmentView['artPrint'];?>
                         </td>

                         <!-- T shirt -->
                         <td class="text-center">
                             <?php if(isset($product['tShirt']['product_id'])){ ?>
                                <img src="<?php echo $base_url.$product['tShirt']['image']; ?>" width="200" height="200">
                                <p class="pro_price">$<?php echo $product['tShirt']['price'];?></p>
                             <?php }else{ ?>

                             <?php }?>
                             <p class="pro_name">T Shirt</p>
                             <div class="pro_list_btn">
                                 <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#tShirtModal">
                                     Edit
                                 </button>
                             </div>
                             <?php echo $fragmentView['tShirt'];?>
                         </td>

                         <!-- PhoneCase -->
                         <td class="text-center">
                             <?php if(isset($product['phoneCase']['product_id'])){ ?>
                                <img src="<?php echo $base_url.$product['phoneCase']['image']; ?>" width="200" height="200">
                                <p class="pro_price">$<?php echo $product['phoneCase']['price'];?></p>
                             <?php }else{ ?>

                             <?php }?>
                             <p class="pro_name">Phone Case</p>
                             <div class="pro_list_btn">
                                 <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#phoneCaseModal">
                                     Edit
                                 </button>
                             </div>
                             <?php echo $fragmentView['phoneCase'];?>
                         </td>

                         <!-- Pillow -->
                         <td class="text-center">
                             <?php if(isset($product['pillow']['product_id'])){ ?>
                                <img src="<?php echo $base_url.$product['pillow']['image']; ?>" width="200" height="200">
                                <p class="pro_price">$<?php echo $product['pillow']['price'];?></p>
                             <?php }else{ ?>

                             <?php }?>

                             <p class="pro_name">Pillow</p>
                             <div class="pro_list_btn">
                                 <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#pillowModal">
                                     Edit
                                 </button>
                             </div>
                             <?php echo $fragmentView['pillow'];?>
                         </td>
                     </tr>
                  </tbody>
              </table>

          </div>

      </div>
    </div>
  </div>

</div>
<?php echo $footer; ?> 