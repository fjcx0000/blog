<?php
namespace App\Blog;

use Illuminate\Contracts\Pagination\Presenter;

/**
 * Define Pagination Render Style
 *
 * @author James.Yang fjcx0000@gmail.com
 * @since 1.0
 */
class PaginationPresenter extends Presenter {
    public function getActivePageWrapper($text)
    {
        return '<li class="am-active"><a href="">'.$text.'</a></li>';
    }
    public function getDisabledTextWrapper($text)
    {
        return '<li class="am-disabled"><a href="">'.$text.'</a></li>';
    }
    public function getPageLinkWrapper($url, $page, $rel = null)
    {
        return '<li><a href="'.$url.'">'.$page.'</a></li>';
    }
}
