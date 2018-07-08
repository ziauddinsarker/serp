        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Edit Product</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <?php if(validation_errors()) { ?>
                                <div class="alert alert-warning">
                                    <?php echo validation_errors(); ?>
                                </div>
                            <?php } ?>

                            <?php if($this->session->flashdata('added_product')) { ?>
                                <div class="alert alert-success">
                                    <?php echo $this->session->flashdata('item'); ?>
                                </div>
                            <?php } ?>


                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                        <form  role="form" action="<?=  base_url()?>dashboard/update_product" method="post">

                                            <div class="form-group">
                                            <label>Product Name</label>
                                            <input type="text" class="form-control" name="product-name" placeholder="Enter Product Name" value="<?php echo $product_name ?>">
                                        </div>


                                            <div class="form-group"><label>Company</label>
                                                <?php $attributes = 'class="form-control"';?>
                                                <?php echo form_dropdown('product-company',$company_list,$company_id,$attributes);?>
                                            </div>

                                        <div class="form-group">
                                            <label>Size</label>
                                            <input type="text" class="form-control" name="product-size" placeholder="Enter Product Size" value="<?php echo $product_size ?>">
                                        </div>


                                            <div class="form-group">
                                                <label>Depo Price</label>
                                                <input type="text" class="form-control" name="product-depo-price" placeholder="Enter Depo Price" value="<?php echo $product_depo_price ?>">
                                            </div>

                                        <div class="form-group">
                                            <label>Trade Price</label>
                                            <input type="text" class="form-control" name="product-trade-price" placeholder="Enter Trade Price" value="<?php echo $product_trade_price ?>">
                                        </div>

                                            <input type="hidden" name="product-id" value="<?php echo $product_id ?>">
                                            <input type="submit" class="btn btn-primary" name="update" value="Update Product">
                                    </form>
                                </div>

                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
