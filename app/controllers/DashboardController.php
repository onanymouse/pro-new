<?php

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil data sesuai role user jika diperlukan
        $data = [];

        if ($_SESSION['user']['role'] === 'superadmin') {
            // Contoh ambil total pelanggan, router, invoice
            $data['total_customers'] = (new Customer())->countAll();
            $data['total_routers'] = (new Router())->countAll();
            $data['total_invoices'] = (new Invoice())->countAll();
        } elseif ($_SESSION['user']['role'] === 'admin') {
            $data['total_customers'] = (new Customer())->countAll();
            $data['total_invoices'] = (new Invoice())->countAll();
        } elseif ($_SESSION['user']['role'] === 'teknisi') {
            $data['routers_online'] = (new Router())->countOnline();
        } elseif ($_SESSION['user']['role'] === 'kolektor') {
            $data['my_customers'] = (new Customer())->countByCollector($_SESSION['user']['id']);
        }

        $this->view('dashboard/index', $data);
    }
}