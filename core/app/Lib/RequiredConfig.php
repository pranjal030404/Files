<?php

namespace App\Lib;

class RequiredConfig{

    public function getConfig(){
        return [
            'general_setting' => [
                'title'=>'Configure basic setting of your site like Site Name, Currency, Timezone etc',
                'route'=>route('admin.setting.general')
            ],
            'logo_favicon' => [
                'title'=>'Update the logo and favicon',
                'route'=>route('admin.setting.logo.icon')
            ],
            'notification_template' => [
                'title'=>'Update the global notification template',
                'route'=>route('admin.setting.notification.global.email')
            ],
            'deposit_method' => [
                'title'=>'Setup at-least one payment method',
                'route'=>route('admin.gateway.automatic.index')
            ],
            'seo' => [
                'title'=>'Update the seo configuration',
                'route'=>route('admin.seo')
            ],
            'policy_content' => [
                'title'=>'Update the site policy content',
                'route'=>route('admin.frontend.sections','policy_pages')
            ],
        ];
    }

    public function totalConfigs(){
        return count($this->getConfig());
    }

    public function completedConfig(){
        return gs('config_progress') ?? [];
    }

    public function completedConfigCount(){
        return count($this->completedConfig() ?? []);
    }

    public function completedConfigPercent(){
        return ($this->completedConfigCount() / $this->totalConfigs()) * 100;
    }

    public static function configured($key){
        $completedConfig = gs('config_progress') ?? [];
        if (!in_array($key,$completedConfig)) {
            $general = gs();
            $general->config_progress = array_merge($completedConfig,[$key]);
            $general->save();
        }
    }
}
