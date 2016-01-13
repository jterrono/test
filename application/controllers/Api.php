<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Api extends REST_Controller {

	function __construct() {
		parent::__construct();

        $this->load->model('api_model');
        $this->load->library('form_validation');
	}



    /**
     * Get Product
     *
     * This function will take the product id from the uri segment & return the products details
     * associated to the product id.
     *
     */
	function product_get()
    {
        $product_id = $this->uri->segment(3);

        $product = $this->api_model->get_product($product_id);

        if(!empty($product))
        {
            $this->response(array('status' => 'success', 'message' => $product));
        }
        else
        {
            $this->response(array('status' => 'failure', 'message' => 'The specified product could not be found'), REST_CONTROLLER::HTTP_NOT_FOUND);
        }

	}

    /**
     * Get Products
     *
     * This function will return all the active products.
     *
     */
	function products_get() {

        $products = $this->api_model->get_products();

        if(isset($products))
        {
            $this->response(array('status' => 'success', 'message' => $products));
        }
        else
        {
            $this->response(array('status' => 'failure', 'message' => 'The specified product could not be found'), REST_CONTROLLER::HTTP_NOT_FOUND);
        }

	}


    /**
     * Add Product
     *
     * This function will add a product to the databse.
     */
    function product_put()
    {
        $this->form_validation->set_data($this->put());

        if($this->form_validation->run('product_put') != false){

            $product = $this->put();

            $product_id = $this->api_model->insert_product($product);

            if(!$product_id)
            {
                  $this->response(array('status' => 'failure', 'message' => 'An unexpected error occured while trying to create the product'), REST_CONTROLLER::HTTP_INTERNAL_SERVER_ERROR);
            }
            else
            {
                $this->response(array('status' => 'success', 'message' => 'created'));
            }
        }
        else
        {
            $this->response(array('status' => 'failure', 'message' => $this->form_validation->get_errors_as_array()), REST_Controller::HTTP_BAD_REQUEST);
        }
    }


    /**
     * Update Product
     *
     */
    function product_post() {

        $product_id = $this->uri->segment(3);

        $this->form_validation->set_data($this->post());

        if($this->form_validation->run('product_post') != false){

            $product = $this->post();

            $updated = $this->api_model->update_product($product_id, $product);

            if(!$updated)
            {
                  $this->response(array('status' => 'failure', 'message' => 'An unexpected error occured while trying to update the product'), REST_CONTROLLER::HTTP_INTERNAL_SERVER_ERROR);
            }
            else
            {
                $this->response(array('status' => 'success', 'message' => 'updated'));
            }
        }
        else
        {
            $this->response(array('status' => 'failure', 'message' => $this->form_validation->get_errors_as_array()), REST_Controller::HTTP_BAD_REQUEST);
        }
	}

    /**
     * Update Product
     */
    function product_image_post() {

        $product_id = $this->uri->segment(3);

        $response = $this->api_model->get_product($product_id);

        if(!empty($response)){

            $product = $this->post();

            $updated = $this->api_model->update_product_image($product_id, $product['image_url']);

            if(!$updated)
            {
                  $this->response(array('status' => 'failure', 'message' => 'An unexpected error occured while trying to update the product'), REST_CONTROLLER::HTTP_INTERNAL_SERVER_ERROR);
            }
            else
            {
                $this->response(array('status' => 'success', 'message' => 'updated'));
            }
        }
        else
        {
            $this->response(array('status' => 'failure', 'message' => $this->form_validation->get_errors_as_array()), REST_Controller::HTTP_BAD_REQUEST);
        }

	}

    /**
     * Update Product
     */
    function product_image1_post() {

       $product_id = $this->uri->segment(3);
        
        $response = $this->api_model->get_product($product_id);

        if(!empty($response))
        {
            $updated = $this->api_model->update_product_image1($product_id);

            if(!$updated)
            {
                $this->response(array('status' => 'failure', 'message' => 'An unexpected error occured while trying to update the product'), REST_CONTROLLER::HTTP_INTERNAL_SERVER_ERROR);
            }
            else
            {
                $this->response(array('status' => 'success', 'message' => 'updated'));
            }
        }
        else
        {
            $this->response(array('status' => 'failure', 'message' => 'The specified product could not be found'), REST_CONTROLLER::HTTP_NOT_FOUND);
        }



     $this->response(array('status' => 'success', 'message' => $_FILES));

	}


    /**
     * Delete Product
     */
    function product_delete() {

        $product_id = $this->uri->segment(3);

        $product = $this->api_model->get_product($product_id);

        if(isset($product))
        {
            $deleted = $this->api_model->delete_product($product_id);

            if(!$deleted)
            {
                $this->response(array('status' => 'failure', 'message' => 'An unexpected error occured while trying to delete the product'), REST_CONTROLLER::HTTP_INTERNAL_SERVER_ERROR);
            }
            else
            {
                 $this->response(array('status' => 'success', 'message' => 'deleted'));
            }
        }
        else
        {
            $this->response(array('status' => 'failure', 'message' => 'The specified product could not be found'), REST_CONTROLLER::HTTP_NOT_FOUND);
        }

	}


    /**
     * Get User Products
     */
	function user_products_get() {
        $user_id = $this->_apiuser->id;

        $products = $this->api_model->get_user_products($user_id);


        if(!empty($products))
        {
            $this->response(array('status' => 'success', 'message' => $products));
        }
        else
        {
            $this->response(array('status' => 'failure', 'message' => 'No products could be found'), REST_CONTROLLER::HTTP_NOT_FOUND);
        }

	}

    /**
     * Add Product
     */
    function user_product_put() {

        $user_id = $this->_apiuser->id;

        $this->form_validation->set_data($this->put());

        if($this->form_validation->run('user_product_put') != false){

            $product = $this->put();

            $id = $this->api_model->insert_user_product($user_id, $product);

            if(!$id)
            {
                  $this->response(array('status' => 'failure', 'message' => 'An unexpected error occured while trying to add the product to the user'), REST_CONTROLLER::HTTP_INTERNAL_SERVER_ERROR);
            }
            else
            {
                $this->response(array('status' => 'success', 'message' => 'created'));
            }
        }
        else
        {
            $this->response(array('status' => 'failure', 'message' => $this->form_validation->get_errors_as_array()), REST_Controller::HTTP_BAD_REQUEST);
        }
    }


    /**
     * Delete Product
     */
    function user_product_delete() {

        $product_id = $this->uri->segment(3);
        $user_id = $this->_apiuser->id;

        $product = $this->api_model->get_user_product($user_id, $product_id);

        if(isset($product))
        {
            $deleted = $this->api_model->delete_user_product($user_id, $product_id);

            if(!$deleted)
            {
                $this->response(array('status' => 'failure', 'message' => 'An unexpected error occured while trying to delete the product'), REST_CONTROLLER::HTTP_INTERNAL_SERVER_ERROR);
            }
            else
            {
                 $this->response(array('status' => 'success', 'message' => 'deleted'));
            }
        }
        else
        {
            $this->response(array('status' => 'failure', 'message' => 'The specified product could not be found'), REST_CONTROLLER::HTTP_NOT_FOUND);
        }

	}
	
}