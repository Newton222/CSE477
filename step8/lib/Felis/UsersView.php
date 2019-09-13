<?php
/**
 * Created by PhpStorm.
 * User: newto
 * Date: 3/25/2018
 * Time: 10:41 PM
 */

namespace Felis;


class UsersView extends View
{
    /**
     * Constructor
     * Sets the page title and any other settings.
     */
    public function __construct(Site $site) {
        $this->setTitle("Felis Investigations Users");
        $this->addLink("staff.php", "Staff");
        $this->addLink("post/logout.php", "Log out");
        $this->site = $site;
    }

    public function present() {
        $html = <<<HTML
<form method="post" action="post/users.php" class="table">
	<p>
	<input type="submit" name="add" id="add" value="Add">
	<input type="submit" name="edit" id="edit" value="Edit">
	<input type="submit" name="delete" id="delete" value="Delete">
	</p>

	<table>
		<tr>
			<th>&nbsp;</th>
			<th>Name</th>
			<th>Email</th>
			<th>Role</th>
		</tr>
HTML;

        $users = new Users($this->site);
        $all = $users->getUsers();
        foreach ($all as $user){
            $id = $user['id'];
            $name = $user['name'];
            $email = $user['email'];
            $role = $user['role'];
            $roleText = '';
            if ($role == User::ADMIN){
                $roleText = 'Admin';
            }elseif ($role == User::CLIENT){
                $roleText = 'Client';
            }elseif ($role == User::STAFF){
                $roleText = 'Staff';
            }
            $html .=<<<HTML
        <tr>
			<td><input type="radio" name="userid" id="userid" value=$id></td>
			<td>$name</td>
			<td>$email</td>
			<td>$roleText</td>
		</tr>
HTML;

        }

        $html .=<<<HTML
	</table>
</form>
HTML;

        return $html;
    }

    private $site;	///< The Site object
}