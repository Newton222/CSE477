<?php
/**
 * Created by PhpStorm.
 * User: newto
 * Date: 3/25/2018
 * Time: 12:46 AM
 */

namespace Felis;


class NewCaseView extends View
{
    /**
     * Constructor
     * Sets the page title and any other settings.
     */
    public function __construct(Site $site) {
        $this->setTitle("Felis New Case");
        $this->addLink("staff.php", "Staff");
        $this->addLink("cases.php", "Cases");
        $this->addLink("post/logout.php", "Log out");
        $this->site = $site;
    }

    public function present() {
        $html = <<<HTML
<form method="post" action="post/newcase.php">
	<fieldset>
		<legend>New Case</legend>
		<p>Client:
			<select id="client" name="client">
HTML;

        $users = new Users($this->site);
        foreach($users->getClients() as $client) {
            $id = $client['id'];
            $name = $client['name'];
            $html .= '<option value="' . $id . '">' . $name . '</option>';
        }


        $html .= <<<HTML
            </select>
        </p>
        
        <p>
            <label for="number">Case Number: </label>
			<input type="text" id="number" name="number" placeholder="Case Number">
		</p>

		<p>
		    <input type="submit" id="ok" name="ok" value="OK">
		    <input type="submit" value="Cancel">
		</p>

	</fieldset>
</form>
HTML;

        return $html;
    }

    private $site;	///< The Site object
}