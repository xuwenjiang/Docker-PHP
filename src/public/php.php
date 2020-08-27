<?php
class TimeMap {
    protected $_cache = null;
    /**
     * Initialize your data structure here.
     */
    function __construct() {
        $this->_cache = [];
    }

    /**
     * @param String $key
     * @param String $value
     * @param Integer $timestamp
     * @return NULL
     */
    function set($key, $value, $timestamp) {
        if (isset($this->_cache[$key])) {
            $this->_cache[$key][] = [$timestamp => $value];
        } else {
            $this->_cache[$key] = [[$timestamp => $value]];
        }
    }

    /**
     * @param String $key
     * @param Integer $timestamp
     * @return String
     */
    function get($key, $timestamp) {
        if (!isset($this->_cache[$key])) {
            return "";
        }

        $times = count($this->_cache[$key]);

        if (key($this->_cache[$key][0]) > $timestamp) {
            return "";
        }

        if (key($this->_cache[$key][$times-1]) <= $timestamp) {
            return current($this->_cache[$key][$times-1]);
        }

        $left = 0;
        $right = $times - 1;

        while($left < $right - 1) {
            $mid = intval(($left + $right) / 2);
            $midVal = key($this->_cache[$key][$mid]);
            if ($midVal == $timestamp) {
                return current($this->_cache[$key][$mid]);
            }
            if($midVal < $timestamp) {
                $left = $mid;
            } else {
                $right = $mid - 1;
            }
        }

        return current($this->_cache[$key][$left]);
    }
}


$s = new TimeMap();

//[[],["love","high",10],["love","low",20],["love",5],["love",10],["love",15],["love",20],["love",25]]
//"foo","bar",1],["foo",1],["foo",3],["foo","bar2",4],["foo",4],["foo",5]]
$result = $s->set('love', 'high', 10);
$result = $s->set('love', 'low', 20);
$result = $s->get('love',5);
$result = $s->get('love',10);
$result = $s->get('love',15);
$result = $s->get('love',20);
$result = $s->get('love',25);
//$result = $s->set('foo', 'bar2', 4);
//$result = $s->set('foo', 'bar2', 4);
//$result = $s->get('foo',4);
//$result = $s->get('foo',5);
$i = 0;