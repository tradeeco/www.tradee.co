<?php
    function active_class($controller, $currentController) {
        if ($controller == $currentController)
            return 'active';
        else return '';
    }
?>