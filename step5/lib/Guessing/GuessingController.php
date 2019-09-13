<?php
/**
 * Created by PhpStorm.
 * User: chenshuxu
 * Date: 2/13/18
 * Time: 6:51 PM
 */

namespace Guessing;


class GuessingController
{
    /**
     * Constructor
     */
    public function __construct(Guessing $guessing, $post) {
        $this->guessing = $guessing;

        if (isset($post['clear'])){
            $this->reset = true;
        }else if (isset($post['value'])) {
            $this->value = strip_tags($post['value']);
            $guessing->guess($this->value);
        }
    }

    public function getValue(){
        return $this->value;
    }

    public function isReset(){
        return $this->reset;
    }

    private $reset = false;
    private $guessing;
    private $value;
}