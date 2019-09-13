<?php
/**
 * Created by PhpStorm.
 * User: newto
 * Date: 3/25/2018
 * Time: 10:41 PM
 */

namespace Felis;


class UserView extends View
{
    /**
     * Constructor
     * Sets the page title and any other settings.
     */
    public function __construct(Site $site, array $get) {
        $this->setTitle("Felis Investigations User");
        $this->addLink("staff.php", "Staff");
        $this->addLink("users.php","Users");
        $this->addLink("post/logout.php", "Log out");
        $this->site = $site;
        $this->get = $get;
    }

    public function present(){
        $email = '';
        $name = '';
        $phone = '';
        $address = '';
        $notes = '';
        $role = '';
        $userid = 0;
        if (isset($this->get['id'])){
            $userid = $this->get['id'];
            $users = new Users($this->site);
            $user = $users->get($userid);
            $email = $user->getEmail();
            $name = $user->getName();
            $phone = $user->getPhone();
            $address = $user->getAddress();
            $notes = $user->getNotes();
            $role = $user->getRole();
        }

        $html =<<<HTML
<form method="post" action="post/user.php">
<input type="hidden" id="id" name="id" value="$userid">
	<fieldset>
		<legend>User</legend>
		<p>
			<label for="email">Email</label><br>
			<input type="email" id="email" name="email" placeholder="Email" value="$email">
		</p>
		<p>
			<label for="name">Name</label><br>
			<input type="text" id="name" name="name" placeholder="Name" value="$name">
		</p>
		<p>
			<label for="phone">Phone</label><br>
			<input type="text" id="phone" name="phone" placeholder="Phone" value="$phone">
		</p>
		<p>
			<label for="address">Address</label><br>
			<textarea id="address" name="address" placeholder="Address">$address</textarea>
		</p>
		<p>
			<label for="notes">Notes</label><br>
			<textarea id="notes" name="notes" placeholder="Notes">$notes</textarea>
		</p>
		<p>
			<label for="role">Role: </label>
			<select id="role" name="role">
HTML;

        if ($role == User::ADMIN) {
            $html .= '<option selected value="admin">Admin</option>';
            $html .= '<option value="staff">Staff</option>';
            $html .= '<option value="client">Client</option>';
        }elseif ($role == User::STAFF) {
            $html .= '<option value="admin">Admin</option>';
            $html .= '<option selected value="staff">Staff</option>';
            $html .= '<option value="client">Client</option>';
        }elseif ($role == User::CLIENT) {
            $html .= '<option value="admin">Admin</option>';
            $html .= '<option value="staff">Staff</option>';
            $html .= '<option selected value="client">Client</option>';
        }else{
            $html .=<<<HTML
<option value="admin">Admin</option>
<option value="staff">Staff</option>
<option value="client">Client</option>
HTML;

        }

        $html .=<<<HTML
			</select>
		</p>
		<p>
			<input type="submit" id="ok" name="ok" value="OK"> 
			<input type="submit" id="cancel" name="cancel" value="Cancel">
		</p>

	</fieldset>
</form>
	<p>
		Admin users have complete management of the system. Staff users are able to view and make
		reports for any client, but cannot edit the users. Clients can only view the cases
		they have contracted for.
	</p>
HTML;

        return $html;
    }

    private $site;	///< The Site object
    private $get;
}