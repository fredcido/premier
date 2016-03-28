<?php 

namespace PremierNewsletter\Widgets;

use PremierNewsletter\Helper;
use PremierNewsletter\Repositories;

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
        if ( ! empty( $instance['title'] ) ) {
            $args['title'] = apply_filters( 'widget_title', $instance['title'] );
        }
        echo herbert('twig')->render(
                '@PremierNewsletter/opt-in/widget-form.twig', 
                [
                    'args'        => $args,
                    'instance'    => $instance
                ]
        );
    }

    public function form($instance)
    {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : $this->defaultTitle;

        $listRepository = new Repositories\ListRepository();
        $allLists = $listRepository->getAll();

        echo herbert('twig')->render(
                '@PremierNewsletter/opt-in/admin-form.twig', 
                [
                    'widget'        => $this,
                    'instance'      => $instance,
                    'savedTitle'    => $title,
                    'savedList'     => null,
                    'allLists'      => $allLists
                ]
        );
    }

    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title'] = ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

        return $instance;
    }

}
