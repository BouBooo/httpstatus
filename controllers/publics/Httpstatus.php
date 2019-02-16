<?php
namespace controllers\publics;

use \controllers\internals\Httpstatus as InternalHttpstatus;

class Httpstatus extends \Controller
{
    public function __construct (\PDO $pdo)
    {
        parent::__construct($pdo);
        $this->internal_httpstatus = new InternalHttpstatus($pdo);
    }


    public function login (int $id)
    {
        $id = $_GET['id'];
        
        if(!empty($_POST))
        {

            $email = $_POST['email'];
            $password = sha1($_POST['password']);
            $admin = $this->internal_httpstatus->log($id);

            if(!empty($email) && !empty($password))
            {
                if($email == $admin['email'] && $password = $admin['password'])
                {
                    return $this->render('httpstatus/admin');
                }
                else
                {
                    $_SESSION['log_error'] = 'Wrong password/email';
                    return $this->render('httpstatus/admin');
                }
            }
        }



    }
    public function home ()
    {
        $sites = $this->internal_httpstatus->getAllSites();
        
        return $this->render('httpstatus/home', [
            'sites' => $sites
        ]);
    }

    public function view (int $id)
    {
        $id = $id ?? false;
        $sites = $this->internal_httpstatus->getOneSite($id);
        return $this->render('httpstatus/view', [
            'sites' => $sites
        ]);
    }

    public function add ()
    {
        $_SESSION['add_error'] = "";
        if(!empty($_POST['add']))
        {
            $name = $_POST['name'];
            $url = $_POST['url'];

            if(!empty($name) && !empty($url))
            {
                $_SESSION['add_error'] = "";
                $sites = $this->internal_httpstatus->insertSite($name, $url);
                header('Location: ./');
            }
            else
            {
                var_dump($name, $url);
                $_SESSION['add_error'] = 'Thanks to complete all inputs';
                return $this->render('httpstatus/add');

            }
        }
        return $this->render('httpstatus/add');

    }


    public function admin ()
    {
        $sites = $this->internal_httpstatus->get_sites_admin();
        
        return $this->render('httpstatus/admin', [
            'sites' => $sites
        ]);
    }


    public function delete (int $id)
    {
            $id = $id ?? false;
            $deletion = $this->internal_httpstatus->delete_one_site($id);
            header('Location: ../admin');
    }



}