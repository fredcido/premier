<?php

namespace PremierNewsletter\Widgets;

use PremierNewsletter\Helper;
use PremierNewsletter\Repositories;

class Optin extends \WP_Widget
{
    protected $defaultTitle = null;

    protected $defaultDescription = null;

    public function __construct()
    {
        $this->defaultTitle = Helper::t('Newsletter Subscribe');
        $this->defaultDescription = Helper::t('Premier Newsletter Subscribe');

        $widget_ops = array(
            'classname'   => Helper::prefix('premier_opt_in'),
            'description' => $this->defaultTitle,
        );

        parent::__construct('premier_opt_in', $this->defaultTitle, $widget_ops);
    }

    public function widget($args, $instance)
    {
        if (!empty($instance['title'])) {
            $args['title'] = apply_filters('widget_title', $instance['title']);
        }

        echo herbert('twig')->render(
            '@PremierNewsletter/opt-in/widget-form.twig',
            [
                'args'     => $args,
                'instance' => $instance,
            ]
        );
    }

    public function form($instance)
    {
        $title       = !empty($instance['title']) ? $instance['title'] : $this->defaultTitle;
        $description = !empty($instance['description']) ? $instance['description'] : $this->defaultDescription;

        $settingsRepository = new Repositories\SettingsRepository();
        $settings = $settingsRepository->getAll();

        $listRepository = new Repositories\ListRepository();
        $allLists       = $listRepository->getAll();

        echo herbert('twig')->render(
            '@PremierNewsletter/opt-in/admin-form.twig',
            [
                'widget'           => $this,
                'instance'         => $instance,
                'savedTitle'       => $title,
                'savedDescription' => $description,
                'savedList'        => null,
                'allLists'         => $allLists,
            ]
        );
    }

    public function update($new_instance, $old_instance)
    {
        $instance          = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        $instance['description'] = (!empty($new_instance['description'])) ? strip_tags($new_instance['description']) : '';

        return $instance;
    }

}
