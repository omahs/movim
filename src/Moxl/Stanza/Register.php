<?php

namespace Moxl\Stanza;

class Register
{
    public static function get($to = false)
    {
        $dom = new \DOMDocument('1.0', 'UTF-8');
        $query = $dom->createElementNS('jabber:iq:register', 'query');

        \Moxl\API::request(\Moxl\API::iqWrapper($query, $to, 'get'));
    }

    public static function set($to = false, $data)
    {
        $dom = new \DOMDocument('1.0', 'UTF-8');
        $query = $dom->createElementNS('jabber:iq:register', 'query');

        $x = $dom->createElement('x');
        $x->setAttribute('xmlns', 'jabber:x:data');
        $x->setAttribute('type', 'submit');
        $query->appendChild($x);

        \Moxl\Utils::injectConfigInX($x, $data);

        \Moxl\API::request(\Moxl\API::iqWrapper($query, $to, 'set'));
    }

    public static function remove()
    {
        $dom = new \DOMDocument('1.0', 'UTF-8');
        $query = $dom->createElementNS('jabber:iq:register', 'query');
        $query->appendChild($dom->createElement('remove'));

        \Moxl\API::request(\Moxl\API::iqWrapper($query, false, 'set'));
    }

    public static function changePassword($to, $username, $password)
    {
        $dom = new \DOMDocument('1.0', 'UTF-8');
        $query = $dom->createElementNS('jabber:iq:register', 'query');
        $query->appendChild($dom->createElement('username', $username));
        $query->appendChild($dom->createElement('password', $password));

        \Moxl\API::request(\Moxl\API::iqWrapper($query, $to, 'set'));
    }
}
