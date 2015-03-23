<?php namespace DigitalUnited\ResponsiveImages;

class ParseSettings
{
    private $settings;

    function __construct(Array $stdSettings, Array $settings)
    {
        if (empty($settings['imgId'])) {
            throw new \Exception('Param imgId is missing.');
        }

        $this->settings = $stdSettings;

        foreach ($settings as $settingsKey => $setting) {
            $this->setSetting($settingsKey, $setting);
        }
    }

    /**
     * @param $settingKey
     * @param $setting
     */
    private function setSetting($settingKey, $setting)
    {
        switch ($settingKey) {
            case 'wrapperAttributes':
            case 'imgAttributes':
            case 'divWithBgImageAttributes':
                foreach ($this->settings[$settingKey] as $attributeKey => $stdSetting) {
                    $this->settings[$settingKey][$attributeKey] = $this->mergeWithStdSettingsIfClass($attributeKey, $setting, $stdSetting);
                }
                break;
            default:
                $this->settings[$settingKey] = $setting;
        }
    }

    private function mergeWithStdSettingsIfClass($attributeKey, $setting, $stdSetting)
    {
        if ($attributeKey === 'class' && isset($setting['class'])) {
            return array_merge($setting[$attributeKey], $stdSetting);
        }

        return isset($setting[$attributeKey]) ? $setting[$attributeKey] : $stdSetting;
    }

    public function getSettings()
    {
        return $this->settings;
    }
}