<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Maintenance extends Application {

    public function index()
	{
		$menu = $this->menu->all();

		$this->render();
	}

	// Handle an incoming GET - cRud
    function index_get()
    {
        $key = $this->get('id');
        if (!$key)
        {
            $this->response($this->menu->all(), 200);
        } 
        else
        {
            $result = $this->menu->get($key);
            if ($result != null) 
            {
                $this->response($result, 200);
            }
            else
            {
                $this->response(array('error' => 'Menu item not found!'), 404);
            }
        }
    }

    // Handle an incoming PUT - crUd
    // /maintenance?id=123
    function index_put()
    {
        $key = $this->get('id');
        $record = array_merge(array('id' => $key), $this->_put_args);
        $this->menu->update($record);
        $this->response(array('ok'), 200);
    }

    // Handle an incoming POST - add a new menu item
    // /maintenance/item/id/123
    function index_post()
    {
        $key = $this->get('id');
        $record = array_merge(array('id' => $key), $_POST);
        $this->menu->add($record);
        $this->response(array('ok'), 200);
    }

    // Handle an incoming DELETE - cruD
    // /maintenance/item/id/123
    function index_delete()
    {
        $key = $this->get('id');
        $this->menu->delete($key);
        $this->response(array('ok'), 200);
    }

    // Handle an incoming GET ... return 1 menu item
    // /maintenance/item/id/6
    function item_get()
    {
        $key = $this->get('id');
        $result = $this->menu->get($key);
        if ($result != null) 
        {
            $this->response($result, 200);
        }
        else
        {
            $this->response(array('error' => 'Menu item not found!'), 404);
        }      
    }
}