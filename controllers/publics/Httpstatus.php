<?php
namespace controllers\publics;

use \controllers\internals\Httpstatus as InternalHttpstatus;
use \ApiController as ApiController;
use \Model as Model;

class Httpstatus extends \Controller
{
    public function __construct (\PDO $pdo)
    {
        parent::__construct($pdo);
        $this->internal_httpstatus = new InternalHttpstatus($pdo);
        $this->api_controller = new ApiController($pdo);
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
                $_SESSION['admin'] = $admin;
                header('Location: ./admin');
            }
            else
            {
                $_SESSION['log_error'] = '<span class="alert alert-danger">Wrong email / password </span>';
                return $this->render('httpstatus/connexion');
            }
        }

    }


    public function logout ()
    {
        if(!empty($_SESSION['admin']))
        {
            session_destroy();
            header('Location: ./');

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
        $history = $this->internal_httpstatus->getHistory($id);
        $site = $this->internal_httpstatus->getOneSite($id);
        $query = $this->internal_httpstatus->newQuery();
        $status = [];


            if($site['id'] == $id)
            {
                // Show 30 last status for the site
                $history = $query->prepare('SELECT * FROM sites JOIN status ON sites.id = status.site_id WHERE status.site_id = ? ORDER BY status.id DESC LIMIT 30');
                $history->execute(array($site['id']));
                $status = [];

                foreach ($history as $key => $historic) {
                    $infos = [
                        'code' => $historic['code'],
                        'at' => $historic['date_report']
                ];
                    array_push($status, $infos);
                }

                return $this->render('httpstatus/view', [
                    'status' => $status
                ]);
            }
            else
            {
                return $this->api_controller->json(array(
                    'success' => false,
                    'error' => 'Invalid id',
                ));
            }
            /*return $this->render('httpstatus/view', [
            'site' => $sites,
            'status' => $status
        ]);*/
    }

    public function add ()
    {
        if(empty($_SESSION['admin']))
        {
            header('Location: ./');
        }
        else
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
                    header('Location: ./admin');
                }
                else
                {
                    $_SESSION['add_error'] = '<span class="alert alert-danger">Thanks to complete all inputs</span>';
                    return $this->render('httpstatus/add');

                }
            }
            return $this->render('httpstatus/add');
        }

    }


    public function admin ()
    {
        if(!empty($_SESSION['admin']))
        {
            session_start();
            $sites = $this->internal_httpstatus->get_sites_admin();
            
            return $this->render('httpstatus/admin', [
                'sites' => $sites
            ]);
        }
        else
        {
            header('Location: ./');
        }

    }


    public function delete (int $id)
    {
        if(empty($_SESSION['admin']))
        {
            header('Location: ../');
        }
        else
        {
            $id = $id ?? false;
            $deletion = $this->internal_httpstatus->delete_one_site($id);
            header('Location: ../admin');
        }
    }

    public function update (int $id)
    {
        if(empty($_SESSION['admin']))
        {
            header('Location: ../');
        }
        else
        {
            $getSite = $this->internal_httpstatus->getOneSite($id);
            $name = $getSite['name'];  
            $url = $getSite['url'];  
            $_SESSION['update_error'] = "";

            if(!empty($_POST['update']))
            {
                if(!empty($_POST['url']) && !empty($_POST['name']))
                {
                    if($url != $_POST['url'] || $name != $_POST['name'])
                    {
                        $name = $_POST['name'];
                        $url = $_POST['url'];
                        $update = $this->internal_httpstatus->update_one_site($id, $name, $url);
                        header('Location: ../../httpstatus/admin');  
                    }
                    else
                    {
                        $_SESSION['update_error'] = '<span class="alert alert-danger">Aucun changement detecté</span>';
                        return $this->render('httpstatus/update', [
                            'id' => $id,
                            'url' => $url,
                            'name' => $name
                        ]);

                    }

                }
                else
                {
                    $_SESSION['update_error'] = '<span class="alert alert-danger">Please complete all inputs</span>';
                    return $this->render('httpstatus/update', [
                        'id' => $id,
                        'url' => $url,
                        'name' => $name
                    ]);
                }
            }
            else 
            {
                return $this->render('httpstatus/update', [
                    'id' => $id,
                    'url' => $url,
                    'name' => $name
                ]);
            }
        }


    }



    public function getStatus()
    {
        /**/$sites = $this->internal_httpstatus->sitesStatus();
            echo 'site checked';
            /*foreach ($sites as $site_status)
            {
                    $url = $site_status['url'];
                    $ch = curl_init($url);
                    curl_setopt($ch, CURLOPT_HEADER, true);   
                    curl_setopt($ch, CURLOPT_NOBODY, true);    
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
                    curl_setopt($ch, CURLOPT_TIMEOUT,10);
                    $output = curl_exec($ch);
                    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                    curl_close($ch);
                    $_SESSION['status_'.$url] = $httpcode;
                    $query = $pdo->prepare('INSERT INTO status (site_id, code, date_report) VALUES(?,?, NOW())');
                    $query->execute(array($site_status['id'], $httpcode));
            }*/

        
    }


}