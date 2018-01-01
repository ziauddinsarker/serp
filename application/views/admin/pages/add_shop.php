        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add New Shop</h1>
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

                            <?php if($this->session->flashdata('shop_added')) { ?>
                                <div class="alert alert-success">
                                    <?php echo $this->session->flashdata('shop_added'); ?>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form  role="form" action="<?=  base_url()?>dashboard/add_to_shop" method="post">

                                        <div class="form-group">
                                            <label>Shop Name</label>
                                            <input type="text" class="form-control" name="shop-name" placeholder="Enter Shop Name">
                                        </div>

                                        <div class="form-group">
                                            <label>Shop Address</label>
                                            <input type="text" class="form-control" name="shop-address" placeholder="Enter Shop Address">
                                        </div>

                                        <div class="form-group">
                                            <label>Shop Contact</label>
                                            <input type="text" class="form-control" name="shop-contact" placeholder="Enter Shop Contact">
                                        </div>

                                        <div class="form-group">
                                            <label>Contact Person</label>
                                            <input type="text" class="form-control" name="shop-contact-person" placeholder="Contact Person">
                                        </div>

                                        <div class="form-group">
                                            <label>Shop Picture</label>
                                            <input type="text" class="form-control" name="shop-picture" placeholder="Upload Shop Picture">
                                        </div>
                                        <div class="form-group">
                                            <label>Shop Map</label>
                                            <input type="text" class="form-control" name="shop-map-location" placeholder="Shop Map">
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
