<?php

namespace PremierNewsletter\Widgets;

use PremierNewsletter\Helper;
use PremierNewsletter\Repositories;

class Subscribe extends \WP_Widget
{
    protected $defaultTitle = null;

    protected $defaultDescription = null;

    protected $defaultSubject = null;

    public function __construct()
    {
        $this->defaultTitle       = Helper::t('Newsletter Subscribe');
        $this->defaultDescription = Helper::t('Premier Newsletter Subscribe');
        $this->defaultSubject = Helper::t('Confirm subscription');

        $widget_ops = array(
            'classname'   => Helper::prefix('premier_subscribe'),
            'description' => $this->defaultTitle,
        );

        parent::__construct('premier_subscribe', $this->defaultTitle, $widget_ops);
    }

    public function widget($args, $instance)
    {
        if (!empty($instance['title'])) {
            $args['title'] = apply_filters('widget_title', $instance['title']);
        }

        echo herbert('twig')->render(
            '@PremierNewsletter/subscribe/widget-form.twig',
            [
                'args'     => $args,
                'instance' => $instance,
            ]
        );
    }

    public function form($instance)
    {
        $defaultValues = [
            'title'       => $this->defaultTitle,
            'description' => $this->defaultDescription,
            'sender'      => get_bloginfo('admin_email'),
            'subject'     => $this->defaultSubject
        ];
        
        foreach ( $defaultValues as $key => $value ) {
            if ( empty($instance[$key]) )
                $instance[$key] = $value;
        }

        $listRepository = new Repositories\ListRepository();
        $allLists       = $listRepository->getAll();

        echo herbert('twig')->render(
            '@PremierNewsletter/subscribe/admin-form.twig',
            [
                'widget'           => $this,
                'instance'         => $instance,
                'allLists'         => $allLists,
            ]
        );
    }

    public function update($new_instance, $old_instance)
    {
        $instance                = array();
        foreach ( $new_instance as $key => $value )
            $instance[$key] = strip_tags($new_instance[$key]);

        return $instance;
    }

    public function getSettings()
    {
        return current($this->get_settings());
    }

}
