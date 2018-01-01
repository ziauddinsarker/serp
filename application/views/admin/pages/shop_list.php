

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel-heading">
                <a href="<?=  base_url()?>dashboard/add_shop_to_list"><button type="submit" class="btn btn-default"> Add Shop</button></a>
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Shop List</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    All Product's<!-- panel heading -->
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">


                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <th>No.</th>
                        <th>Shop Name</th>
                        <th>Shop Address</th>
                        <th>Contact Address</th>
                        <th>Owner </th>
                        <th>Shop Location</th>
                        <th></th>
                        </thead>
                        <tbody class="product">
                        <?php $i = 1;?>
                        <?php foreach($all_shops as $shop){ ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $shop->shop_name;?></td>
                                <td><?php echo $shop->shop_address;?></td>
                                <td><?php echo $shop->shop_contact;?></td>
                                <td><?php echo $shop->shop_contact_person;?></td>
                                <td><?php echo $shop->shop_map_location;?></td>
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
