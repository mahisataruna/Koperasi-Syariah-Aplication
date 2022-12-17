<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dom_pdf extends CI_Controller {

    //Construct hak akses berdasarkan role id 
    public function __construct()
    {
        parent:: __construct();
        if(!$this->session->userdata('email')){
            redirect('auth');
        }
        $this->load->database();    
        $this->load->helper(array('url','form'));
    }
    
    //Cetak Laporan dari menu data anggota
    public function index()
    {
        $data['title'] = 'Cetak Laporan Data Anggota';
        //Ambil data user anggota 
        $data['data'] = $this->db->get_where('user', array('role_id' => '2'))->result();
        //ambil library dompdf
        $this->load->library('koperasipdf');
        $this->koperasipdf->generate('admin/laporan_pdf', $data);

    }

    //controller dari menu cetak laporan
    public function cetak_laporan()
    {
        $data['user'] = $this->db->get_where('user', ['email' =>
            $this->session->userdata('email')])->row_array();

        if ($_POST['jenis_laporan']=='data_anggota') 
        {
            $data['title'] = 'Cetak Laporan Data Anggota';
            //Ambil data user anggota 
            $data['data'] = $this->db->get_where('user', array('role_id' => '2'))->result();
            //ambil library dompdf
            $this->load->library('koperasipdf');
            $this->koperasipdf->generate('laporan/cetak_anggota', $data);

        } 

        elseif ($_POST['jenis_laporan']=='data_simpanan_pokok')
        {
            $data['title'] = 'Cetak Laporan Simpanan Pokok Anggota';

            $this->load->model('Transaksi_m', 'simpanan_pokok');
            $data['simpanPokok'] = $this->simpanan_pokok->getCetakSimpananPokok();

            $this->load->library('koperasipdf');
            $this->koperasipdf->generate('laporan/cetak_simpanan_pokok', $data);

        }    

        elseif ($_POST['jenis_laporan']=='data_simpanan_wajib') 
        {
            $data['title'] = 'Cetak Laporan Simpanan Wajib Anggota';

            $this->load->model('Transaksi_m', 'simpanan_wajib');
            $data['simpanWajib'] = $this->simpanan_wajib->getCetakSimpananWajib();

            $this->load->library('koperasipdf');
            $this->koperasipdf->generate('laporan/cetak_simpanan_wajib', $data);
        }
        
        elseif ($_POST['jenis_laporan']=='data_simpanan') 
        {
            $data['title'] = 'Cetak Laporan Simpanan';

            $this->load->model('Transaksi_m', 'simpan');
            $data['simpanAnggota'] = $this->simpan->getSimpananAnggota();

            $this->load->library('koperasipdf');
            $this->koperasipdf->generate('laporan/cetak_simpanan', $data);
        } 
        elseif ($_POST['jenis_laporan']=='data_pinjaman') {
            $data['title'] = 'Cetak Laporan Pinjaman';

            $data['pinjam'] = $this->db->get('tb_pinjaman')->result_array();
            $this->load->library('koperasipdf');
            $this->koperasipdf->generate('laporan/cetak_pinjaman', $data);
        } 
        elseif ($_POST['jenis_laporan']=='angsuran') {
            $data['title'] = 'Cetak Laporan Angsuran';

            $data['angsuran'] = $this->db->get('tb_angsuran')->result_array();

            $this->load->library('koperasipdf');
            $this->koperasipdf->generate('laporan/cetak_angsuran', $data);
        } 
        elseif ($_POST['jenis_laporan']=='infaq') {
            $data['title'] = 'Cetak Laporan Infaq';

            $this->load->model('Transaksi_m', 'infaq');
            $data['infaqAnggota'] = $this->infaq->getInfaqAnggota();

            $this->load->library('koperasipdf');
            $this->koperasipdf->generate('laporan/cetak_infaq', $data);
        } 
        elseif ($_POST['jenis_laporan']=='bghasil') {
            $data['title'] = 'Cetak Laporan Infaq';

            $this->load->model('Transaksi_m', 'bhu');
            $data['bhuAnggota'] = $this->bhu->getBhuAnggota();

            $this->load->library('koperasipdf');
            $this->koperasipdf->generate('laporan/cetak_laporan_bagi_hasil', $data);
        }    
    }

    //cetak laporan rincian masing-masing transaksi
    public function cetak_rincian($id=null)
    {
        $data['user'] = $this->db->get_where('user', ['email' =>
            $this->session->userdata('email')])->row_array();

        if ($_POST['jenis_laporan']=='data_simpanan') 
        {
            $data['title'] = 'Rincian Simpanan';
            
            $this->load->model('Transaksi_m', 'faktur_simpan');
            $data['bukuSimpanAnggota'] = $this->faktur_simpan->getBukuSimpananAnggota($data['user']['id']); 
            $this->load->library('koperasipdf');
            $this->koperasipdf->generate('anggota_transaksi/faktur/fa_simpan', $data);

        } elseif ($_POST['jenis_laporan']=='data_pinjaman') {
            
            $data['title'] = 'Rincian Pinjaman';
            
            $this->load->model('Transaksi_m', 'faktur_pinjam');
            $data['bukuPinjamAnggota'] = $this->faktur_pinjam->getAllPinjamAnggota($data['user']['id']); 
            $this->load->library('koperasipdf');
            $this->koperasipdf->generate('anggota_transaksi/faktur/fa_pinjam', $data);

        } elseif ($_POST['jenis_laporan']=='semua') {
            
            $data['title'] = 'Transaksi';
            
            $this->load->model('Transaksi_m', 'all_transaksi');
            $data['bukuTransaksi'] = $this->all_transaksi->getAllTransaksi($data['user']['id']);
            $this->load->library('koperasipdf');
            $this->koperasipdf->generate('anggota_transaksi/faktur/fa_all_transaksi', $data); 

        } elseif ($_POST['jenis_laporan']=='infaq') {

            $data['title'] = 'Rincian Infaq';

            $this->load->model('Transaksi_m', 'infaq_transaksi');
            $data['bukuInfaqAnggota'] = $this->infaq_transaksi->getBukuInfaqAnggota($data['user']['id']);
            $this->load->library('koperasipdf');
            $this->koperasipdf->generate('anggota_transaksi/faktur/fa_infaq', $data);
            
        } elseif ($_POST['jenis_laporan']=='angsuran') {

            $data['title'] = 'Rincian Angsuran';
            
            $this->load->model('Transaksi_m', 'all_transaksi');
            $data['bukuAngsurAnggota'] = $this->all_transaksi->getBukuAngsuranAnggota($data['user']['id']);
            $this->load->library('koperasipdf');
            $this->koperasipdf->generate('anggota_transaksi/faktur/fa_angsur', $data);

        } elseif ($_POST['jenis_laporan']== 'bghasil') {
            
            $data['title'] = 'Rincian Bagi Hasil Usaha';
            
            $this->load->model('Transaksi_m', 'all_transaksi');
            $data['bukuTransaksi'] = $this->all_transaksi->getAllTransaksi($data['user']['id']);
            $this->load->library('koperasipdf');
            $this->koperasipdf->generate('anggota_transaksi/faktur/fa_all_transaksi', $data);            
        }
    }

    public function cetak_anggota()
    {
        $data['title'] = 'Cetak Laporan Data Anggota';
        //Ambil data user anggota 
        $data['data'] = $this->db->get_where('user', array('role_id' => '2'))->result();
        //ambil library dompdf
        $this->load->library('koperasipdf');
        $this->koperasipdf->generate('laporan/cetak_anggota', $data);
    }

    public function cetak_simpanan()
    {
        $data['title'] = 'Cetak Laporan Simpanan';

        $this->load->model('Transaksi_m', 'simpan');
        $data['simpanAnggota'] = $this->simpan->getSimpananAnggota();

        $this->load->library('koperasipdf');
        $this->koperasipdf->generate('laporan/cetak_simpanan', $data);

    }

    //cetak fatur masing-masing simpanan anggota
    public function cetakfaktur_sp($id_simpanan=null)
    {
        
        $data['title'] = 'Cetak Faktur Simpanan Anggota';
        $this->load->model('Transaksi_m', 'Faktur');
        $data['fakturSimpanan'] = $this->Faktur->getFakturSimpanan($id_simpanan);
        $this->load->model('Transaksi_m', 'dataAgt');
        $data['loadAnggota'] = $this->dataAgt->getDataAgtSimpanan($id_simpanan);

        $this->load->library('koperasipdf');
        $this->koperasipdf->generate('laporan/cetak_faktursimpanan', $data);
    }

    public function cetak_pinjaman()
    {
        $data['title'] = 'Cetak Laporan Simpanan';
        
        $data['pinjam'] = $this->db->get('tb_pinjaman')->result_array();
        $this->load->library('koperasipdf');
        $this->koperasipdf->generate('laporan/cetak_pinjaman', $data);

    }

    public function cetakfaktur_pj($id_pinjaman=null)
    {
        $data['title'] = 'Cetak Faktur Pinjaman Anggota';
        $this->load->model('Transaksi_m', 'FakturPinjam');
        $data['fakturPinjam'] = $this->FakturPinjam->getFakturPinjam($id_pinjaman);
        $this->load->model('Transaksi_m', 'dataPjAgt');
        $data['loadAgtPinjam'] = $this->dataPjAgt->getDataAgtPinjaman($id_pinjaman);

        $this->load->library('koperasipdf');
        $this->koperasipdf->generate('laporan/cetak_fakturpinjam', $data);
    }

    public function cetak_infaq()
    {
        $data['title'] = 'Cetak Laporan Infaq';

        $this->load->model('Transaksi_m', 'infaq');
        $data['infaqAnggota'] = $this->infaq->getInfaqAnggota();

        $this->load->library('koperasipdf');
        $this->koperasipdf->generate('laporan/cetak_infaq', $data);
    }
    //Faktur Infaq Masing-masing anggota
    public function cetakfaktur_in($id_infaq=null)
    {
        $data['title'] = 'Cetak Faktur Infaq Anggota';
        $this->load->model('Transaksi_m', 'FakturInfaq');
        $data['fakturInfaq'] = $this->FakturInfaq->getFakturInfaq($id_infaq);

        $this->load->model('Transaksi_m', 'dataInAgt');
        $data['loadAgtInfaq'] = $this->dataInAgt->getDataAgtInfaq($id_infaq);

        $this->load->library('koperasipdf');
        $this->koperasipdf->generate('laporan/cetak_fakturinfaq', $data);
    }

    public function cetak_angsuran()
    {
        $data['title'] = 'Cetak Laporan Angsuran';

        $data['angsuran'] = $this->db->get('tb_angsuran')->result_array();

        $this->load->library('koperasipdf');
        $this->koperasipdf->generate('laporan/cetak_angsuran', $data);
    }
    //Cetak faktur angsuran masing-masing anggota
    public function cetakfaktur_ang($id_angsuran=null)
    {
        $data['title'] = 'Cetak Faktur Angsuran Anggota';
        $this->load->model('Transaksi_m', 'FakturAngsuran');
        $data['fakturAng'] = $this->FakturAngsuran->getFakturAngsuranAgt($id_angsuran);

        $this->load->model('Transaksi_m', 'dataAngAgt');
        $data['loadAgtAngsur'] = $this->dataAngAgt->getDataAgtAngsur($id_angsuran);

        $this->load->library('koperasipdf');
        $this->koperasipdf->generate('laporan/cetak_fakturangsuran', $data);
    }


    public function cetak_bagi_hasil()
    {
        $data['title'] = 'Cetak Laporan Bagi Hasil';

        $this->load->model('Transaksi_m', 'bhu');
        $data['bhuAnggota'] = $this->bhu->getBhuAnggota();

        $this->load->library('koperasipdf');
        $this->koperasipdf->generate('laporan/cetak_laporan_bagi_hasil', $data);
    }

    public function cetakfaktur_bhu($id_bhu=null)
    {
        $data['title'] = 'Cetak Faktur Bagi Hasil Anggota';
        $this->load->model('Transaksi_m', 'FakturBgHasil');
        $data['fakturBhu'] = $this->FakturBgHasil->getFakturBhu($id_bhu);

        $this->load->model('Transaksi_m', 'dataBhuAgt');
        $data['loadAgtBhu'] = $this->dataBhuAgt->getDataAgtBhu($id_bhu);

        $this->load->library('koperasipdf');
        $this->koperasipdf->generate('laporan/cetak_fakturbhu', $data);
    }
    //End

    //Invoice
    public function invoice_simpan($id_simpanan=null)
    {
        $data['title'] = 'Cetak Laporan Simpanan';
        $data['user'] = $this->db->get_where('user', ['email' =>
            $this->session->userdata('email')])->row_array();


        $this->load->model('Transaksi_m', 'faktur_simpan');
        $data['bukuSimpanAnggota'] = $this->faktur_simpan->getBukuSimpananAnggota($data['user']['id']); //Masih belum bisa

        $this->load->library('koperasipdf');
        $this->koperasipdf->generate('anggota_transaksi/faktur/fa_simpan', $data);
    }

    //Invoice pinjaman
    public function invoice_pinjam()
    {
        
    }
    public function invoice_angsur()
    {
        
    }
    public function invoice_infaq()
    {
        
    }
    public function invoice_saldo()
    {
        
    }
    //end
}