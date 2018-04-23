<?php
namespace java\lang;

/**
 *  Copyright (C) 2002-2004
 *  @author chenxi
 *  @version $Id: StringBuffer.class.php,v 0.1 2004/11/04 09:39:45
 */


class StringBuffer extends \java\lang\Object {
    var $string = '';

    function __construct($string='') {
        $this->string = $string;
    }

    function append($string) {
        $this->string .= $string;
        return $this;
    }

    function appendEnter() {
        $this->string .= '<br />';
        return $this;
    }

    function toString() {
        return $this->string;
    }

    public function __toString() { 
        return $this->string;
    }

}
