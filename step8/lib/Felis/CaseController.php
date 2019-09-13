<?php
/**
 * Created by PhpStorm.
 * User: newto
 * Date: 3/25/2018
 * Time: 6:31 PM
 */

namespace Felis;


class CaseController
{
    public function __construct(Site $site, array $post){
        $root = $site->getRoot();

        $caseId = $post['caseId'];
        $this->redirect = "$root/cases.php?id=$caseId";

        $newCaseNumber = strip_tags($post['number']);
        $newSummary = strip_tags($post['summary']);
        $newAgent = strip_tags($post['agent']);
        $newStatus = strip_tags($post['status']);
        $newNote = strip_tags($post['note']);

        $cases = new Cases($site);
        $a = array('id'=>$caseId,
            'number'=>$newCaseNumber,
            'agent'=>$newAgent,
            'summary'=>$newSummary,
            'status'=>$newStatus);
        $id = $cases->update($a);

        if($id === false) {
            $this->redirect = "$root/case.php?id=$caseId?e";
        } else {
            $this->redirect = "$root/case.php?id=$caseId";
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