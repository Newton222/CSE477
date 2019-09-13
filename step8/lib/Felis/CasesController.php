<?php
/**
 * Created by PhpStorm.
 * User: newto
 * Date: 3/24/2018
 * Time: 8:55 PM
 */

namespace Felis;


class CasesController
{
    public function __construct(Site $site, array $post){
        $root = $site->getRoot();

        $this->redirect = "$root/cases.php";

        if(isset($post['add'])){
            $this->redirect = "$root/newcase.php";
        }

        if(isset($post['delete']) && isset($post['caseid'])){
            $caseid = $post['caseid'];
            $this->redirect = "$root/deletecase.php?id=$caseid";
        }

    }

    /**
     * @return mixed
     */
    public function getRedirect()
    {
        return $this->redirect;
    }

    /**
     * @param mixed $redirect
     */
    public function setRedirect($redirect)
    {
        $this->redirect = $redirect;
    }

    private $redirect;	///< Page we will redirect the user to.
}