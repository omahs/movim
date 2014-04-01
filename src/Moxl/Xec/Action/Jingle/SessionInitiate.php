<?php
/*
 * SessionInitiate.php
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

namespace Moxl\Xec\Action\Jingle;

use Moxl\Xec\Action;
use Moxl\Stanza;

class SessionInitiate extends Action
{
    private $_to;
    private $_offer;
    
    public function request() 
    {
        $this->store();
        Stanza\jingleSessionInitiate($this->_to, $this->_offer);
    }
    
    public function setTo($to)
    {
        $this->_to = $to;
        return $this;
    }
    
    public function setOffer($offer)
    {
        $this->_offer = $offer;
        return $this;
    }
    
    public function handle($stanza) {
        
        /*if($stanza["type"] == "result"){
            $evt = new \Event();
            $evt->runEvent('jinglesessionaccept', array($this->_to, $this->_node, $this->_data)); 
        }*/    
        /*    //add to bookmark
            $sub = new \modl\Subscription();
            $sub->set(current(explode($stanza["to"], "/")), $this->_to, $this->_node, $stanza);
            
            $sd = new \modl\SubscriptionDAO();
            $sd->set($sub);
        }*/
    }
    
    public function error($error) {
        //$evt = new \Event();
        //$evt->runEvent('creationerror', $this->_node); 
    }
}
