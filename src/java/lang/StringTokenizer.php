<?php
namespace java\lang;

/**
 *  Copyright (C) 2002-2004
 *  @author chenxi
 *  @version $Id: StringTokenizer.class.php,v 0.1 2004/11/03 10:00:18
 */

 class StringTokenizer extends \java\lang\Object {

    var $pos = 0;

    var $tokens = array();

    function __construct($string, $separator) {
        if (!is_string($string))
            trigger_error('StringTokenizer->__construct: param is not a string');
        $this->tokens = explode($separator, $string);
    }
    
    function __destruct() {}

    /**
     *  @return ����token�ĸ���
     */
    function countTokens() {
        return sizeof($this->tokens);
    }

    function hasMoreElements() {}

    /**
     *  @return �����Ԫ�ط���ture�����򷵻�false
     */
    function hasMoreTokens() {
        return ($this->pos < sizeof($this->tokens));
    }

    function nextElement() {}
    
    /**
     *  @return ������һ��token
     */
    function nextToken() {
        if ($this->pos > sizeof($this->tokens))
            trigger_error('tokenԽ��');

        return $this->tokens[$this->pos++];
    }

    //function nextToken($delim) {}
 }
