<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Response;
use Cake\View\Exception\MissingTemplateException;

class PagesController extends AppController
{
    public function beforeFilter(EventInterface $event): void
    {
        parent::beforeFilter($event);

        $this->Authentication->allowUnauthenticated(['display']);
    }

    public function display(string ...$path): ?Response
    {
        if (!$path) {
            return $this->redirect('/');
        }

        if (in_array('..', $path, true) || in_array('.', $path, true)) {
            throw new ForbiddenException();
        }

        $page = $path[0] ?? null;
        $subpage = $path[1] ?? null;
        $this->set(compact('page', 'subpage'));

        try {
            $this->render(implode('/', $path));
        } catch (MissingTemplateException $exception) {
            throw new NotFoundException();
        }

        return null;
    }
}
