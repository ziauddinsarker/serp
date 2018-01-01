        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add New Product</h1>
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
                                        <form  role="form" action="<?=  base_url()?>dashboard/add_to_product" method="post">

                                            <div class="form-group">
                                            <label>Product Name</label>
                                            <input type="text" class="form-control" name="product-name" placeholder="Enter Product Name">
                                        </div>

                                            <div class="form-group">
                                                <label for="name" class="control-label">Product Name</label>

                                                <?php
                                                $attributes = 'class="form-control" id="product-id"';
                                                echo form_dropdown('product-company',$company_name_list,set_value('company_name'),$attributes);
                                                ?>
                                            </div>

                                        <div class="form-group">
                                            <label>Size</label>
                                            <input type="text" class="form-control" name="product-size" placeholder="Enter Product Size">
                                        </div>

                                        <div class="form-group">
                                            <label>Trade Price</label>
                                            <input type="text" class="form-control" name="product-trade-price" placeholder="Enter Trade Price">
                                        </div>

                                        <div class="form-group">
                                            <label>Depo Price</label>
                                            <input type="text" class="form-control" name="product-depo-price" placeholder="Enter Depo Price">
                                        </div>

                                        <div class="form-group">
                                            <label>Date</label>
                                            <input type="text" class="form-control" name="product-add-date" placeholder="Enter Date">
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
