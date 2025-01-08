<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function index()
    {
        // jalankan site_helper > is_login untuk mengecek apakah user sudah login
        is_login();

        // validasi username dan password
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('pass', 'Password', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['judul'] =  'Halaman Login';
            $this->load->view('auth/index', $data);
        } else {
            // jika lolos validasi, proses..
            $this->_login();
        }
    }

    public function _login()
    {
        $username = htmlspecialchars($this->input->post('username', true));
        $password = $this->input->post('pass', true);

        // get user data
        $user = $this->db->get_where('user', ['username' => $username])->row_array();

        // jika ada username yang di input oleh user
        if ($user) {
            // cek password, jika password yang diinput user sama dengan yang ada di database
            if (password_verify($password, $user['password'])) {
                // siapkan user data
                $data = [
                    'user_id' => $user['id'],
                    'username' => $user['username'],
                    'role_id' => $user['role_id']
                ];

                // set userdata
                $this->session->set_userdata($data);

                // redirect (bisa juga redirect menurut role)
                $this->session->set_flashdata('message',  $data['username']);
                if ($user['role_id'] == 1) {
                    redirect('dashboard-admin');
                } else {
                    redirect('dashboard-pelanggan');
                }
            } else {
                // Jika password salah
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Username / Password salah!</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Akun tidak terdaftar!</div>');
            redirect('auth');
        }
    }

    public function register()
    {
        $this->form_validation->set_rules('nama_instansi', 'Nama Instansi', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'Email ini sudah terdaftar!'
        ]);
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]', [
            'is_unique' => 'Username ini sudah terdaftar!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]', [
            'matches' => 'Password tidak cocok!',
            'min_length' => 'Password minimal 6 karakter!'
        ]);
        $this->form_validation->set_rules('password2', 'Konfirmasi Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['judul'] = 'Halaman Register';
            $this->load->view('auth/register', $data);
        } else {
            $data = [
                'nama_instansi' => htmlspecialchars($this->input->post('nama_instansi', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'alamat' => htmlspecialchars($this->input->post('alamat', true)),
                'username' => htmlspecialchars($this->input->post('username', true)),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 1
            ];

            $this->db->insert('user', $data);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Akun berhasil dibuat! Silahkan login.</div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        // unset session userdata
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda berhasil keluar!</div>');
        redirect('auth');
    }

    public function notfound()
    {
        $data['judul'] = 'Page Not Found';
        $this->load->view('auth/error_404', $data);
    }
}
