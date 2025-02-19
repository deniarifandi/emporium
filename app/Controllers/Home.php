<?php

namespace App\Controllers;

class Home extends BaseController
{
    private $db = null;

    function __construct(){
        date_default_timezone_set("Asia/Bangkok");
        $this->db = db_connect();
        $session = service('session');
    }

    public function testEsp(){
        $data = [
            'isi' => "isi",
          

        ];

        // Insert data into the table
        $builder = $this->db->table('esp');
        $builder->upsert($data);
        // if ($builder->upsert($data)) {

        // }
    }

    public function index(): string
    {
        return view('welcome_message');
        //return view('pembayaran');
        // return view('admin');
    }

    public function checked_in(){
        return view('checked_in');
        // $this->session_setter();
    }

    public function session_setter(){
        $_SESSION['check_in'] = "true";
        return redirect()->to(base_url("checkin_list"));
    }

    public function session_unsetter(){
         unset($_SESSION['check_in']);
         return redirect()->to(base_url("checkin_list"));
    }

    public function checkin_list(){
        $_SESSION['check_in'] = "true";
        $builder = $this->db->table('pendaftar')->where("flag_checkin IS NOT NULL",null, false);

        $query   = $builder->get();
     
        return view('checkin_list',['admin' => $query->getResult()]);

    }

    public function tiket(){

        $builder = $this->db
        ->table('pendaftar')
        ->where('ticket_no',$_GET['no']);

        $query   = $builder->get();
        // echo count($query->getResult());
        if (count($query->getResult()) > 0 ) {
            $no_tiket = $_GET['no'];


            if (isset($_SESSION['check_in'])) {
                $now = new \DateTime();

                $data = [
                    'flag_checkin' => $now->format('Y-m-d H:i:s'),
                ];

                $builder->where('ticket_no', $no_tiket);
                if (!$builder->update($data)) {
                    return view('tiket_notsent');
                } else {
                    return view('checked_in', ['result' => $query->getResult()]);
                }
            }else{
                return view('tiket',['tiket' => $no_tiket, 'result' => $query->getResult()]);
            }
            
        }else{
            return view('ticket_not_found');
        }
        // echo json_encode($query->getResult());

        
    }

    public function daftar(){
        $nama = $this->request->getPost('nama', FILTER_SANITIZE_STRING);
        $email = $this->request->getPost('email', FILTER_SANITIZE_EMAIL);
        $grade = $this->request->getPost('grade', FILTER_SANITIZE_EMAIL);
        //$hp = $this->request->getPost('hp', FILTER_SANITIZE_STRING);
        //$occupation = $this->request->getPost('occupation', FILTER_SANITIZE_STRING);

         $timestamp = time() % 100000; // Current timestamp in milliseconds
        $randomPart = rand(0, 99);  // 4-digit random number
        $no_tiket = "T-{$timestamp}{$randomPart}";

        // Prepare data array
        $data = [
            'email' => $email,
            'grade' => $grade,
            'nama' => $nama,
            'ticket_no' => $no_tiket

        ];

        // Insert data into the table
        $builder = $this->db->table('pendaftar');
        if ($builder->upsert($data)) {
            // Set success message in session
            $this->session->setFlashdata('result', 'sukses');
            
            // Attempt to send confirmation email
            if ($this->send_ticket($nama, $email,$no_tiket)) {
                return redirect()->to(base_url("daftar_sukses?nama=$nama&email=$email&no_tiket=$no_tiket"));
            } else {
                // Handle case where email could not be sent
                $this->session->setFlashdata('result', 'Email gagal dikirim. Silakan coba lagi.');
                //return redirect()->to(base_url("daftar_gagal"));
            }
        } else {
            // Set failure message in session
            $this->session->setFlashdata('result', 'gagal');
            return redirect()->to(base_url("daftar_gagal"));
        }

    }

    public function daftar_sukses(){
        $nama = $_GET['nama'];
        $email = $_GET['email'];
         return view('daftar_sukses',['nama'=> $nama, 'email'=>$email]);
    }

     public function daftar_gagal(){
        
         return view('daftar_gagal');
    }

