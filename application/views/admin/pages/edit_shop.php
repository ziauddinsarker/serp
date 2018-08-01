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
                                    <form  role="form" action="<?=  base_url()?>dashboard/update_shop" method="post">

                                        <div class="form-group">
                                            <label>Shop Name</label>
                                            <input type="text" class="form-control" name="shop-name" placeholder="Enter Shop Name" value="<?php echo $shop_name ?>">
                                        </div>

                                        <div class="form-group">
                                            <label>Shop Address</label>
                                            <input type="text" class="form-control" name="shop-address" placeholder="Enter Shop Address" value="<?php echo $shop_address ?>">
                                        </div>

                                        <div class="form-group">
                                            <label>Shop Contact</label>
                                            <input type="text" class="form-control" name="shop-contact" placeholder="Enter Shop Contact" value="<?php echo $shop_contact ?>">
                                        </div>

                                        <div class="form-group">
                                            <label>Contact Person</label>
                                            <input type="text" class="form-control" name="shop-contact-person" placeholder="Contact Person" value="<?php echo $shop_contact_person ?>">
                                        </div>

                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" class="form-control" name="shop-email" placeholder="Email Address" value="<?php echo $shop_email ?>">
                                        </div>

                                        <div class="form-group">
                                            <label>Shop Picture</label>
                                            <input type="text" class="form-control" name="shop-picture" placeholder="Upload Shop Picture">
                                        </div>
                                        <div class="form-group">
                                            <label>Shop Map</label>
                                            <input type="text" class="form-control" name="shop-map-location" placeholder="Shop Map">
                                        </div>

                                        <input type="hidden" name="shop-id" value="<?php echo $shop_id ?>">
                                        <input type="submit" class="btn btn-primary" name="update" value="Update Shop">
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
