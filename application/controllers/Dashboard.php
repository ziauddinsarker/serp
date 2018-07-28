<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Dashboard Controller
 *
 * @author Md. Ziauddin <ziauddin.sarker@gmail.com>
 * @date 25th Dec, 2017
 *
 */
class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->genlib->checkLogin();

        $this->load->model(['product']);
        $this->load->model(['dashboard_model']);
        //Get all product to show in product list
        $this->data['all_products'] = $this->dashboard_model->get_all_product();

        //Get all shops to show in shop list
        $this->data['all_shops'] = $this->dashboard_model->get_all_shop();


        //Get all companys to show in company list
        $this->data['all_companys'] = $this->dashboard_model->get_all_company();

        $this->data['all_stock'] = $this->dashboard_model->get_all_product_stock();


        //List showing to show as a dropodown list
        $this->data['product_name_list'] = $this->dashboard_model->get_product_name();
        $this->data['product_name_list_json'] = $this->dashboard_model->get_product_name_json();
        $this->data['shop_name_list_json'] = $this->dashboard_model->get_shop_name_json();

        $this->data['company_name_list'] = $this->dashboard_model->get_company_name();


        $this->data['all_invoice'] = $this->dashboard_model->all_invoices();

        //var_dump($this->data['company_name_list']);
        //var_dump($this->data['all_stock']);
    }

    public function index()
    {
        $this->load->view('admin/pages/admin_header');
        $this->load->view('admin/pages/index');
        $this->load->view('admin/pages/admin_footer');
    }

    // Product List

    /**
     *
     */
    public function product_list()
    {
        $this->load->view('admin/pages/admin_header');
        $this->load->view('admin/pages/product_list',$this->data);
        $this->load->view('admin/pages/admin_footer');
    }

//TODO json search Product
    public function json_search_buyer()
    {
        $query  = $this->dashboard_model->all_products();

        $data = array();

        foreach ($query as $key => $value)
        {
            $data[] = array('id' => $value->product_id, 'name' => $value->product_name, 'price' => $value->product_trade_price);
        }


        echo json_encode($data);
    }

