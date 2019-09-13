<?php
/**
 * Created by PhpStorm.
 * User: newto
 * Date: 3/20/2018
 * Time: 11:18 AM
 */

namespace Felis;


class HomeView extends View
{
    /**
     * Constructor
     * Sets the page title and any other settings.
     */
    public function __construct() {
        $this->setTitle("Felis Investigations");
        $this->addLink("login.php", "Log in");
    }

    /**
     * Add content to the header
     * @return string Any additional comment to put in the header
     */
    protected function headerAdditional() {
        return <<<HTML
<p>Welcome to Felis Investigations!</p>
<p>Domestic, divorce, and carousing investigations conducted without publicity. People and cats shadowed
	and investigated by expert inspectors. Katnapped kittons located. Missing cats and witnesses located.
	Accidents, furniture damage, losses by theft, blackmail, and murder investigations.</p>
<p><a href="">Learn more</a></p>
HTML;
    }

    public function addTestimonial($sentence, $cite){
        $this->sentences[] = $sentence;
        $this->cites[] = $cite;
    }

    public function testimonials(){
        $html = <<<HTLM
<section class="testimonials">
	<h2>TESTIMONIALS</h2>
HTLM;

        $length = count($this->sentences);
        $last_i = 0;

        // Add left
        $html .= '<div class="left">';
        for ($i = 0; $i < $length/2; $i++){
            $sentence = $this->sentences[$i];
            $cite = $this->cites[$i];
            $last_i = $i;
            $html .= <<<HTML
    <blockquote>
        <p>$sentence</p>
        <p><cite>$cite</cite></p>
    </blockquote>
HTML;
        }
        $html .= '</div>';

        // Add right
        $html .= '<div class="right">';
        for ($i = $last_i+1; $i < $length; $i++) {
            $sentence = $this->sentences[$i];
            $cite = $this->cites[$i];
            $html .= <<<HTML
    <blockquote>
        <p>$sentence</p>
        <p><cite>$cite</cite></p>
    </blockquote>
HTML;
        }
        $html .= '</div>';

        $html .= '</section>';

        return $html;
    }

    private $sentences = array();
    private $cites = array();
}