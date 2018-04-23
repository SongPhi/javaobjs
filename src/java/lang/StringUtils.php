<?php
namespace java\lang;

/**
 *  Copyright (C) 2002-2004
 *  @author chenxi
 *  @version $Id: StringUtils.class.php,v 0.1 2004/11/03 11:06:06
 *  @since 0.1
 */

class StringUtils extends \java\lang\Object {
    /**
     *  Find first char of given string, ignore whitespace, then uppsercase this char 
     *  and return
     *  @param String $string
     *  @return mixed
     *  @access public
     */
    function firstNonWsChar($string=null) {
        if (null === $string || '' == trim($string))
            return false;

        for ($i = 0; $i < strlen($string); $i++) {
            if (!StringUtils::isWhitespace($string[$i]))
                return strtoupper($string[$i]);
        }

        return false;
    }

    /**
     *  Indicate whether the chars is a numeric(int, float, double)
     *  @param char[] $chars
     *  @return int
     *  @access public
     */
    function isNumeric($chars) {
        if (function_exists('is_numeric')) return is_numeric($chars);

        $numeric = array('.', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0');

        $dot = 0;
        for ($i = 0; $i < strlen($chars); $i++) {
            if ($dot <= 1) {
                if (in_array($chars[$i], $numeric)) {
                    if ('.' == $chars[$i])
                        $dot++;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        if ((int)1 == $dot) {
            return ceil($chars);
        }

        return (int)$chars;
    }

    /**
     *  Indicate whether the given char is white space
     *  @param char[] $char
     *  @return boolean
     *  @access public
     */
    function isWhitespace($char) {
        $SPACE_CHAR = array(' ', 'กก');

        if (in_array($char, $SPACE_CHAR)) return true;
            
        return false;
    }

    /**
     *  Indicate whether the given string start with specified word, also support
     *  case sensitive option
     *  @param String $searchIn
     *  @param String $searchFor
     *  @param boolean $ignore
     *  @param int $offset
     *  @return boolean
     *  @access public
     */
    function startsWith($searchIn='', $searchFor='', $ignore=false, $offset=0) {
        if ($ignore)
            $function = 'startsWithIgnoreCase';
        else
            $function = 'startsWithNoneIgnoreCase';

        return StringUtils::$function($searchIn, $searchFor);
    }

    /**
     *  not implements yet
     */
    function endsWith($searchIn='', $searchFor='', $ignore=false) {
    }

    /**
     *  Indicate whether the given string start with specified word with case sensitive
     *  @param String $searchIn
     *  @param String $searchFor
     *  @return boolean
     *  @access public
     */
    function startsWithIgnoreCase($searchIn='', $searchFor='') {
        if (!function_exists('stripos')) {
            $pos = strpos(strtolower($searchIn), strtolower($searchFor));
            if (false !== $pos) return ($pos == 0);
            
            return false;
        }

        $pos = stripos($searchIn, $searchFor);
        if (false !== $pos) return ($pos == 0);
        
        return false;
    }

    /**
     *  Indicate whether the given string start with specified word without case sensitive
     *  @param String $searchIn
     *  @param String $searchFor
     *  @return boolean
     *  @access public
     */
    function startsWithNoneIgnoreCase($searchIn='', $searchFor='') {
        $pos = strpos($searchIn, $searchFor);
        if (false !== $pos) {
            return $pos == (int)0;
        }
        return false;
    }

    /**
     *  Indicate whether the given string start with specified word with case sensitive option
     *  @param String $searchIn
     *  @param String $searchFor
     *  @param boolean $ignore
     *  @return boolean
     *  @access private
     */
    function doCheck($searchIn, $searchFor, $ingore=false) {
        if ($ingore) {
            $searchIn  = strtolower($searchIn);
            $searchFor = strtolower($searchFor);
        }

        $len = strlen($searchFor);
        $start = substr($searchIn, 0, $len);
        if ($searchFor == $start)
            return true;
        return false;
    }
}
