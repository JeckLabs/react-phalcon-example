<?php

namespace App;

class ReactEngine
{
    private $counters = [];

    public function react_component($name, $data=[]) {
        $id = $this->getNextId($name);
        $container = sprintf('<div id="%s" data-props="%s"></div>', $id, htmlspecialchars(json_encode($data)));

        $jsId = json_encode($id);
        $jsName = json_encode($name);
        $script = '<script>'
            . 'if (window.add_component !== undefined) {'
            . ' window.add_component(' . $jsName . ', ' . $jsId . ');'
            . '} else {'
            . ' (window.__components_queue=window.__components_queue||[]).push([' . $jsName . ', ' . $jsId . '])'
            . '}'
            . '</script>';

        return $container . $script;
    }

    private function getNextId($name)
    {
        $name = mb_strtolower($name);
        if (empty($this->counters[$name])) {
            $this->counters[$name] = 0;
        }
        $this->counters[$name] += 1;
        return sprintf('%s-%d', $name, $this->counters[$name]);
    }
}