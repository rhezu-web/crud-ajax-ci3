<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Outlet extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Df_model', 'dfm');
        $this->load->library('form_validation');
    }


    public function index()
    {
        $data['title'] = "CRUD CI AJAX DF";
        $this->load->view('v_outlet', $data);
    }
    function getdata()
    {
        $dataOutlet = $this->dfm->getdata('toko')->result();
        // var_dump($dataOutlet);
        // die;
        echo json_encode($dataOutlet);
    }

    function get_outlet()
    {
        $data = $this->dfm->get_outlet()->result();
        echo json_encode($data);
    }
    function post_outlet()
    {
        $this->form_validation->set_rules('outlet', 'outlet', 'required');

        $outlet = $this->input->post('outlet', TRUE);
        $pack = $this->input->post('pack', TRUE);
        $item = $this->input->post('item', TRUE);

        if ($this->form_validation->run() != false) {
            $this->dfm->insert_outlet($outlet, $pack, $item);
        } else {
            echo 'gagagl';
        }
    }

    function delete()
    {
        $id = $this->input->post('id', TRUE);
        $this->dfm->delete_outlet($id);
    }

    function update_outlet()
    {
        $id = $this->input->post('id', TRUE);
        $outlet = $this->input->post('outlet', TRUE);
        $pack = $this->input->post('pack', TRUE);
        $item = $this->input->post('item', TRUE);
        // $id = 6;
        // $outlet = 'aa';
        // $pack = 12;
        // $item = 2;
        // var_dump($outlet, $pack, $item, $id);
        // die;
        $this->dfm->update_outlet($id, $outlet, $pack, $item);
    }
}
