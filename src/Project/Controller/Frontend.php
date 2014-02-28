<?php

namespace Project\Controller;

class Frontend extends Controller
{
    public function homepage()
    {
        return $this->render('Frontend/homepage');
    }
}