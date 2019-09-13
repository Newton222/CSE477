<?php
/**
 * Created by PhpStorm.
 * User: newto
 * Date: 3/25/2018
 * Time: 9:00 PM
 */

namespace Felis;


class DeleteCaseView extends View
{
    /**
     * Constructor
     * Sets the page title and any other settings.
     */
    public function __construct(Site $site, array $get) {
        $this->setTitle("Felis Delete Case");
        $this->addLink("staff.php", "Staff");
        $this->addLink("cases.php", "Cases");
        $this->addLink("post/logout.php", "Log out");
        $this->site = $site;
        $this->get = $get;
    }

    public function present() {
        $cases = new Cases($this->site);
        $caseId = $this->get['id'];
        $case = $cases->get($caseId);
        $caseNumber = $case->getNumber();

        $html =<<<HTML
<form method="post" action="post/deletecase.php">
	<fieldset>
		<legend>Delete?</legend>
		<p>Are you sure absolutely certain beyond a shadow of
			a doubt that you want to delete case $caseNumber?</p>

		<p>Speak now or forever hold your peace.</p>

		<p>
		    <input type="submit" name="yes" id="yes" value="Yes"> 
		    <input type="submit" name="no" id="no" value="No">
		    <input type="hidden" name="caseId" value="$caseId">
		</p>

	</fieldset>
</form>
HTML;

        return $html;
    }

    private $site;	///< The Site object
    private $get;
}