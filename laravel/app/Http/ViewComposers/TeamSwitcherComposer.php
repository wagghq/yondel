<?php

namespace Wagg\Yondel\Http\ViewComposers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TeamSwitcherComposer
{
    public function compose(View $view)
    {
        $view->with('teams', Auth::user()->teams);
    }
}
