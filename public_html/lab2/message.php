<?php

class Message
{
    public $text = '';
    public $created;
//  public $tags = "";
  public $drink = false;
    public $smoke = false;
    public $drug = false;
    public $dota = false;

    public function parse($s)
    {
        if (strpos($s, 'drink') !== false) {
            $drink = true;
        }
        if (strpos($s, 'smoke') !== false) {
            $smoke = true;
        }
        if (strpos($s, 'drug') !== false) {
            $drug = true;
        }
        if (strpos($s, 'dota') !== false) {
            $dota = true;
        }
    }
}
