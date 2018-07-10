<div id="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12 col-sm-16 col-xs-18">
                <div>
                    <h1 class="page-header">Invoice</h1>
                </div>
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
                <form  role="form" action="<?=  base_url()?>dashboard/save_invoice" method="post">

                    <div class="box-body">



                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name" class="control-label col-xs-2">Shop</label>
                                <div class="col-xs-10">
                                    <input type="text" id="shop_list" name="shop-name" class="form-control" placeholder="Shop Name">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                            <div class="col-md-4">

                            <div class="form-group">
                                <label for="name" class="control-label col-xs-2">Name</label>
                                <div class="col-xs-10">
                                    <input type="text" name="customer-name" class="form-control" placeholder="Customer Name" required="required">
                                </div>
                            </div>



                            <div class="form-group">
                                <label for="phone" class="control-label col-xs-2">Phone</label>
                                <div class="col-xs-10">
                                    <input type="text" name="customer-phone" class="form-control" placeholder="Phone" required="required" >
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email" class="control-label col-xs-2">Email</label>
                                <div class="col-xs-10">
                                    <input type="text" name="customer-email" class="form-control" placeholder="Email">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="date" class="control-label col-xs-2">Date</label>
                                <div class="col-xs-10">
                                    <input type="text" name="invoice_date" class="form-control" value="<?php echo date('Y-m-d'); ?>" readonly="readonly">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="invoice-no" class="control-label col-xs-2">Invoice</label>
                                <div class="col-xs-10">
                                    <input type="text" name="invoice-no" class="form-control" placeholder="Invoice No." value="1" readonly="readonly">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="location" class="control-label col-xs-2">Address</label>
                                <div class="col-xs-10">
                                    <input type="text" name="customer-address" class="form-control" placeholder="Address">
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="col-xs-12" style="height:30px;"></div>

            <div class="col-md-9">

                <table class="table table-bordered table-hover invtable">
                    <thead>
                    <th>No</th>
                    <th colspan="4">Product Name</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Discount Amount</th>
                    <th>Discount (%)</th>
                    <th>Total</th>
                    <th><a id="add" class="btn btn-primary addmore" href="#"><i class="fa fa-plus"></i></a></th>
                    </thead>
                    <tbody class="detail">

                        <tr>
                        <td class="no">1</td>
                        <td colspan="4"><input type="text" class="form-control productcode autocomplete_txt" data-type="productcode" id='productcode_1' name="productcode[]" required="required"></td>
                        <input type="hidden" class="form-control" data-type="productcodeid" id='productcodeid_1' name="productcodeid[]" required="required">
                        <td><input type="text" class="form-control quantity" data-type="quantity" id='quantity_1' name="quantity[]" required="required"></td>
                        <td><input type="text" class="form-control price autocomplete_txt" data-type="price" id='price_1' name="price[]" required="required"></td>
                        <td><input type="text" class="form-control discount-amount" data-type="discountamount" id='discountamount_1' name="discountamount[]"></td>
                        <td><input type="text" class="form-control discount" data-type="discount" id='discount_1' name="discount[]"></td>
                        <td><input type="text" class="form-control amount" data-type="amount" id='amount_1' name="amount[]" readonly="readonly"></td>
                        <td><a href="#" class="btn btn-primary remove"><i class="fa fa-times"></i></a></td>
                    </tr>
<!--
                        <tr>
                            <td>
                                <select class="productName form-control" style="width:500px" name="productName"></select>
                            </td>
                        </tr>
-->
                    </tbody>
                    <tfoot>
                    <th class="no-style" colspan="8"></th>
                    <th >Total</th>
                    <th style="text-align: center; background: silver;" colspan="1" ><span class="total"></span> tk</th>
                    </tfoot>
                    <tfoot>
                    <th class="no-style" colspan="8"></th>
                    <th >Subtotal</th>
                    <th style="text-align: center; background: silver;" colspan="1" ><span class="subtotal"></span> tk</th>
                    </tfoot>
                    <tfoot>
                    <th class="no-style" colspan="8"></th>
                    <th >Discount</th>
                    <th style="text-align: center; background: silver;" colspan="1" ><span class="discount"></span> tk</th>
                    </tfoot>

                </table>
                <div><b>In Words :</b> <span class="inWord"></span>
                    <input type="hidden" class="form-control " id="inword" name="inword">
                </div>

                <input type="submit" class="btn btn-primary inv-btn" name="save" value="Print">
                <!--<input type="submit" class="btn btn-primary inv-btn" name="print" value="Print" formtarget="_blank">-->
            </div>
            </div>
            </div>
            </form>
        </div>
    </div>

    </div>

</div>