    public function send_konfirmasi_pendaftaran($nama, $email){
        $email_smtp = \Config\Services::email();

        $config["protocol"] = "smtp";
        $config["SMTPHost"]  = "mail.sinarumi.co.id";
        $config["SMTPUser"]  = "mli_event@sinarumi.co.id";
        $config["SMTPPass"]  = "n@PnMwkB#k3@";
        $config["SMTPPort"]  = 465;
        $config["SMTPCrypto"] = "ssl";
        $config["mailType"]   = "html";
        
       // $config['smtp_port'] = 587;

        $email_smtp->initialize($config);

        $email_smtp->setFrom("mli_event@sinarumi.co.id");
        $email_smtp->setTo("$email");
        $email_smtp->setSubject("Registration Confirmation: Emporium Business Competition 2025");
        $email_smtp->setMessage("Kepada Yang Terhormat, $nama 

Terima kasih, kami telah menerima registrasi Anda.

Dibawah ini adalah link tiket masuk emporium business competition 2025

If you have any issues or questions regarding the registration process, you can contact the administrative WhatsApp at 62 813-3426-5504

Thank you!
Have a nice day!");

        if (!$email_smtp->send()) {
            // Print error details if email sending fails
            echo "Failed to send email. Error details:<br>";
            echo $email_smtp->printDebugger(['headers']);
        } else {
            return "sukses";
            
        }
    }

    public function admin(){

        $builder = $this->db->table('pendaftar');

        $query   = $builder->get();

        // echo json_encode($query->getResult());
        // return $query->getResult(); 
        return view('admin',['admin' => $query->getResult()]);
    }


    public function resend_ticket(){
       
         if (!$this->send_ticket($_GET['nama'],$_GET['email'],$_GET['no_tiket'])) {
                 return view('tiket_notsent');
            }else{
                 return view('tiket_sent');
            }
    }

    public function send_ticket($namanya, $emailnya, $no_tiket) {
    $email_smtp = \Config\Services::email();
    $builder = $this->db->table('pendaftar');

    // Secure SMTP Config
    $config = [
        "protocol"   => "smtp",
        "SMTPHost"   => "mail.sinarumi.co.id",
        "SMTPUser"   => "mli_event@sinarumi.co.id", // Use environment variable
        "SMTPPass"   => "n@PnMwkB#k3@", // Secure credentials
        "SMTPPort"   => 465, // Change to 587 for TLS
        "SMTPCrypto" => "ssl", // Change to "tls" if using port 587
        "mailType"   => "html", // Ensures HTML support
        "charset"    => "utf-8",
        "wordWrap"   => true
    ];

    $email_smtp->initialize($config);

    $nama = htmlspecialchars($namanya, ENT_QUOTES, 'UTF-8');
    $email = filter_var($emailnya, FILTER_VALIDATE_EMAIL);

    if (!$email) {
        log_message('error', "Invalid email address: $emailnya");
        return view('tiket_notsent');
    }

    $subject = "Registration Confirmation: Emporium Business Competition 2025";
    $message = "
    <p>Dear <strong>$nama</strong>,</p>
    <p>Thank you, we have received your registration.</p>
    <p>Below is your entrance ticket link to attend the Chinese New Year Celebration:</p>
    <p><a href='https://sinarumi.co.id/emporium/public/tiket?no=$no_tiket' target='_blank'>
       <strong>Click here for your ticket</strong></a></p>
    <p><em>Note:</em><br> 
    Kindly arrive 30 minutes before the event starts, as there will be re-registration.</p>
    <p>Thank you! See you soon.</p>";

    $email_smtp->setFrom("mli_event@sinarumi.co.id", "Emporium Business Competition");
    $email_smtp->setTo($email);
    $email_smtp->setSubject($subject);
    $email_smtp->setMessage($message);

    if (!$email_smtp->send()) {
        log_message('error', "Email failed to send to $email: " . $email_smtp->printDebugger(['headers']));
        return view('tiket_notsent');
    } else {
        // Update database flag
        $data = [
            'flag_tiket' => 1,
            'ticket_no'  => $no_tiket
        ];

        $builder->where('email', $email);
        if (!$builder->update($data)) {
            log_message('error', "Database update failed for email: $email");
            return view('tiket_notsent');
        }

        return view('tiket_sent');
    }
}


    public function send_ticket2($namanya, $emailnya,$no_tiket){
        $email_smtp = \Config\Services::email();
        $builder = $this->db->table('pendaftar');
        $config["protocol"] = "smtp";
        $config["SMTPHost"]  = "mail.sinarumi.co.id";
        $config["SMTPUser"]  = "mli_event@sinarumi.co.id";
        $config["SMTPPass"]  = "n@PnMwkB#k3@";
        $config["SMTPPort"]  = 465;
        $config["SMTPCrypto"] = "ssl";
       // $config['smtp_port'] = 587;

        $email_smtp->initialize($config);

       
       // return "T{$timestamp}{$randomPart}";

        $nama = $namanya;
        $email = $emailnya;

        $email_smtp->setFrom("mli_event@sinarumi.co.id");
        $email_smtp->setTo("$email");
        $email_smtp->setSubject("Registration Confirmation: Emporium Business Competition 2025");
        $email_smtp->setMessage("
Dear $nama,

Thank you, we have received your registration.
  
Below is your entrance ticket link to attend the Emporium Business Competition 2025

Please show your ticket during the re-registration process.  

https://sinarumi.co.id/emporium/public/tiket?no=$no_tiket

*Note*:  
Kindly arrive 30 minutes before the event starts, as there will be re-registration.

Thank you! See you soon.
            ");

        if (!$email_smtp->send()) {
            // Print error details if email sending fails
            echo "Failed to send email. Error details:<br>";
            echo $email_smtp->printDebugger(['headers']);
        } else {
            // echo "Email sent successfully!";

            $data = [
                'flag_tiket' => 1,
                'ticket_no' => $no_tiket
            ];

            $builder->where('email', $email);
            if (!$builder->update($data)) {
                 return view('tiket_notsent');
            }else{
                 return view('tiket_sent');
            }
            
        }
    }

    public function tiket_sent(){
        return view('tiket_sent');
    }

    public function tiket_notsent(){
        return view('tiket_notsent');
    }
}
