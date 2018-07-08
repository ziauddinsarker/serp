        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add New stock</h1>
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
                                        <form  role="form" action="<?=  base_url()?>dashboard/add_product_to_stock" method="post">

                                            <div class="form-group">
                                                <label for="name" class="control-label">Product Name</label>

                                                    <?php
                                                    $attributes = 'class="form-control" id="product-id"';
                                                    echo form_dropdown('stock-product-name',$product_name_list,set_value('name'),$attributes);
                                                    ?>
                                            </div>

                                        <div class="form-group">
                                            <label>Quantity</label>
                                            <input type="text" class="form-control" name="stock-quantity" placeholder="Enter Product Quantity">
                                        </div>


                                        <button type="submit" class="btn btn-default">Submit</button>
                                        <button type="reset" class="btn btn-default">Reset</button>
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
