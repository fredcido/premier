<?php

namespace PremierNewsletter\Repositories;

use PremierNewsletter\Helper;

final class SettingsRepository extends AbstractRepository
{
    /**
     * Get setting especifie.
     *
     * @param string $param Pamameter
     *
     * @return string
     */
    public function get($param, $fallback = null)
    {
        $all = $this->getAll();
        return isset($all[$param]) ? $all[$param] : $fallback;
    }

    /**
     * Get All.
     *
     * @return array Settings
     */
    public function getAll()
    {
        return get_option(Helper::prefix('settings'));
    }

     /**
      * Update Settings.
      *
      * @param  array  $settings [description]
      *
      * @return [type]           [description]
      */
     public function update(array $settings)
     {
         try {
             update_option(Helper::prefix('settings'), $settings);
             $response = $this->configNotifier('Updated!', self::NOTIFIER_CLASS_SUCCESS);
         } catch (Exception $e) {
             $response = $this->configNotifier($e->getMessage(), self::NOTIFIER_CLASS_ERROR);
         }

         return $response;
     }
}
