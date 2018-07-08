

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
                        <div>
                            <h1 class="page-header">Daily Sell Summary</h1>
                            <a class="btn btn-default" href="<?php base_url();?>get_all_daily_product_summary">All Product Sell Summary</a>
                            <?php foreach($sell_today as $sell){ ?>
                                <?php echo "<h4>Total Sell Today: " . $sell->total_sell_today ."</h4>" ?>

                            <?php }  ?>

                            <form class="form-inline" role="form" action="<?=  base_url()?>inventory/get_daily_product_summary" method="post">
                                <input type="text" class="form-control" value="<?php echo $show_date ?>" name="date" id="date" placeholder="Date" onchange="this.form.submit()" required>
                                <noscript><input type="submit" value="Submit"></noscript>
                            </form>

                            <form class="form-inline" role="form" action="<?=  base_url()?>inventory/getreport" method="post">
                                <input type="hidden" class="form-control" name="datereport" id="datereport" value="<?php echo $show_date ?>">
                                <input type="submit" class="btn btn-default" value="Get Report">
                            </form>

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
