<?php

namespace Isaadsalman\HeadlessRefresh\Widgets;

use Statamic\Widgets\Widget;

class HeadlessRefresh extends Widget
{
    public static $handle = 'headless-refresh';

    /**
     * The HTML that should be shown in the widget.
     *
     * @return string|\Illuminate\View\View
     */

    public function html() {
        return view('headless-refresh::widgets.headless-refresh');
    }
}