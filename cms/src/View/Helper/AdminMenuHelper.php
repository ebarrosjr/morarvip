<?php
declare(strict_types=1);

namespace App\View\Helper;

use Cake\View\Helper;

class AdminMenuHelper extends Helper
{
    public function isActive($controllers, $action = null): bool
    {
        $request = $this->getView()->getRequest();
        $controllers = (array)$controllers;
        if ($action !== null) {
            $action = (array)$action;
        }

        $controllerMatches = in_array($request->getParam('controller'), $controllers, true);
        $actionMatches = $action === null || in_array($request->getParam('action'), $action, true);

        return $controllerMatches && $actionMatches;
    }

    public function activeClass($controllers, $action = null): string
    {
        return $this->isActive($controllers, $action) ? ' active' : '';
    }

    public function openClass($controllers, $action = null): string
    {
        return $this->isActive($controllers, $action) ? ' active open' : '';
    }
}
