<?php

namespace Litepie\Http\Controllers;

use Litepie\Http\Response\PublicResponse;
use Litepie\Theme\ThemeAndViews;
use Litepie\User\Traits\RoutesAndGuards;

class PublicController extends Controller
{
    use ThemeAndViews;
    use RoutesAndGuards;

    /**
     * Initialize public controller.
     *
     * @return null
     */
    public function __construct()
    {
        $this->response = app(PublicResponse::class);
        $this->setTheme('default');
    }

    /**
     * Show dashboard for each user.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        $page = app(\Litecms\Page\Interfaces\PageRepositoryInterface::class)->getPage('home');

        return $this->response
            ->setMetaKeyword(strip_tags($page->meta_keyword))
            ->setMetaDescription(strip_tags($page->meta_description))
            ->setMetaTitle(strip_tags($page->meta_title))
            ->layout('home')
            ->view('home')
            ->data(compact('page'))
            ->output();
    }
}
