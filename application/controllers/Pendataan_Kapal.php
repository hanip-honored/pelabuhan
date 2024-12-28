<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendataan_Kapal extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('id_user')) {
            redirect('login');
        }
        $this->load->model('Kapal_model');
    }
    public function index() {
        $keyword = $this->input->get('keyword');
        
        $data['ships'] = $this->Kapal_model->getDataKapal($keyword);
        $data['keyword'] = $keyword;
        
        $this->load->view('pendataan_kapal/index', $data);
    }

    public function tambah_aksi() {
        $last_id = $this->Kapal_model->getKapalId();

        $data = [
            'id_kapal' => 'K' . sprintf("%04s", $last_id + 1),
            'nama_kapal' => $this->input->post('nama_kapal'),
            'jenis_kapal' => $this->input->post('jenis_kapal'),
            'gambar_kapal' => $this->uploadGambar(),
            'ukuran_kapal' => $this->input->post('ukuran_kapal'),
            'kapasitas_muatan' => $this->input->post('kapasitas_muatan'),
            'status_kapal' => $this->input->post('status_kapal'),
        ];

        if ($this->Kapal_model->insertKapal($data)) {
            $this->session->set_flashdata('success', 'Data berhasil ditambahkan.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menambahkan data.');
        }
        redirect('pendataan_kapal');
    }

    public function tambah() {
        $this->load->view('pendataan_kapal/tambah');
    }

    public function edit($id) {
        $data['kapal'] = $this->Kapal_model->getKapalById($id);
        if (!$data['kapal']) {
            show_404();
        }
        $this->load->view('pendataan_kapal/edit', $data);
    }

    public function edit_aksi() {
        $id = $this->input->post('id_kapal');
        $old_image = $this->input->post('old_gambar_kapal');
        $new_image = $this->uploadGambar();
    
        // Jika ada gambar baru yang diunggah, hapus gambar lama
        if ($new_image && $old_image && file_exists('./assets/images/ships/' . $old_image)) {
            unlink('./assets/images/ships/' . $old_image);
        }
    
        $data = [
            'nama_kapal' => $this->input->post('nama_kapal'),
            'jenis_kapal' => $this->input->post('jenis_kapal'),
            'gambar_kapal' => $new_image ?: $old_image,
            'ukuran_kapal' => $this->input->post('ukuran_kapal'),
            'kapasitas_muatan' => $this->input->post('kapasitas_muatan'),
            'status_kapal' => $this->input->post('status_kapal')
        ];
    
        if ($this->Kapal_model->updateKapal($id, $data)) {
            $this->session->set_flashdata('success', 'Data berhasil diperbarui.');
        } else {
            $this->session->set_flashdata('error', 'Gagal memperbarui data.');
        }
        redirect('pendataan_kapal');
    }
    
    public function hapus($id) {
        if ($this->Kapal_model->deleteKapal($id)) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus data.');
        }
        redirect('pendataan_kapal');
    }

    private function uploadGambar() {
        $config['upload_path'] = './assets/images/ships/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = 2048;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('gambar_kapal')) {
            return $this->upload->data('file_name');
        }

        return null;
    }
}
