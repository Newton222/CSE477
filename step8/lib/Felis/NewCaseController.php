<?php
/**
 * Created by PhpStorm.
 * User: newto
 * Date: 3/24/2018
 * Time: 8:55 PM
 */

namespace Felis;


class NewCaseController
{
    public function __construct(Site $site, User $user, array $post){

        $root = $site->getRoot();
        if(!isset($post['ok'])) {
            $this->redirect = "$root/cases.php";
            return;
        }

        $cases = new Cases($site);
        $id = $cases->insert(strip_tags($post['client']),
            $user->getId(),
            strip_tags($post['number']));

        if($id === null) {
            $this->redirect = "$root/newcase.php?e";
        } else {
            $this->redirect = "$root/case.php?id=$id";
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