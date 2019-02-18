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


    public function login ()
    {
        $_SESSION['log_error'] = "";
        $email = $_POST['email'] ?? false;
        $password = sha1($_POST['password']) ?? false;

        if(!$email || !$password)
        {
            return $this->render('httpstatus/connexion');
        }
        else
        {
            $admin = $this->internal_httpstatus->log($email, $password);
            if($admin)
            {
                session_start();
                $_SESSION['id'] = $admin['id'];
                header('Location: ./admin');
            }
            else
            {
                $_SESSION['log_error'] = "Get admin error";
                return $this->render('httpstatus/connexion');
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
        $sites = $this->internal_httpstatus->getOneSite($id);
        return $this->render('httpstatus/view', [
            'site' => $sites
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
                $_SESSION['add_error'] = '<span class="alert alert-danger">Thanks to complete all inputs</span>';
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