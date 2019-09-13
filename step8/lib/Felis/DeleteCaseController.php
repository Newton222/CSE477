<?php
/**
 * Created by PhpStorm.
 * User: newto
 * Date: 3/25/2018
 * Time: 9:00 PM
 */

namespace Felis;


class DeleteCaseController
{
    public function __construct(Site $site, array $post){
        $root = $site->getRoot();

        $this->redirect = "$root/cases.php";

        if(isset($post['yes'])){
            $caseId = strip_tags($post['caseId']);

            $cases = new Cases($site);

            $id = $cases->delete($caseId);
            if($id === false) {
                $this->redirect = "$root/cases.php?e";
            }
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