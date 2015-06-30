<?php
defined('BASEPATH') OR exit('No direct script access allowed');


// Author Titus Tunduny
class Migrate extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *      http://example.com/index.php/welcome
     *  - or -
     *      http://example.com/index.php/welcome/index
     *  - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */


    /////**** Home Page Stuff *////
    function index()
    {
        $template='migrate/template';
        $data['title'] = 'Migrate Data Home ';
        $data['banner_text'] = 'Rapid Test Kit Migrate Data';
        $data['content_view'] = 'migrate/home_v';
        $data['location'] = 'You are on RTK-> Home';
        $data['active_link'] = 'home';      
        $this->load->view($template,$data);

    }


}
?>