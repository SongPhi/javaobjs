<?php
namespace java\lang;

/**
 *  Copyright (C) 2002-2004
 *  @author chenxi
 *  @version $Id: Vector.class.php,v 0.1 2004/11/15 16:21:46
 */

class Vector extends \java\lang\Object {
    var $elementData = null;
    var $objectOffsets = null;
    var $elementCount = 0;
    var $capacityIncrement = 0;

    function __construct($initialCapacity=10, $capacityIncrement=0) {
        if ($capacityIncrement < 0)
            $this->throws('Illegal Capacity: '. $initialCapacity);

        $this->elementData = array();
        $this->objectPos = array();
        $this->capacityIncrement = $capacityIncrement;
    }

    function pGetVector() {
        print_r($this->elementData);
    }

    function size() {
        //return sizeof($this->elementData);
        return $this->elementCount;
    }

    function capacity() {
        return $this->elementCount;
    }

    function insertElementAt($obj, $index) {
        if ($index > $this->elementCount)
            $this->throws($index .'>'. $obj, null, EXCEPTION_DIE);

        $elementData1 = array_slice($this->elementData, 0, ($index - 1));
        $elementData2 = array_slice($this->elementData, ($index - 1));
        $elementData1[$index] = $obj;
        $this->elementData = array_merge($elementData1, $elementData2);
        $this->elementCount++;
    }

    function isEmpty() {
        return $this->elementCount == 0;
    }

    function contains($key) {
        return in_array($key, $this->elementData);
    }

    function elementAt($index) {
        if ($index >= $this->elementCount)
            $this->throws('index + " >= ' . $this->elementCount);

        return $this->elementData[$index];
    }

    function firstElement() {
        return $this->elementData[0];
    }

    function lastElement() {
        return $this->elementData[$this->elementCount - 1];
    }

    function removeElementAt($index) {
        if ($index >= $this->elementCount)
            $this->throws('index + " >= ' . $this->elementCount);
        $this->elementCount--;
    }

    function addElement($obj) {
        $this->elementData[$this->elementCount++] = $obj;
    }

    function removeElement($obj) {
        $isObj = false;

        if (is_object($obj)) {
            $obj = serialize($obj);
            $isObj = true;
        }

        if ($this->contains($obj)) {
            $tmp = array();
            $i = 0;
            foreach ($this->elementData as $key => $val) {
                if ($obj != $val && $val != '') {
                    $tmp[$i++] = $val;
                } else {
                    $index = $key;
                    --$this->elementCount;
                }
            }
            $this->elementData = $tmp;

            if ($isObj) {
                $tmp = array();
                $i = 0;
                foreach ($this->objectOffsets as $key => $idx) {
                    if ($index != $idx) {
                        $tmp[$i] = $idx;
                    }
                }
            }
            return true;
        }
        return false;
    }

    function removeAllElements() {
        $this->elementData = null;
        $this->elementCount = 0;
    }

    function toArray() {
        return $this->elementData;
    }

    function get($index) {
        if (!is_int($index))
            $this->throws($index.' is not an integer', null, EXCEPTION_DIE);

        if ($index >= $this->elementCount)
            $this->throws($index . ' >= ' . $this->elementCount, null, EXCEPTION_DIE);

        if (!in_array($index, $this->objectOffsets))
            return $this->elementData[$index];
        else
            return unserialize($this->elementData[$index]);
    }

    function add($obj, $index=null) {
        $isObj = false;

        if (is_object($obj)) {
            $obj = serialize($obj);
            $isObj = true;
        }

        if (null === $index) {
            $index = $this->elementCount++;
            $this->elementData[$index] = $obj;
        } else if (is_int($index)) {
            $this->insertElementAt($obj, $index);
        } else {
            $this->throws($index.' is not an integer', null, EXCEPTION_DIE);
        }

        if ($isObj)
            $this->objectOffsets[] = $index;
    }

    function remove($obj) {
        $this->removeElement($obj);
    }

    function clear() {
        $this->removeAllElements();
    }
}
