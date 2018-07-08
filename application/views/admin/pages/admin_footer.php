
<!-- jQuery -->
<script src="<?php echo base_url("assets/vendor/jquery/jquery.min.js")?> "></script>

<!--<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">-->

<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url("assets/vendor/bootstrap/js/bootstrap.min.js")?> "></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="<?php echo base_url("assets/vendor/metisMenu/metisMenu.min.js")?> "></script>

<!-- Morris Charts JavaScript -->
<script src="<?php echo base_url("assets/vendor/raphael/raphael.min.js")?> "></script>
<script src="<?php echo base_url("assets/vendor/morrisjs/morris.min.js")?> "></script>
<script src="<?php echo base_url("assets/data/morris-data.js")?> "></script>

<!-- Custom Theme JavaScript -->
<script src="<?php echo base_url("assets/dist/js/sb-admin-2.js")?> "></script>


<script>
    /**
     * Site : http:www.smarttutorials.net
     * @author muni
     */
    $(".delete").on('click', function() {
        $('.case:checkbox:checked').parents("tr").remove();
        $('.check_all').prop("checked", false);
        check();
    });


    var i=$('.detail tr').length+1;

    $(".addmore").on('click',function(){
        count=$('.detail tr').length + 1;
        var data="<tr><td><span id='snum"+i+"'>"+count+".</span></td>";
        data+="<td colspan='4'><input type='text' class='form-control productcode autocomplete_txt' data-type='productcode' id='productcode_"+i+"' name='productcode[]' required='required'></td>";
        data+="<input type='hidden' class='form-control' data-type='productcodeid' id='productcodeid_"+i+"' name='productcodeid[]' required='required'>";
        data+="<td><input type='text' class='form-control quantity' data-type='quantity' id='quantity_"+i+"' name='quantity[]' required='required'></td>";
        data+="<td><input type='text' class='form-control price autocomplete_txt' data-type='price' id='price_"+i+"' name='price[]' required='required'></td>";
        data+="<td><input type='text' class='form-control discount-amount' data-type='discountamount' id='discountamount_"+i+"' name='discountamount[]'></td>";
        data+="<td><input type='text' class='form-control discount' data-type='discount' id='discount_"+i+"' name='discount[]'></td>";
        data+="<td><input type='text' class='form-control amount' data-type='amount' id='amount_"+i+"' name='amount[]' readonly='readonly'></td>";
        data+="<td><a href='#' class='btn btn-primary remove'><i class='fa fa-times'></i></a> </td></tr>";
        $('table').append(data);
        row = i ;
        i++;
    });

    function select_all() {
        $('input[class=case]:checkbox').each(function(){
            if($('input[class=check_all]:checkbox:checked').length == 0){
                $(this).prop("checked", false);
            } else {
                $(this).prop("checked", true);
            }
        });
    }

    function check(){
        obj=$('table tr').find('span');
        $.each( obj, function( key, value ) {
            id=value.id;
            $('#'+id).html(key+1);
        });
    }




    var multiple = ["4|VITREX 450 ml|1050|",
        "6|VITREX 950 ml|1400|",
        "7|Tiles Adhesives Powder 1kg|2250|",
        "8|Tiles Adhesives Powder Off White 1kg|600|",
        "9|Promotional Items|1050|",

    ];

    //autocomplete script
    $(document).on('focus','.autocomplete_txt',function(){
        type = $(this).data('type');

        if(type =='productcodeid' )autoTypeNo=0;
        if(type =='productcode' )autoTypeNo=1;
        if(type =='price' )autoTypeNo=2;

        $(this).autocomplete({
            minLength: 0,
            source: function( request, response ) {
                var array = $.map(multiple, function (item) {
                    var code = item.split("|");
                    return {
                        label: code[autoTypeNo],
                        value: code[autoTypeNo],
                        data : item
                    }
                });
                //call the filter here
                response($.ui.autocomplete.filter(array, request.term));
            },
            focus: function() {
                // prevent value inserted on focus
                return false;
            },
            select: function( event, ui ) {
                var names = ui.item.data.split("|");
                id_arr = $(this).attr('id');
                id = id_arr.split("_");
                elementId = id[id.length-1];
                $('#productcodeid_'+elementId).val(names[0]);
                $('#productcode_'+elementId).val(names[1]);
                $('#price_'+elementId).val(names[2]);
            }
        });

        /*
         $.ui.autocomplete.filter = function (array, term) {
         var matcher = new RegExp("^" + $.ui.autocomplete.escapeRegex(term), "i");
         return $.grep(array, function (value) {
         return matcher.test(value.label || value.value || value);
         });
         };
         */
    });

