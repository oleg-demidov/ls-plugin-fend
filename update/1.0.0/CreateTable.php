<?php

class PluginFend_Update_CreateTable extends ModulePluginManager_EntityUpdate
{
    /**
     * Выполняется при обновлении версии
     */
    public function up()
    {
//        if($this->exportSQL(Plugin::GetPath(__CLASS__) . '/update/1.0.0/dump.sql')){
//            $this->Message_AddNoticeSingle('Применены миграции плагина Page', null, true);
//        }
    }

    /**
     * Выполняется при откате версии
     */
    public function down()
    {
//         $this->exportSQL(Plugin::GetPath(__CLASS__) . '/update/1.0.0/drop_dump.sql');
    }
}