<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class EmptyState extends Component
{
   /**
     * The empty state message.
     *
     * @var string
     */
    public $message;

    /**
     * The empty state icon.
     *
     * @var string
     */
    public $icon;

    /**
     * The action button text.
     *
     * @var string|null
     */
    public $actionText;

    /**
     * The action button URL.
     *
     * @var string|null
     */
    public $actionUrl;

    /**
     * Create a new component instance.
     *
     * @param  string  $message
     * @param  string  $icon
     * @param  string|null  $actionText
     * @param  string|null  $actionUrl
     * @return void
     */
    public function __construct($message, $icon = 'document', $actionText = null, $actionUrl = null)
    {
        $this->message = $message;
        $this->icon = $icon;
        $this->actionText = $actionText;
        $this->actionUrl = $actionUrl;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.empty-state');
    }
}