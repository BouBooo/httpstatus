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

    public function home ()
    {
        $sites = $this->internal_httpstatus->getAllSites();
        
        return $this->render('httpstatus/home', [
            'sites' => $sites
        ]);
    }
}