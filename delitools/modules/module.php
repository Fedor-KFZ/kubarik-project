<?php
class Module {
    __construct($module, $data) {
        $this->module = $module;
        $this->data = $data;
    }
    render() {
        extract($this->data);
        ob_start();
        include $_SERVER["DOCUMENT_ROOT"]."/modules/".$this->module."/template.php";
        $output = ob_get_clean();
        echo $output;
    }
}