<?php defined('SYSPATH') OR die('No direct access allowed.');

/**
 *  @package    forums
 *  @author     George Truong <george@georgetruong.com>
 */
class Post_Model extends ORM {
    protected $belongs_to = array('thread');
}