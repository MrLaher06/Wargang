<?php defined('SYSPATH') OR die('No direct access allowed.');

/**
 *  @package    forums
 *  @author     George Truong <george@georgetruong.com>
 */
class Thread_Model extends ORM {

    protected $has_many = array('posts');
    protected $sorting  = array('id' => 'desc');

    /**
     *  Override default delete() function to include deleting related posts
     */
    public function delete($thread_id) {

        // Delete all related posts of this thread
        ORM::factory('post')
            ->where(array('thread_id' => $thread_id))
            ->delete_all();
        // Delete thread
        return parent::delete($thread_id);

    }

    /**
     *  Override default delete_all() function to include deleting related posts
     */
    public function delete_all($thread_ids) {

        foreach($thread_ids as $thread_id) {
            self::delete($thread_id);
        }
        return TRUE;

    }

}