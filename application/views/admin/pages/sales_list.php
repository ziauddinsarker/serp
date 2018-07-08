

        <div id="page-wrapper">
                  <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">All Invoice</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           All Invoices are here
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">


                                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                <th>No.</th>
                                <th>Date</th>
                                <th>Customer Name</th>
                                <th>Shop Name</th>
                                <th>Total Product</th>
                                <th>Subtotal</th>
                                <th>Discount </th>
                                <th>Total</th>
                                <th></th>
                                </thead>
                                <tbody class="product">
                                <?php $i = 1;?>
                                <?php foreach($all_invoice as $invoice){ ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo $invoice->invoice_date;?></td>
                                        <td><?php echo $invoice->invoice_customer_name;?></td>
                                        <td><?php echo $invoice->invoice_shop_name;?></td>
                                        <td><?php echo $invoice->quantity;?></td>
                                        <td><?php echo $invoice->subtotal;?></td>
                                        <td><?php echo $invoice->totalDiscount;?></td>
                                        <td><?php echo $invoice->total;?></td>
                                        <td><a class="btn btn-default" href="<?php base_url();?>edit_product/<?php echo $invoice->customer_id ;?>">View</a>  <a class="btn btn-default" href="<?php base_url();?>delete_product/<?php echo $invoice->customer_id ;?>">Delete</a></td>
                                    </tr>
                                <?php }  ?>
                                </tbody>
                            </table>

                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->


            <!-- /.row -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
