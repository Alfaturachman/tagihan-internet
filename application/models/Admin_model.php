<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    public function getData()
    {
        return $this->db->get_where('pengaduan', ['instansi_id' => $this->user['id']])->result_array();
    }

    public function getPelanggan()
    {
        $this->db->select('u.id, u.nama_instansi, u.email, u.alamat, u.username, ur.role')
            ->from('user u')
            ->join('user_role ur', 'u.role_id = ur.id')
            ->where('u.role_id', 2);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return []; // Jika tidak ada data
        }
    }

    public function getPenggunaById($id)
    {
        return $this->db->get_where('user', ['id' => $id])->row_array();
    }

    public function updatePengguna($id)
    {
        $data = [
            'nama_instansi' => $this->input->post('nama_instansi'),
            'email' => $this->input->post('email'),
            'alamat' => $this->input->post('alamat'),
            'username' => $this->input->post('username')
        ];

        // Jika password diisi, maka update password
        if (!empty($this->input->post('pass1'))) {
            $data['password'] = password_hash($this->input->post('pass1'), PASSWORD_DEFAULT);
        }

        $this->db->where('id', $id);
        $this->db->update('user', $data);
    }

    public function tambah_pengguna()
    {
        $data = [
            'nama_instansi' => $this->input->post('nama_instansi'),
            'email' => $this->input->post('email'),
            'alamat' => $this->input->post('alamat'),
            'username' => $this->input->post('username'),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'role_id' => 2
        ];

        $this->db->insert('user', $data);
    }

    public function ubah_data()
    {
        $id = $this->input->post('id');
        $judul = $this->input->post('judul_pengaduan', true);
        $isi = $this->input->post('isi_pengaduan', true);

        $this->db->set('judul_pengaduan', $judul);
        $this->db->set('isi_pengaduan', $isi);

        $this->db->where('id', $id);
        $query = $this->db->update('pengaduan');

        if ($this->db->affected_rows($query) > 0) {
            $this->session->set_flashdata('msg', 'diupdate.');
            redirect('daftar-pengaduan');
        } else {
            $this->session->set_flashdata('err', 'diupdate.');
            redirect('daftar-pengaduan');
        }
    }

    public function tambah_data()
    {
        $data = [
            'instansi_id' => $this->user['id'],
            'tgl_pengaduan' => date('Y-m-d'),
            'judul_pengaduan' => htmlspecialchars($this->input->post('judul_pengaduan', true)),
            'isi_pengaduan' => htmlspecialchars($this->input->post('isi_pengaduan', true))
        ];

        $this->db->insert('pengaduan', $data);
        $this->session->set_flashdata('msg', 'submit.');
    }

    public function ubah_password()
    {
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $upass = $data['user']['password'];
        $pass = $this->input->post('password');
        $newpass = $this->input->post('newpass');

        // jika password yang di verify tidak sama dengan password user dari db
        if (!password_verify($pass, $upass)) {
            $this->session->set_flashdata('msg', 'Password Lama Salah!');
            redirect('ubah-password');
        } else {
            // jika input password lama sama dengan input password baru
            if ($newpass == $pass) {
                $this->session->set_flashdata('msg', 'Password baru tidak boleh sama dengan password lama.');
                redirect('ubah-password');
            } else {
                // jika tidak sama dengan password baru
                $pass_hash = password_hash($newpass, PASSWORD_DEFAULT);

                $this->db->set('password', $pass_hash);
                $this->db->where('username', $this->session->userdata('username'));
                $this->db->update('user');

                $this->session->set_flashdata('ubahpass', '<div class="alert alert-success">Password berhasil diubah.</div>');
                redirect('ubah-password');
            }
        }
    }
}
