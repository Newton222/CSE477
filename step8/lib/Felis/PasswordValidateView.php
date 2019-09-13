<?php
/**
 * Created by PhpStorm.
 * User: newto
 * Date: 3/26/2018
 * Time: 11:04 PM
 */

namespace Felis;


class PasswordValidateView extends View
{
    const INVALID_VALIDATOR = 1;
    const INVALID_EMAIL = 2;
    const EMAIL_DOES_NOT_MATCH = 3;
    const PASSWORD_TOO_SHORT = 5;
    const PASSWORD_NOT_MATCH = 4;

    public function __construct(Site $site, $get){
        $this->setTitle("Felis Password Entry");
        $this->site = $site;
        $this->validator = strip_tags($get['v']);
        if (isset($get['e'])) {
            $this->errorCode = strip_tags($get['e']);
        }
    }

    public function present(){
        $html =<<<HTML
<form method="post" action="post/password-validate.php">
    <input type="hidden" name="validator" value="$this->validator">
        <fieldset>
            <legend>Change Password</legend>
            <p>
                <label for="email">Email</label><br>
                <input type="email" id="email" name="email" placeholder="Email">
            </p>
            <p>
                <label for="password">Password:</label><br>
                <input type="password" id="password" name="password" placeholder="password">
            </p>
            <p>
                <label for="password">Password (again):</label><br>
                <input type="password" id="password2" name="password2" placeholder="password">
            </p>
HTML;
        if ($this->errorCode == self::INVALID_VALIDATOR){
            $html .= '<p class="msg">Invalid or unavailable validator</p>';
        }elseif ($this->errorCode == self::INVALID_EMAIL){
            $html .= '<p class="msg">Email address is not for a valid user</p>';
        }elseif ($this->errorCode == self::EMAIL_DOES_NOT_MATCH){
            $html .= '<p class="msg">Email address does not match validator</p>';
        }elseif ($this->errorCode == self::PASSWORD_NOT_MATCH){
            $html .= '<p class="msg">Passwords did not match</p>';
        }elseif ($this->errorCode == self::PASSWORD_TOO_SHORT){
            $html .= '<p class="msg">Password too short</p>';
        }

        $html .=<<<HTML
            <p>
                <input type="submit" id="ok" name="ok" value="OK"> 
                <input type="submit" id="cancel" name="cancel" value="Cancel">
            </p>
        </fieldset>
    </form>
HTML;
        return $html;

    }

    private $site;	///< The Site object
    private $validator;
    private $errorCode;
}