</script>




<script>
    /*
     $(document).ready(function(e){
     var site_url = "<?php //echo site_url(); ?>";
     var input = $("input[id=pcode]");

     $.get(site_url+'inventory/json_search_product', function(data){
     input.typeahead({
     source: data,
     minLength: 1,
     });
     }, 'json');

     input.change(function(){
     var current = input.typeahead("getActive");
     $('#product_id').val(current.id);
     $('#price').val(current.price);
     $('#pcode').val(current.pcode);
     });
     });
     */
</script>
<script>
    /*
     $(document).ready(function() {
     // On change of the dropdown do the ajax
     $("#proCode").change(function() {
     $.ajax({
     // Change the link to the file you are using
     url: '<?php //base_url()?>json_search_product',
     type: 'post',
     // This just sends the value of the dropdown
     data: { client: $(this).val() },
     success: function(response) {
     // Parse the jSON that is returned
     // Using conditions here would probably apply
     // incase nothing is returned
     var Vals    =   JSON.parse(response);

     var productCode = $("#proCode").val();

     for(i = 0; i < Vals.length; i++) {

     if(Vals[i].pcode === productCode){
     //$("input[name='kk']").val(Vals[0].price);
     //$("input[name='kk']").val(Vals[i].price);
     //console.log(Vals[i]);
     }else{
     $("input[id='price']").val(Vals[i].price);
     //$("input[name='kk']").val(Vals[i].price);
     //console.log(Vals[i]);
     break;
     }

     // console.log(Vals[i].price);
     }

     /*
     var hasTag = function(productCode) {
     var i = null;
     for (i = 0; tags.length > i; i += 1) {
     if (Vals[i].pcode === productCode) {
     return true;
     }
     }

     return false;
     };

     */
    // These are the inputs that will populate
    //$("input[name='kk']").val(Vals[0].id);
    //console.log(Vals.price)
    /*
     }
     });
     });
     });
     */
</script>


<script>
    window.setTimeout(function() {
        $("#success_message").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove();
        });
    }, 2000);
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#add').click(function(){
            addnewrow();
        });

        $('.detail').delegate('.quantity,.price,.discount,.discount-amount,.inword','keyup',function(){
            var tr = $(this).parent().parent();
            var qty = tr.find('.quantity').val();
            var price = tr.find('.price').val();
            var amt = qty * price;

            pquantity = tr.find('.quantity').val();

            //Discount Amount  if needed
            var discamount = tr.find('.discount-amount').val();
            var percent = tr.find('.discount').val();
            //console.log(discamount);
            if(discamount > 0){
                var disc = (discamount/(qty * price))*100;
                tr.find('.discount').val((disc).toFixed(2));
            }
            /*
             if(percent > 0){
             var disamount = (qty * price * percent)/100;
             tr.find('.discount-amount').val(disamount);
             }
             */


            //Discount option if needed
            //var dis = tr.find('.discount').val();

            //var disamount = (qty * price * dis)/100;
            // tr.find('.discount-amount').val(disamount);



            //var discountamount =  tr.find('.discount-amount').val();
            // var percentage = (discountamount/price)/100;
            //tr.find('.discount').val(percentage);
            //var dis = tr.find('.discount').val();


            //var amt = (qty * price) - (qty * price * dis)/100;
            var amt = qty * price;
            tr.find('.amount').val(amt);

            subtotal();
            discount();

            var total = gsubtotal - gdiscount;
            $('.total').html(total);
            $('.inWord').html(inWords(gsubtotal - gdiscount));

            var inw = inWords(gsubtotal - gdiscount);
            console.log(inw);
            //("#inword").txt(inw);
            //tr.find('.inword').val(inw);
            document.getElementById("inword").value = inw;
        });


        $('body').delegate('.remove','click',function(){
            $(this).parent().parent().remove();
        });

    });
    /**
     * Total Amount
     */
    function subtotal(){
        var t = 0;
        $('.amount').each(function (i,e) {
            var amt = $(this).val()-0;
            t += amt;
        });

        gsubtotal = t;

        $('.inWord').html(inWords(t));
        $('.subtotal').html(t);
    }

    /**
     * Total Amount
     */
    function discount(){
        var t = 0;
        $('.discount-amount').each(function (i,e) {
            var disc = $(this).val()- 0;
            t += disc;
        });

        gdiscount = t;

        $('.discount').html(t);
    }
