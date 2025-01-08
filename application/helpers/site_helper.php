<?php

/*
    function is_login()
    kegunaan => mengecek apakah user sudah login, jika sudah arahkan ke halaman utama
*/
function is_login()
{
    $ci = get_instance();

    // Jika user sudah login
    if ($ci->session->userdata('username')) {
        // Redirect sesuai role
        if ($ci->session->userdata('role_id') == 1) {
            redirect('dashboard-admin');
        } elseif ($ci->session->userdata('role_id') == 2) {
            redirect('dashboard-pelanggan');
        }
    }
}

/*
    function is_logout()
    kegunaan => untuk mengecek apakah user mempunyai session->username ? jika tidak ada, maka dia belum login. kembalikan ke halaman auth
*/
function is_logout()
{
    $ci = get_instance();
    if (!$ci->session->userdata('username')) {
        redirect('auth');
    }
}

/*
    function is_user()
    kegunaan => mengecek jika role_id dari user yang login bukan 1 (admin), maka tidak boleh mengakses hak-hak admin (cth. halaman data pegawai)
*/
function is_user()
{
    $ci = get_instance();

    // Jika belum login, arahkan ke auth
    if (!$ci->session->userdata('username')) {
        redirect('auth');
    }

    // Jika bukan role pelanggan (2), arahkan ke halaman notfound
    if ($ci->session->userdata('role_id') != 2) {
        redirect('notfound');
    }
}


/*
    function is_admin()
    kegunaan => mengecek jika role_id dari admin yang login bukan 1 (admin), maka tidak boleh mengakses hak-hak admin (cth. halaman data pegawai)
*/
function is_admin()
{
    $ci = get_instance();

    // Jika belum login, arahkan ke auth
    if (!$ci->session->userdata('username')) {
        redirect('auth');
    }

    // Jika bukan role admin (1), arahkan ke halaman notfound
    if ($ci->session->userdata('role_id') != 1) {
        redirect('notfound');
    }
}
