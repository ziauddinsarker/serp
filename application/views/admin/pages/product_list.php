

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel-heading">
                        <a href="<?=  base_url()?>dashboard/add_product_to_list"><button type="submit" class="btn btn-default"> Add New Product</button></a>
                        <a href="<?=  base_url()?>dashboard/add_company_to_list"><button type="submit" class="btn btn-default"> Add New Company</button></a>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Product List</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Note: To add new product from new company, Add company first then add new product
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">


                                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                <th>No.</th>
                                <th>Product Name</th>
                                <th>Company</th>
                                <th>Size</th>
                                <th>T.P</th>
                                <th>T.D</th>
                                <th></th>
                                </thead>
                                <tbody class="product">
                                <?php $i = 1;?>
                                <?php foreach($all_products as $product){ ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo $product->product_name;?></td>
                                        <td><?php echo $product->product_company_name;?></td>
                                        <td><?php echo $product->product_size;?></td>
                                        <td><?php echo $product->product_trade_price;?></td>
                                        <td><?php echo $product->product_depo_price;?></td>
                                        <td><a class="btn btn-default" href="#">Edit</a>  <a class="btn btn-default" href="#">Delete</a></td>
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
