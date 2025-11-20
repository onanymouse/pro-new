<?php

class CustomerController extends Controller
{
    protected $customerModel;

    public function __construct()
    {
        AuthMiddleware::handle();
        $this->customerModel = new Customer();
    }

    public function index()
    {
        if ($_SESSION['user']['role'] === 'kolektor') {
            $customers = $this->customerModel->getByCollector($_SESSION['user']['id']);
        } else {
            $customers = $this->customerModel->getAll();
        }
        $this->view('customers/index', ['customers' => $customers]);
    }

    public function create()
    {
        $this->view('customers/create');
    }

    public function store()
    {
        $data = [
            'name' => $_POST['name'] ?? '',
            'email' => $_POST['email'] ?? '',
            'phone' => $_POST['phone'] ?? '',
            'pppoe_username' => $_POST['pppoe_username'] ?? '',
            'pppoe_password' => $_POST['pppoe_password'] ?? '',
            'mikrotik_host' => $_POST['mikrotik_host'] ?? '',
            'mikrotik_user' => $_POST['mikrotik_user'] ?? '',
            'mikrotik_pass' => $_POST['mikrotik_pass'] ?? '',
            'created_by' => $_SESSION['user']['id']
        ];

        $newId = $this->customerModel->create($data);

        // Jika pilih integrasi Mikrotik, pakai RouterAPI
        if (!empty($data['mikrotik_host'])) {
            RouterAPI::addUserPPPoE($data['mikrotik_host'], $data['mikrotik_user'], $data['mikrotik_pass'], $data['pppoe_username'], $data['pppoe_password']);
        }

        header('Location: /customers');
        exit;
    }

    public function edit($id)
    {
        $customer = $this->customerModel->findById($id);
        $this->view('customers/edit', ['customer' => $customer]);
    }

    public function update($id)
    {
        $data = [
            'name' => $_POST['name'] ?? '',
            'email' => $_POST['email'] ?? '',
            'phone' => $_POST['phone'] ?? '',
            'pppoe_username' => $_POST['pppoe_username'] ?? '',
            'pppoe_password' => $_POST['pppoe_password'] ?? '',
            'mikrotik_host' => $_POST['mikrotik_host'] ?? '',
            'mikrotik_user' => $_POST['mikrotik_user'] ?? '',
            'mikrotik_pass' => $_POST['mikrotik_pass'] ?? '',
        ];

        $this->customerModel->update($id, $data);

        if (!empty($data['mikrotik_host'])) {
            RouterAPI::updateUserPPPoE($data['mikrotik_host'], $data['mikrotik_user'], $data['mikrotik_pass'], $data['pppoe_username'], $data['pppoe_password']);
        }

        header('Location: /customers');
        exit;
    }

    public function delete($id)
    {
        $customer = $this->customerModel->findById($id);

        if (!empty($customer['mikrotik_host'])) {
            RouterAPI::deleteUserPPPoE($customer['mikrotik_host'], $customer['mikrotik_user'], $customer['mikrotik_pass'], $customer['pppoe_username']);
        }

        $this->customerModel->delete($id);
        header('Location: /customers');
        exit;
    }
}