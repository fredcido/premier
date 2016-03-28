<?php 

namespace PremierNewsletter\Widgets;

use PremierNewsletter\Helper;

class Optin extends \WP_Widget
{
    protected $defaultTitle = null;

    public function __construct()
    {
        $this->defaultTitle = Helper::t('Newsletter Subscribe');

        $widget_ops = array( 
            'classname'     => Helper::prefix('premier_opt_in'),
            'description'   => $this->defaultTitle,
        );

        parent::__construct( 'premier_opt_in', $this->defaultTitle, $widget_ops );
    }

    public function widget($args, $instance)
    {
        // outputs the content of the widget
    }

    public function form($instance)
    {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : $this->defaultTitle;

        echo herbert('Twig_Environment')->render(
                '@PremierNewsletter/opt-in/admin-form.twig', 
                [
                    'instance'  => $instance,
                    'widget'    => $this,
                    'title'     => $title
                ]
        );
    }

    public function update($new_instance, $old_instance)
    {
        // processes widget options to be saved
    }

}
