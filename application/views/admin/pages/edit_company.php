        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add New Company</h1>
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

                            <?php if($this->session->flashdata('company_added')) { ?>
                                <div class="alert alert-success">
                                    <?php echo $this->session->flashdata('company_added'); ?>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form  role="form" action="<?=  base_url()?>dashboard/update_company" method="post">

                                        <div class="form-group">
                                            <label>Company Name</label>
                                            <input type="text" class="form-control" name="company-name" placeholder="Enter Company Name" value="<?php echo $company_name ?>">
                                        </div>

                                        <div class="form-group">
                                            <label>Company Address</label>
                                            <input type="text" class="form-control" name="company-address" placeholder="Enter Company Address" value="<?php echo $company_address ?>">
                                        </div>

                                        <div class="form-group">
                                            <label>Company Contact</label>
                                            <input type="text" class="form-control" name="company-contact" placeholder="Enter Company Contact" value="<?php echo $company_contact_number ?>">
                                        </div>

                                        <div class="form-group">
                                            <label>Contact Person</label>
                                            <input type="text" class="form-control" name="company-contact-person" placeholder="Company Contact Person" value="<?php echo $company_contact_person ?>">
                                        </div>

                                        <div class="form-group">
                                            <label>Company Email</label>
                                            <input type="text" class="form-control" name="company-email" placeholder="Company Email" value="<?php echo $company_email ?>">
                                        </div>


                                        <input type="hidden" name="company-id" value="<?php echo $company_id ?>">
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
