<?php

namespace Users\Menu;

use Illuminate\Support\Facades\Auth;

class Navbar
{
    public function getLinksAuthorized($links)
    {
        $authorized = [];
        foreach ($links as $link) {
            if (isset($link[0])) {
                $l = $this->getLinksAuthorized($link[1]);

                if (\count($l)) {
                    $authorized[] = [
                        $link[0],
                        $l
                    ];
                }
            } elseif (Auth::user()->can($link['permission'])) {
                $authorized[] = $link;
            }
        }
        return $authorized;
    }
}