//TODO json shop list
    public function json_shop_list()
    {
        $query  = $this->dashboard_model->all_shops();

        $data = array();

        foreach ($query as $key => $value)
        {
            $data[] = array('shop_id' => $value->shop_id, 'shop_name' => $value->shop_name);
        }
        echo json_encode($data);
    }




    // Product List
    public function add_product_to_list()
    {
        $this->load->view('admin/pages/admin_header');
        $this->load->view('admin/pages/add_product',$this->data);
        $this->load->view('admin/pages/admin_footer');
    }

    /**
     * @add_to_product_list
     * Add product to product list
     *
     */
    function add_to_product()
    {
        $this->form_validation->set_rules('product-name', 'Product Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('product-company', 'ProductCompany Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('product-size', 'Product Size', 'trim|required|xss_clean');
        $this->form_validation->set_rules('product-trade-price', 'Product Trade Price', 'trim|required|xss_clean');
        $this->form_validation->set_rules('product-depo-price', 'Product Depo Price', 'trim|required|xss_clean');
        $this->form_validation->set_rules('product-add-date', 'Product add Date', 'trim|xss_clean');
        // hold error messages in div
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        if ($this->form_validation->run() == FALSE) {
            $data['error'] = validation_errors();
            //fail validation

            $this->load->view('admin/pages/admin_header');
            $this->load->view('admin/pages/add_product',$this->data);
            $this->load->view('admin/pages/admin_footer');

        } else {
            $product_name = $this->input->post('product-name');
            $product_company = $this->input->post('product-company');
            $product_size = $this->input->post('product-size');
            $product_trade_price = $this->input->post('product-trade-price');
            $product_depo_price = $this->input->post('product-depo-price');
            $product_data = array(
                'product_name' => $product_name,
                'product_company' => $product_company,
                'product_size' => $product_size,
                'product_trade_price' => $product_trade_price,
                'product_depo_price' => $product_depo_price
            );
            $this->db->insert('serp_product', $product_data);
            $this->session->set_flashdata('added_product', 'Name Added Successfully');
            redirect('dashboard/product_list');
        }

    }

    /**
     *
     * Edit Product
     *
     *
     */

    function edit_product(){

        $this->data['company_list'] = $this->dashboard_model->get_company_name();

        $product_id = $this->uri->segment(3);
        if ($product_id == NULL) {
            redirect('dashboard/product_list');
        }

        $dt = $this->dashboard_model->edit_product($product_id);
       //var_dump($dt);

        $data['product_id'] = $dt->product_id;
        $data['product_name'] = $dt->product_name;
        $data['product_size'] = $dt->product_size;
        $data['product_trade_price'] = $dt->product_trade_price;
        $data['product_depo_price'] = $dt->product_depo_price;
        //$data['product_add_date'] = $dt->product_add_date;
        $data['company_id'] = $dt->company_id;

        //var_dump($data['company_name']);

        $this->load->view('admin/pages/admin_header',$this->data);
        $this->load->view('admin/pages/edit_product',$data);
        $this->load->view('admin/pages/admin_footer',$this->data);
    }

    /**
     *
     * Update Product
     *
     *
     */


    function update_product(){
        if ($this->input->post('update')) {
            $productId = $this->input->post('product-id');
            $this->dashboard_model->update_product($productId);
            redirect('dashboard/product_list');
        } else{
            $id = $this->input->post('product-id');
            redirect('dashboard/edit_product/'. $id);
        }
    }

    /**+
     * @param $product_id
     * Delete a product from a product List
     */
    public function delete_product($product_id){
        $this->dashboard_model->delete_product($product_id);
        redirect(base_url('dashboard/product_list'));
    }




    // Add Product Group
    public function add_product_group()
    {
        $this->load->view('admin/pages/admin_header');
        $this->load->view('admin/pages/add_product_group');
        $this->load->view('admin/pages/admin_footer');
    }

    // Add Product Group
    public function shop_list()
    {
        $this->load->view('admin/pages/admin_header');
        $this->load->view('admin/pages/shop_list',$this->data);
        $this->load->view('admin/pages/admin_footer');
    }

    // Add Product Group
    public function add_shop_to_list()
    {
        $this->load->view('admin/pages/admin_header');
        $this->load->view('admin/pages/add_shop');
        $this->load->view('admin/pages/admin_footer');
    }


    // Add Product Group
    public function add_shop_group()
    {
        $this->load->view('admin/pages/admin_header');
        $this->load->view('admin/pages/add_shop_group');
        $this->load->view('admin/pages/admin_footer');
    }


    /**
     *
     * Stock
     *
     */
    public function stock_list()
    {
        $this->load->view('admin/pages/admin_header');
        $this->load->view('admin/pages/stock_list',$this->data);
        $this->load->view('admin/pages/admin_footer');
    }
    // Product List
    public function add_product_stock()
    {
        $this->load->view('admin/pages/admin_header');
        $this->load->view('admin/pages/add_product_stock',$this->data);
        $this->load->view('admin/pages/admin_footer');
    }


    //Add Product stock
    function add_product_to_stock()
    {
        $this->form_validation->set_rules('stock-product-name', 'Product Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('stock-quantity', 'Stock Quantity', 'trim|required|xss_clean');
        // hold error messages in div
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        if ($this->form_validation->run() == FALSE) {
            $data['error'] = validation_errors();
            //fail validation

            $this->load->view('admin/pages/admin_header');
            $this->load->view('admin/pages/add_product_stock',$this->data);
            $this->load->view('admin/pages/admin_footer');

        } else {
            $stock_product_name = $this->input->post('stock-product-name');


            $this->db->select('stock_product_id');
            $this->db->from('serp_product_stock');
            $this->db->where('stock_product_id', $stock_product_name);
            $num_rows = $this->db->count_all_results();


            //If There is no given product in the stock then add product to stock
            if($num_rows == NULL || $num_rows == '' ||$num_rows == 0  ) {
                $stock_product_id = $this->input->post('stock-product-name');
                $stock_quantity = $this->input->post('stock-quantity');

                $product_data = array(
                    'serp_product_stock.stock_product_id' => $stock_product_id,
                    'serp_product_stock.stock_quantity' => $stock_quantity,
                );
                $this->db->insert('serp_product_stock', $product_data);


            }

            // If Product exist then update data
            if($num_rows == 1){
                $stock_product_id = $this->input->post('stock-product-name');
                $stock_quantity = $this->input->post('stock-quantity');

                $product_left = $this->db->select('stock_product_id,stock_left')->get_where('serp_product_stock', array('stock_product_id' => $stock_product_id))->row()->stock_left;
                $final_stock_quantity = $product_left + $stock_quantity;



                $update_data = array(
                    'stock_left' => $final_stock_quantity,
                );
                $this->db->where('stock_product_id', $stock_product_id);
                $this->db->update('serp_product_stock', $update_data);

            }

            $this->session->set_flashdata('Stock_added', 'Stock Added Successfully');
            redirect('dashboard/stock_list');
        }

    }
    /**
     *
     *
     ********* Shop Related everything here**************
     *
     *
     */

    /**
     * @add_to_product_list
     * Add product to product list
     *
     */
    function add_to_shop()
    {
        $this->form_validation->set_rules('shop-name', 'Shop Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('shop-address', 'Shop Address', 'trim|required|xss_clean');
        $this->form_validation->set_rules('shop-contact', 'Shop Contact', 'trim|required|xss_clean');
        $this->form_validation->set_rules('shop-contact-person', 'Shop In charge', 'trim|xss_clean');
        $this->form_validation->set_rules('shop-picture', 'Shop Picture', 'trim|xss_clean');
        $this->form_validation->set_rules('shop-map-location', 'Shop Map Location', 'trim|xss_clean');
        // hold error messages in div
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        if ($this->form_validation->run() == FALSE) {
            $data['error'] = validation_errors();
            //fail validation

            $this->load->view('admin/pages/admin_header');
            $this->load->view('admin/pages/add_shop');
            $this->load->view('admin/pages/admin_footer');

        } else {
            $shop_name = $this->input->post('shop-name');
            $shop_address = $this->input->post('shop-address');
            $shop_contact = $this->input->post('shop-contact');
            $shop_contact_person = $this->input->post('shop-contact-person');
            $shop_picture = $this->input->post('shop-picture');
            $shop_map_location = $this->input->post('shop-map-location');
            $shop_add_date = '';
            $shop_data = array(
                'shop_name' => $shop_name,
                'shop_address' => $shop_address,
                'shop_contact' => $shop_contact,
                'shop_contact_person' => $shop_contact_person,
                'shop_picture' => $shop_picture,
                'shop_map_location' => $shop_map_location,
                'shop_add_date' => $shop_add_date
            );
            $this->db->insert('serp_shop', $shop_data);
            $this->session->set_flashdata('shop_added', 'Name Added Successfully');
            redirect('dashboard/shop_list');
        }

    }


    /*
     *
     *
     * Company Related everything
     *
     *
     *
     **/
    public function company_list()
    {
        $this->load->view('admin/pages/admin_header');
        $this->load->view('admin/pages/company_list',$this->data);
        $this->load->view('admin/pages/admin_footer');
    }

    /**
     *
     * Edit Company
     *
     *
     */

    function edit_company(){

        //$this->data['company_list'] = $this->dashboard_model->get_company_name();

        $company_id = $this->uri->segment(3);
        if ($company_id == NULL) {
            redirect('dashboard/company_list');
        }

        $dt = $this->dashboard_model->edit_company($company_id);
       // var_dump($dt);

        $data['company_id'] = $dt->company_id;
        $data['company_name'] = $dt->company_name;
        $data['company_contact_person'] = $dt->company_contact_person;
        $data['company_contact_number'] = $dt->company_contact_number;
        $data['company_address'] = $dt->company_address;
        $data['company_email'] = $dt->company_email;
        //$data['product_add_date'] = $dt->product_add_date;


        //var_dump($data['company_name']);

        $this->load->view('admin/pages/admin_header',$this->data);
        $this->load->view('admin/pages/edit_company',$data);
        $this->load->view('admin/pages/admin_footer',$this->data);
    }


    function update_company(){
        if ($this->input->post('update')) {
            $companyId = $this->input->post('company-id');
            $this->dashboard_model->update_company($companyId);
            redirect('dashboard/company_list');
        } else{
            $id = $this->input->post('company-id');
            redirect('dashboard/edit_company/'. $id);
        }
    }




    /**
     * @param $company_id
     * Delete a product from a product List
     */
    public function delete_company($company_id){
        $this->dashboard_model->delete_company($company_id);
        redirect(base_url('dashboard/company_list'));
    }


    // Product List
    public function add_company_to_list()
    {
        $this->load->view('admin/pages/admin_header');
        $this->load->view('admin/pages/add_company');
        $this->load->view('admin/pages/admin_footer');
    }

    /**
     * @add_to_product_list
     * Add product to product list
     *
     */
    function add_to_company()
    {
        $this->form_validation->set_rules('company-name', 'Company Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('company-address', 'Company Address', 'trim|required|xss_clean');
        $this->form_validation->set_rules('company-contact', 'Company Contact', 'trim|required|xss_clean');
        $this->form_validation->set_rules('company-contact-person', 'Company In charge', 'trim|xss_clean');
        $this->form_validation->set_rules('company-Email', 'Company Email', 'trim|xss_clean');
        // hold error messages in div
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        if ($this->form_validation->run() == FALSE) {
            $data['error'] = validation_errors();
            //fail validation

            $this->load->view('admin/pages/admin_header');
            $this->load->view('admin/pages/add_company');
            $this->load->view('admin/pages/admin_footer');

        } else {
            $company_name = $this->input->post('company-name');
            $company_address = $this->input->post('company-address');
            $company_contact = $this->input->post('company-contact');
            $company_contact_person = $this->input->post('company-contact-person');
            $company_email = $this->input->post('company-email');
            $company_add_date = '';
            $company_data = array(
                'company_name' => $company_name,
                'company_address' => $company_address,
                'company_contact_number' => $company_contact,
                'company_contact_person' => $company_contact_person,
                'company_email' => $company_email,
                'company_add_date' => $company_add_date
            );
            $this->db->insert('serp_company', $company_data);
            $this->session->set_flashdata('company_added', 'Company Added Successfully');
            redirect('dashboard/company_list');
        }

    }


    /*
    *
    *
    * Sales Related everything
    *
    *@
    *
    **/
    public function  invoice_list()
    {
        $this->load->view('admin/pages/admin_header');
        $this->load->view('admin/pages/sales_list',$this->data);
        $this->load->view('admin/pages/admin_footer');
    }


    // Product List
    public function view_single_invoice()
    {
        $this->load->view('admin/pages/admin_header');
        $this->load->view('admin/pages/add_company');
        $this->load->view('admin/pages/admin_footer');
    }


    public function all_invoice_daily_summary(){

            $date = $this->input->post('date');
            $this->data['show_date'] = $this->input->post('date');
            $this->data['daily_summary'] = $this->dashboard_model->get_daily_summary($date);
            $this->load->view('admin/admin_header_view',$this->data);
            $this->load->view('inventory/view_daily_summary',$this->data);
            $this->load->view('admin/admin_footer_view',$this->data);
    }



    /*
     *
     * Invoice
     *
     *
     */
    // Product List
    public function invoice()
    {
        //$this->data['all_products'] = $this->dashboard_model->all_products();
       // $inventory  = $this->dashboard_model->get_left_product_on_inventory(5);
       // var_dump($inventory);


        $this->load->view('admin/pages/admin_header');
        $this->load->view('admin/pages/add_invoice',$this->data);
        $this->load->view('admin/pages/admin_footer');
    }


    public function searchProductInInvoice(){
        $result = [];
        $this->load->database();
        if(!empty($this->input->get("q"))){

            $this->db->like('product_name', $this->input->get("q"));

            $sql_query = $this->db->select('product_id,product_name')

                ->limit(10)

                ->get("serp_product");

            $result = $sql_query->result();

        }
        echo json_encode($result);
    }


//TODO need to make new invoice number



    function invno(){
        //Today
        $today = date("dmy");
        $total_invoice = $this->dashboard_model->count_all_invoice();
        var_dump($total_invoice);
        $leadingzeros = '0000';
        $dailyleadingzeros = '000';
        $total_invoice = $total_invoice + 1;

        //Query for maximum date in orderdails for last order date
        $this->db->select('max(date) as date');
        $this->db->from('serp_order_detail');
        $querymaxdate = $this->db->get();

        foreach ($querymaxdate->result() as $row) {
            $lastdate = $row->date;
        }

        //var_dump($lastdate);
        $todaydate = date('Y-m-d');

        $this->db->select('COUNT(date)as date,tbl_product.product_code,tbl_customer.customer_name');
        $this->db->from('tbl_customer');
        $this->db->join('tbl_order','tbl_order.customer_id = tbl_customer.id');
        $this->db->join('tbl_orderdetail','tbl_order.order_id = tbl_orderdetail.id');
        $this->db->join('tbl_product','tbl_product.id = tbl_orderdetail.product_code');
        $this->db->group_by('invoice_no');
        $this->db->where('date',$todaydate);
        $querytotalselltoday = $this->db->get();

        $total_today = $querytotalselltoday->num_rows();

        if ($querytotalselltoday->num_rows() > 0) {
            if ($todaydate == $lastdate) {
                $total_today = $total_today + 1;
            }else {
                $total_today = 1;
            }

        }else{
            $total_today = 1;
        }

        //Check if there is no invoice in total invoice
        if($total_invoice == 0 ){
            $total_invoice = 1;

            $firstinvoiceno = "SIN-".$today."-1-".substr($leadingzeros, 0, (-strlen($total_invoice))).$total_invoice;
            return $firstinvoiceno;
        }else{
            $total_invoice = $total_invoice;

            $firstinvoiceno = "SIN-".$today."-". substr($dailyleadingzeros, 0, (-strlen($total_today))).$total_today ."-".substr($leadingzeros, 0, (-strlen($total_invoice))).$total_invoice;
            return $firstinvoiceno;
        }
    }


    function save_invoice(){
        $customer_data = array(
            'invoice_shop_id' => $this->input->post('shop_id'),
            'invoice_shop_name' => $this->input->post('shop-name'),
            'invoice_customer_name' => $this->input->post('customer-name'),
            'invoice_customer_phone' => $this->input->post('customer-phone'),
            'invoice_customer_email' => $this->input->post('customer-email'),
            'invoice_customer_address' => $this->input->post('customer-address'),
            'invoice_date' => $this->input->post('invoice_date')
        );
        $this->db->insert('serp_invoice', $customer_data);
        $customer_id = $this->db->insert_id();

        //echo "Product Code Count: ";
        //var_dump(count($this->input->post('productcode')));
        //Check inventory and update inventory
        for ($i = 0; $i < count($this->input->post('productcode')); $i++){

            $product_id = $this->input->post('productcodeid')[$i];
            $product_quantity = $this->input->post('quantity')[$i];


            //echo "The number is: $product_id <br>";
            //echo "The Quantity is: $product_quantity <br>";

            //echo "Product ID: " . var_dump($product_id);
           // var_dump($product_id);

            $inventory  = $this->dashboard_model->get_left_product_on_inventory($product_id);

            //echo "Inventory: ";
            //var_dump($inventory);


            foreach($inventory as $inventory){
                $product_left = $inventory->stock_left;
                $product_sold = $inventory->stock_sold;
            }
           // echo "Product Left: ";
           // var_dump($product_left);
           // echo "Product Sold: ";
           // var_dump($product_sold);

            if($product_quantity > $product_left){

            }

            $final_product_left = $product_left - $product_quantity;
            $final_product_sold = $product_sold + $product_quantity;

            $order_detail = array(
                'stock_left' => $final_product_left,
                'stock_sold' => $final_product_sold
            );

           // var_dump($order_detail);

            $this->db->where('stock_product_id',$product_id);
            $this->db->update('serp_product_stock', $order_detail);

            $order_detail = array(
                'invoice_no' => $this->input->post('invoice-no'),
                'product_code' => $this->input->post('productcodeid')[$i],
                'quantity' => $this->input->post('quantity')[$i],
                'price' => $this->input->post('price')[$i],
                'discount' => $this->input->post('discount')[$i],
                'discount_amount' => $this->input->post('discountamount')[$i],
                'amount' => $this->input->post('amount')[$i],

                'date' => date("Y-m-d"),
            );

            $this->db->insert('serp_order_detail', $order_detail);
            $order_id = $this->db->insert_id();

            //var_dump($order_id);
           // var_dump($customer_id);

            $order_data = array(
                'order_id' => $order_id,
                'customer_id' => $customer_id
            );

            $this->db->insert('serp_order', $order_data);
        }


        /*

                //PDF output
                $this->fpdf->SetTitle("ICS - PDF Output");
                //Set Font for Header

                // Logo
                //$this->fpdf->Image(base_url('assets/images/simura.png'),10,6,30);
                    // Arial bold 15
                //$this->fpdf->SetFont('Arial','B',15);
                    // Move to the right
                //$this->fpdf->Cell(80);
                // Add page with a grid and default spacing (5mm)

                $this->fpdf->Ln(15);
                $this->fpdf->setFont('Arial','',30);
                $this->fpdf->setFillColor(255,255,255);
                //$this->fpdf->cell(200,0,"SIMURA",0,0,'C',1);
                //$this->fpdf->cell(100,6,' ',0,1,'C',1);

                $this->fpdf->Image(base_url('assets/images/simura.png'),10,15,40);
                $this->fpdf->Cell(35);
                $this->fpdf->cell(100,5,' ',0,1,'C',1);
                $this->fpdf->SetFontSize(15);
                $this->fpdf->SetFillColor(131,173,246);
                $this->fpdf->cell(90,6,"Invoice",0,0,'R',1);

                $this->fpdf->cell(100,6,' ',0,1,'L',1);
                $this->fpdf->setFont('Arial','',10);
                $this->fpdf->setFillColor(255,255,255);
                $this->fpdf->cell(70,6,"Customer Name: ". $this->input->post('name'),0,0,'L',1);
                $this->fpdf->cell(90,6,"Date : " . date('d/m/Y'),0,1,'R',1);

                $this->fpdf->cell(50,6,"Phone: " . $this->input->post('phone'),0,0,'L',1);
                $this->fpdf->cell(138,6,"Invoice No. : " . $this->input->post('invoice-no'),0,1,'R',1);

                $this->fpdf->cell(100,6,"Email : " . $this->input->post('email'),0,0,'L',1);

                $this->fpdf->cell(50,6,' ',0,1,'C',1);
                $this->fpdf->cell(138,6,"Address : " . $this->input->post('address'),0,0,'L',1);

                $this->fpdf->Ln(12);
                $this->fpdf->setFont('Arial','',14);
                $this->fpdf->setFillColor(255,255,255);
                $this->fpdf->cell(25,6,'',0,0,'C',0);

                $this->fpdf->Ln(1);
                $this->fpdf->setFont('Arial','',10);
                $this->fpdf->SetFillColor(200,220,255);


                */
        /**
         * Content
         *
         */
        /*
                $this->fpdf->cell(10,6,'#',1,0,'C',1);
                $this->fpdf->cell(85,6,'Product ID',1,0,'C',1);
                $this->fpdf->cell(25,6,'Quantity',1,0,'C',1);
                $this->fpdf->cell(30,6,'Unit Price',1,0,'C',1);
                //$this->fpdf->cell(25,6,'Discount (%)',1,0,'C',1);
                //$this->fpdf->cell(35,6,'Discount (BDT)',1,0,'C',1);
                $this->fpdf->cell(40,6,'Total (bdt)',1,0,'C',1);
        */

        /**
         * SQL
         */
        /*
                $this->db->select('*');
                $this->db->from('tbl_customer');
                $this->db->join('tbl_order','tbl_order.customer_id = tbl_customer.id');
                $this->db->join('tbl_orderdetail','tbl_order.order_id = tbl_orderdetail.id');
                $this->db->join('tbl_product','tbl_product.id = tbl_orderdetail.product_code');
                $this->db->where('customer_id',$customer_id);
                $query = $this->db->get('');
                $result = $query->result();
                //var_dump($result);
                //
                $id = 0;
                foreach($result as $row) {

                    $id++;
                    $this->fpdf->Ln(6);
                    $this->fpdf->cell(10,6,$id,1,0,1);

                    $this->fpdf->cell(85,6,$row->product_code,1,0,1);
                    $this->fpdf->cell(25,6,$row->quantity,1,0,1);
                    $this->fpdf->cell(30,6,$row->price,1,0,1);
                    //$this->fpdf->cell(25,6,$row->discount.'%',1,0,1);
                    //$this->fpdf->cell(35,6,$row->discount_amount,1,0,1);
                    $this->fpdf->cell(40,6,$row->amount,1,0,'R',1);
                }


                $this->db->select('SUM(amount) AS subtotal, SUM(discount_amount) AS totaldiscount');
                $this->db->from('tbl_customer');
                $this->db->join('tbl_order','tbl_order.customer_id = tbl_customer.id');
                $this->db->join('tbl_orderdetail','tbl_order.order_id = tbl_orderdetail.id');
                $this->db->join('tbl_product','tbl_product.id = tbl_orderdetail.product_code');
                $this->db->where('customer_id',$customer_id);
                $query = $this->db->get('');

                $result = $query->result();
                foreach($result as $row) {

                    $this->fpdf->Ln(6);
                    $this->fpdf->Cell(120);
                    $this->fpdf->cell(30, 6, 'Subtotal', 1, 0, 1);
                    $this->fpdf->cell(40, 6, $row->subtotal, 1,0,'R',1);
                    $this->fpdf->Ln(6);
                    $this->fpdf->Cell(120);
                    $this->fpdf->cell(30, 6, 'Discount', 1, 0, 1);
                    $this->fpdf->cell(40, 6, $row->totaldiscount, 1, 0,'R',1);
                    $this->fpdf->Ln(6);
                    $this->fpdf->Cell(120);
                    $this->fpdf->cell(30, 6, 'Grand Total', 1, 0, 1);
                    $this->fpdf->cell(40, 6, ($row->subtotal - $row->totaldiscount).".00", 1, 0,'R',1);
                }

                $this->fpdf->Ln(20);
                //$this->fpdf->Cell(10);
                $this->fpdf->Cell(0,10,'In Word: '.$this->input->post('inword'),0,0,'L');

                //$this->fpdf->SetY(-52);
                // Arial italic 8
                //$this->fpdf->SetFont('Arial','',8);
                // Page number
                //$this->fpdf->Cell(0,10,'Corporate Office: 109, Masjid Road, Old  D.O.H.S, Banani, Dhaka-1206',0,0,'L');
                //$this->fpdf->SetY(-48);
                //$this->fpdf->Cell(0,10,'Outlet-01: 24, Malitola Road(1st Floor), Dhaka - 1100',0,0,'L');
                //$this->fpdf->SetY(-44);
                //$this->fpdf->Cell(0,10,'Phone: +8802 8713301-04',0,0,'L');

                $this->fpdf->SetY(-50);
                //$this->fpdf->SetLineWidth(0.5);
                //$this->fpdf->Line(250, 227, 0, 227);

                $this->fpdf->SetLineWidth(0.1);
                $this->fpdf->SetDash(2,2); //5mm on, 5mm off
                $this->fpdf->Line(250, 227, 0, 227);

                //$this->fpdf->SetY(-80);
                $this->fpdf->Image(base_url('assets/images/simcoupon.png'),30,230,150);
                // Position at 1.5 cm from bottom
                //$this->fpdf->SetY(-31);
                // Arial italic 8
                //$this->fpdf->SetFont('Arial','',12);
                // Page number
                //$this->fpdf->Cell(0,10,'Thank You For Our Business',0,0,'C');

                //$this->fpdf->SetY(-31);
                //$this->fpdf->SetFont('Arial','',8);
                //$this->fpdf->Cell(0,10,'Corporate Office: 109, Masjid Road, Old  D.O.H.S, Banani, Dhaka-1206',0,0,'L');


        */
        /**
         * Footer
         */
        /*
            //$this->fpdf->AliasNbPages();
            //$this->fpdf->SetFont('Times','',12);

        //Open PDF on same page
        $this->fpdf->Output("Invoice.pdf", "I");

        //$this->fpdf->Output("Invoice.pdf",'F');

        //Save Invoice to Local Computer
        //$this->fpdf->Output("Invoice.pdf",'D');

        //$this->fpdf->Output("Invoice.pdf",'S');

        //echo $this->fpdf->Output('ics.pdf','D');

        //redirect('inventory/invoice', 'refresh');
        */
        redirect('/dashboard/invoice');
    }

    /****************Invoice***************/
    public function all_invoice($offset = 0){
        // Config setup
        $config['base_url'] = base_url().'/dashboard/all_invoice/';
        //$config['total_rows']= $this->db->count_all('brand');
        $config['total_rows']= $this->dashboard_model->count_all_invoice();

        $config['per_page'] = 10;
        // I added this extra one to control the number of links to show up at each page.
        $config['num_links'] = 10;
        /******************************/
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        /******************************/
        // Initialize
        $this->pagination->initialize($config);

        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('login/index', 'refresh');
        } else {
            //$data['total_rows']= $this->inventory_model->count_all_invoice();
            //var_dump($data['total_rows']);
            $this->data['invoices'] = $this->inventory_model->get_all_invoice(10,$offset);
            $this->data['count_invoice'] = $this->inventory_model->count_all_invoice();
            $this->data['total_sold_by']= $this->inventory_model->count_sold_by_seller();
            $this->data['total_sold_amount_by']= $this->inventory_model->count_sold_amount_by_seller();
            //var_dump($this->data['total_sold_by']);

            $this->load->view('admin/admin_header_view',$this->data);
            $this->load->view('inventory/view_all_invoice',$this->data);
            $this->load->view('admin/admin_footer_view',$this->data);
        }
    }

/**************************
    function invno(){
        //Today
        $today = date("dmy");
        $total_invoice = $this->inventory_model->count_all_invoice();
        $leadingzeros = '0000';
        $dailyleadingzeros = '000';
        $total_invoice = $total_invoice + 1;

        //Query for maximum date in orderdails for last order date
        $this->db->select('max(date) as date');
        $this->db->from('tbl_orderdetail');
        $querymaxdate = $this->db->get();

        foreach ($querymaxdate->result() as $row) {
            $lastdate = $row->date;
        }

        //var_dump($lastdate);
        $todaydate = date('Y-m-d');

        $this->db->select('COUNT(date)as date,tbl_product.product_code,tbl_customer.customer_name');
        $this->db->from('tbl_customer');
        $this->db->join('tbl_order','tbl_order.customer_id = tbl_customer.id');
        $this->db->join('tbl_orderdetail','tbl_order.order_id = tbl_orderdetail.id');
        $this->db->join('tbl_product','tbl_product.id = tbl_orderdetail.product_code');
        $this->db->group_by('invoice_no');
        $this->db->where('date',$todaydate);
        $querytotalselltoday = $this->db->get();

        $total_today = $querytotalselltoday->num_rows();

        if ($querytotalselltoday->num_rows() > 0) {
            if ($todaydate == $lastdate) {
                $total_today = $total_today + 1;
            }else {
                $total_today = 1;
            }

        }else{
            $total_today = 1;
        }

        //Check if there is no invoice in total invoice
        if($total_invoice == 0 ){
            $total_invoice = 1;

            $firstinvoiceno = "SIN-".$today."-1-".substr($leadingzeros, 0, (-strlen($total_invoice))).$total_invoice;
            return $firstinvoiceno;
        }else{
            $total_invoice = $total_invoice;

            $firstinvoiceno = "SIN-".$today."-". substr($dailyleadingzeros, 0, (-strlen($total_today))).$total_today ."-".substr($leadingzeros, 0, (-strlen($total_invoice))).$total_invoice;
            return $firstinvoiceno;
        }
    }
/*****************/


}