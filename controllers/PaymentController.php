<?php
class PaymentController
{
    private $db;
    private $paymentModel;
    private $rentalModel; // Add this line

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->paymentModel = new Payment($this->db);
        $this->rentalModel = new Rental($this->db); // Initialize the rental model
    }

    public function createPayment()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->paymentModel->user_id = $_SESSION['user_id'];
            $this->paymentModel->rental_id = $_POST['rental_id'];
            $this->paymentModel->amount = $_POST['amount'];
            $this->paymentModel->payment_method = $_POST['payment_method'];
            $this->paymentModel->payment_date = date('Y-m-d H:i:s');

            if ($this->paymentModel->create()) {
                header('Location: ' . BASE_URL . '/index.php?controller=payment&action=viewReceipt&payment_id=' . $this->db->lastInsertId());
                exit;
            } else {
                echo "Unable to process payment.";
            }
        } else {
            $rental_id = $_GET['rental_id'];
            loadView('payment/create', ['rental_id' => $rental_id]);
        }
    }

    public function payAllRentals()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user_id = $_SESSION['user_id'];
            $rental_ids = $_POST['rental_ids'];
            $total_fee = 0;
            $payment_method = $_POST['payment_method'];
            $payment_date = date('Y-m-d H:i:s');

            foreach ($rental_ids as $rental_id) {
                $rental = $this->rentalModel->readOne($rental_id);
                $total_fee += $rental['fee'];
            }

            $this->paymentModel->user_id = $user_id;
            $this->paymentModel->rental_id = implode(",", $rental_ids); // Store rental IDs as comma-separated string
            $this->paymentModel->amount = $total_fee;
            $this->paymentModel->payment_method = $payment_method;
            $this->paymentModel->payment_date = $payment_date;

            if ($this->paymentModel->create()) {
                header('Location: ' . BASE_URL . '/index.php?controller=payment&action=viewReceipt&payment_id=' . $this->db->lastInsertId());
                exit;
            } else {
                echo "Unable to process payment.";
            }
        }
    }

    public function viewReceipt()
    {
        $payment_id = $_GET['payment_id'];
        $payment = $this->paymentModel->readOne($payment_id);
        loadView('payment/receipt', ['payment' => $payment]);
    }

    public function viewPayments()
    {
        $payments = $this->paymentModel->readByUser($_SESSION['user_id']);
        loadView('payment/view', ['payments' => $payments]);
    }
}
?>
