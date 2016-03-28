<?php

namespace PremierNewsletter\Repositories;

use PremierNewsletter\Models\PreSettings;

final class SettingsRepository extends AbstractRepository
{
    /**
     * Find first register (because is it only information).
     *
     * @return [type] [description]
     */
    public function findFirst()
    {
        return PreSettings::get()->first();
    }

     /**
      * Update data settings.
      *
      * @param  [type] $settingsId [description]
      * @param  array  $settings   [description]
      *
      * @return [type]           [description]
      */
     public function update($settingsId, array $settings)
     {
         try{
             $model = PreSettings::find($settingsId);
             $model->fill($settings);
             $model->save();
             $response = $this->configNotifier('Updated!', self::NOTIFIER_CLASS_SUCCESS);
         }
         catch(Exception $e){
             $response = $this->configNotifier($e->getMessage(), self::NOTIFIER_CLASS_ERROR);
         }


         return $response;
     }
}
