<?php
/**
 * Created by PhpStorm.
 * User: newto
 * Date: 3/20/2018
 * Time: 7:02 PM
 */

namespace Felis;


class LoginView extends View
{
    public function __construct(array &$session, array $get){
        $this->setTitle("Felis Investigations");
        $this->get = $get;
    }

    public function presentForm() {
        $html = <<<HTML
<form method="post" action="post/login.php">
    <fieldset>
        <legend>Login</legend>
        <p>
            <label for="email">Email</label><br>
            <input type="email" id="email" name="email" placeholder="Email">
        </p>
        <p>
            <label for="password">Password</label><br>
            <input type="password" id="password" name="password" placeholder="Password">
        </p>
HTML;

        if (isset($this->get['e'])){
            $html .= '<p class="msg">Invalid login credentials</p>';
        }

        $html .= <<<HTML
        <p>
            <input type="submit" value="Log in"> <a href="">Lost Password</a>
        </p>
        <p><a href="./">Felis Agency Home</a></p>

    </fieldset>
</form>
HTML;


        return $html;
    }

    private $get;
}