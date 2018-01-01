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

        $this->data['company_name_list'] = $this->dashboard_model->get_company_name();

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

                $product_left = $this->db->select('stock_product_id,stock_quantity')->get_where('serp_product_stock', array('stock_product_id' => $stock_product_id))->row()->stock_quantity;
                $final_stock_quantity = $product_left + $stock_quantity;



                $update_data = array(
                    'stock_quantity' => $final_stock_quantity,
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
    * Company Related everything
    *
    *
    *
    **/
    public function  sales_list()
    {
        $this->load->view('admin/pages/admin_header');
        $this->load->view('admin/pages/company_list',$this->data);
        $this->load->view('admin/pages/admin_footer');
    }

    // Product List
    public function add_sales_to_list()
    {
        $this->load->view('admin/pages/admin_header');
        $this->load->view('admin/pages/add_company');
        $this->load->view('admin/pages/admin_footer');
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
        $this->load->view('admin/pages/admin_header');
        $this->load->view('admin/pages/add_invoice',$this->data);
        $this->load->view('admin/pages/admin_footer');
    }






}