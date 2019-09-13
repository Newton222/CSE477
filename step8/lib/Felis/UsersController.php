<?php
/**
 * Created by PhpStorm.
 * User: newto
 * Date: 3/25/2018
 * Time: 10:54 PM
 */

namespace Felis;


class UsersController {
    public function __construct(Site $site, User $user, array $post) {
        $root = $site->getRoot();
        $this->redirect = "$root/users.php";

        if (isset($post['add'])){
            $this->redirect = "$root/user.php";
        }
        elseif (isset($post['edit']) && isset($post['userid'])){
            $userid = $post['userid'];
            $this->redirect = "$root/user.php?id=$userid";
        }
        elseif (isset($post['delete']) && isset($post['userid'])){
            $users = new Users($site);
            $users->delete($post['userid']);
        }
    }

    /**
     * @return mixed
     */
    public function getRedirect() {
        return $this->redirect;
    }


    private $redirect;	///< Page we will redirect the user to.
}