/*

     function addnewrow(){
         var n = ($('.detail tr').length-0)+1;
         var tr = '<tr>'+
         '<td class="no">' + n + '</td>'+
         '<td colspan="4">'+
         '<select class="form-control" name="productcode[]">'+
        <?php /*foreach ($products as $row):
        {
        ?>
         '<option value="<?php echo $row->product_id; ?>"><?php echo $row->product_code; ?></option>'+

        <?php
            }
        endforeach; */?>
         '</select>'+
         '</td>' +
         '<td><input type="text" class="form-control quantity" name="quantity[]" required="required"></td>'+
         '<td><input type="text" class="form-control price" name="price[]" required="required"></td>'+
         '<td><input type="text" class="form-control discount-amount" name="discountamount[]"></td>'+
         '<td><input type="text" class="form-control discount" name="discount[]"></td>'+
         '<td><input type="text" class="form-control amount" name="amount[]" readonly="readonly"></td>'+
         '<td><a href="#" class="btn btn-primary remove"><i class="fa fa-times"></i></a> </td>'+
         '</tr>';

         $('.detail').append(tr);
     }

*/



    var a = ['','one ','two ','three ','four ', 'five ','six ','seven ','eight ','nine ','ten ','eleven ','twelve ','thirteen ','fourteen ','fifteen ','sixteen ','seventeen ','eighteen ','nineteen '];
    var b = ['', '', 'twenty','thirty','forty','fifty', 'sixty','seventy','eighty','ninety'];

    function inWords (num) {
        if ((num = num.toString()).length > 9) return 'overflow';
        n = ('000000000' + num).substr(-9).match(/^(\d{2})(\d{2})(\d{2})(\d{1})(\d{2})$/);
        if (!n) return;
        var str = '';
        str += (n[1] != 0) ? (a[Number(n[1])] || b[n[1][0]] + ' ' + a[n[1][1]]) + 'crore ' : '';
        str += (n[2] != 0) ? (a[Number(n[2])] || b[n[2][0]] + ' ' + a[n[2][1]]) + 'lakh ' : '';
        str += (n[3] != 0) ? (a[Number(n[3])] || b[n[3][0]] + ' ' + a[n[3][1]]) + 'thousand ' : '';
        str += (n[4] != 0) ? (a[Number(n[4])] || b[n[4][0]] + ' ' + a[n[4][1]]) + 'hundred ' : '';
        str += (n[5] != 0) ? ((str != '') ? 'and ' : '') + (a[Number(n[5])] || b[n[5][0]] + ' ' + a[n[5][1]]) + 'only ' : '';
        return str;
    }


</script>

<script type="text/javascript">

    $( "#shop_list" ).autocomplete({
        source: function(request, response) {
            console.info(request, 'request');
            console.info(response, 'response');

            $.ajax({
                //q: request.term,
                url: "<?php echo base_url('dashboard/json_shop_list')?>",
                data: { term: $("#shop_list").val()},
                dataType: "json",
                type: "POST",
                success: function(data) {
                    //console.info(data);
                    response(data);
                }
            });
        },
        minLength: 2
    });



</script>


</body>

</html>
