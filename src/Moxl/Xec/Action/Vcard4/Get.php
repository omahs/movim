<?php
/*
 * Get.php
 * 
 * Copyright 2013 edhelas <edhelas@edhelas-laptop>
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301, USA.
 * 
 * 
 */
namespace Moxl\Xec\Action\Vcard4;

use Moxl\Xec\Action;
use Moxl\Stanza;

class Get extends Action
{
    private $_to;
    private $_me = false;
    
    public function request() 
    {
        $this->store();
        Stanza\vcard4Get($this->_to);
    }
    
    public function setTo($to)
    {
        $this->_to = $to;
        return $this;
    }
        
    public function setMe()
    {
        $this->_me = true;
        return $this;
    }

    public function handle($stanza) {           
        $cd = new \modl\ContactDAO();
        
        $c = $cd->get($this->_to);
        
        if($c == null)
            $c = new \modl\Contact();

        $c->jid       = $this->_to;

        $vcard = $stanza->pubsub->items->item->vcard;
        $c->setVcard4($vcard);

        $c->createThumbnails();

        $cd->set($c);

        $evt = new \Event();
        if($this->_me)
            $evt->runEvent('myvcard', $c);
        else
            $evt->runEvent('vcard', $c);
    }
    
    public function errorItemNotFound($error) {

    }
}
