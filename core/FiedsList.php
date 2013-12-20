<?php
class FieldsList {
    
    #properties declaration
    public $listTitle = '',
    public $subtitle = '';
    
    public $FiedlsCollection = new Field();

    #constructors

    function add_item($artnr, $num) {
        $this->items[$artnr] += $num;
    }

    // Take $num articles of $artnr out of the cart

    function remove_item($artnr, $num) {
        if ($this->items[$artnr] > $num) {
            $this->items[$artnr] -= $num;
            return true;
        } elseif ($this->items[$artnr] == $num) {
            unset($this->items[$artnr]);
            return true;
        } else {
            return false;
        }
    }
}
?>