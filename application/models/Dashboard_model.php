<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
 * Description of Admin Model
 *
 * @author Md. Ziauddin <ziauddin.sarker@gmail.com>
 * @date 25th Dec, 2017
 *
 */
class Dashboard_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }


    /**
     *
     * Product
     *
     * @return array
     */
    function get_all_product()
    {
        $this->db->select('*');
        $this->db->select('serp_company.company_name as product_company_name');
        $this->db->from('serp_product');
        $this->db->join('serp_company','serp_product.product_company = serp_company.company_id');
        $query = $this->db->get();
        return $query->result();
    }


    function get_all_product_stock()
    {
        $this->db->select('serp_product_stock.stock_id,serp_product.product_name AS stock_product_name,serp_product_stock.stock_left AS stock_left,serp_product_stock.stock_date AS stock_date');
        $this->db->from('serp_product');
        $this->db->join('serp_product_stock','serp_product_stock.stock_product_id = serp_product.product_id');
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * @return array
     */
    function get_product_name()
    {
        $this->db->select('product_id,product_name');
        $this->db->from('serp_product');
        $this->db->order_by('product_name', 'ASC');
        $query = $this->db->get();
        $result = $query->result();

        //array to store department id & department name
        $product_name_id = array('');
        $product_name = array('-SELECT-');

        for ($i = 0; $i < count($result); $i++) {
            array_push($product_name_id, $result[$i]->product_id);
            array_push($product_name, $result[$i]->product_name);
        }
        return $doc_specility_result = array_combine($product_name_id, $product_name);
    }

    /**
     * @param $product_id
     * @return mixed
     */
    function edit_product($product_id){
        $this->db->join('serp_company','serp_product.product_company = serp_company.company_id');
        $data = $this->db->get_where('serp_product', array('serp_product.product_id' => $product_id))->row();
        return $data;
    }

    /**
     * @param $product_id
     */

    function update_product($product_id) {
        $product_update_data = array(
            'product_name' => $this->input->post('product-name'),
            'product_company' => $this->input->post('product-company'),
            'product_size' => $this->input->post('product-size'),
            'product_trade_price' => $this->input->post('product-trade-price'),
            'product_depo_price' => $this->input->post('product-depo-price'),
            //'product_add_date' => $this->input->post('product-add-date'),
        );

        $this->db->where('product_id', $product_id);
        $this->db->update('serp_product', $product_update_data);

    }

    function delete_product($product_id)
    {
        $this->db->where('product_id',$product_id);
        $this->db->delete('serp_product');
    }

    /**
     *
     *
     *
     * ****************Shop********************
     *
     */
    /**
     * @return array
     */
    function get_all_shop()
    {
        $this->db->select('*');
        $this->db->from('serp_shop');
        $query = $this->db->get();
        return $query->result();
    }

 /**
     *
     *
     *
     * ****************Company********************
     *
     */
    /**
     * @return array
     */
    function get_all_company()
    {
        $this->db->select('*');
        $this->db->from('serp_company');
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * @return array
     */
    function get_company_name()
    {
        $this->db->select('company_id,company_name');
        $this->db->from('serp_company');
        $this->db->order_by('company_name', 'ASC');
        $query = $this->db->get();
        $result = $query->result();

        //array to store department id & department name
        $company_id = array('');
        $company_name = array('-SELECT-');

        for ($i = 0; $i < count($result); $i++) {
            array_push($company_id, $result[$i]->company_id);
            array_push($company_name, $result[$i]->company_name);
        }
        return $doc_specility_result = array_combine($company_id, $company_name);
    }


    /**
     * @param $company_id
     * @return mixed
     */
    function edit_company($company_id){
        $data = $this->db->get_where('serp_company', array('serp_company.company_id' => $company_id))->row();
        return $data;
    }

    /**
     * @param $product_id
     */

    function update_company($company_id) {
        $company_update_data = array(
            'company_name' => $this->input->post('company-name'),
            'company_address' => $this->input->post('company-address'),
            'company_contact_number' => $this->input->post('company-contact'),
            'company_contact_person' => $this->input->post('company-contact-person'),
            'company_email' => $this->input->post('company-email'),
            //'product_add_date' => $this->input->post('product-add-date'),
        );

        $this->db->where('company_id', $company_id);
        $this->db->update('serp_company', $company_update_data);

    }

    function delete_company($company_id)
    {
        $this->db->where('company_id',$company_id);
        $this->db->delete('serp_company');
    }


    /*
     *
     * inventory
     *
     */

    function get_left_product_on_inventory($product_id = NULL){
        $this->db->select('stock_product_id,stock_left,stock_sold');
        $this->db->from('serp_product_stock');
        $this->db->where('stock_product_id',$product_id);
        $query = $this->db->get();
        return $query->result();
    }


    function all_products()
    {
        $this->db->select('serp_order_detail.date,serp_invoice.invoice_customer_name,serp_invoice.invoice_shop_name,serp_order_detail.amount');
        $this->db->from('serp_order');
        $query = $this->db->get();
        return $query->result();


    }

    function all_shops()
    {
        $this->db->select('*');
        $this->db->from('serp_shop');
        $query = $this->db->get();
        return $query->result();
    }

/**
 *
 *
 * Invoice
 *
 *
 */
    function count_all_invoice()
    {
        $this->db->select('serp_order.customer_id,serp_invoice.invoice_id,serp_order_detail.date,serp_invoice.invoice_customer_name,serp_invoice.invoice_shop_name,serp_order_detail.amount,serp_order_detail.discount_amount');
        $this->db->from('serp_order');
        $this->db->join('serp_order_detail','serp_order.order_id = serp_order_detail.id');
        $this->db->join('serp_invoice','serp_order.customer_id = serp_invoice.invoice_id');
        $this->db->group_by('customer_id');
        $norow = $this->db->count_all('serp_order');
        // $query = $this->db->get();
        return $norow;
    }


    function all_invoices()
    {
        $this->db->select('serp_invoice.invoice_id,serp_invoice.invoice_customer_name,
        serp_invoice.invoice_shop_name,
        serp_invoice.invoice_customer_phone,
        serp_invoice.invoice_customer_email,
        serp_invoice.invoice_customer_address,
        serp_invoice.invoice_date,
        serp_order_detail.invoice_no,
        serp_order.customer_id,
        SUM(quantity)as quantity,
        SUM(amount) as subtotal,
        sum(discount_amount) as totalDiscount,
        (SUM(amount)-sum(discount_amount)) as total');
        $this->db->from('serp_order');
        $this->db->join('serp_invoice','serp_order.customer_id = serp_invoice.invoice_id');
        $this->db->join('serp_order_detail','serp_order.order_id = serp_order_detail.id');
        $this->db->order_by('invoice_date','DESC');
        $this->db->group_by('customer_id');
        $query = $this->db->get();
        return $query->result();


    }

    /**
     * @param null $date
     * @return mixed
     */
    function get_daily_summary( $date = null)
    {
        if(!isset($date)) {
            $date = date("y-m-d");
        }else{
            $date = $date;
        }
        $this->db->select('*');
        $this->db->select('serp_order_detail.date,
                                serp_product.product_code,
                                sum(serp_order_detail.quantity) as totalquantity,
                                serp_order_detail.price,
                                ((serp_order_detail.price * COUNT(serp_product.product_id))*sum(serp_order_detail.quantity)) as  subtotal,
                                SUM(discount_amount) as discount,
								((serp_order_detail.price * COUNT(serp_product.product_id)*sum(serp_order_detail.quantity))- SUM(discount_amount)) as total');
        $this->db->from('serp_order_detail');
        $this->db->join('serp_product','serp_product.product_id = serp_order_detail.product_id');
        $this->db->group_by('serp_product.product_id');
        $this->db->where('date',$date);
        $query = $this->db->get();
        return $query->result();
    }




}