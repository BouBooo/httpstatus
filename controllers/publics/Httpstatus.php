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


    public function logIn ()
    {
        $username = $_POST['username'];
        $password = sha1($_POST['username']);
        $logs = $this->internal_httpstatus->log($username, $password);   
        return $this->render('httpstatus/connect', [
            'sites' => $logs
        ]);
    }
    public function home ()
    {
        $sites = $this->internal_httpstatus->getAllSites();
        
        return $this->render('httpstatus/home', [
            'sites' => $sites
        ]);
    }

    public function view ()
    {
        $id = $_GET['id'] ?? false;
        $site = $this->internal_httpstatus->getOneSite($id);
        return $this->render('httpstatus/view', [
            'id' => $id,
            'site' => $site
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

}