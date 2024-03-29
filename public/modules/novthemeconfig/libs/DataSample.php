<?php

if (!defined('_CAN_LOAD_FILES_'))
    exit;

class DataSample {

    private $theme = '';

    public function __construct($themeName = null) {
        if (Context::getContext()->shop->theme_name)
            $this->theme = Context::getContext()->shop->theme_name;
        else {
            $this->theme = $themeName;
        }
    }

    public function importData() {
        $modules = self::getListModule($this->theme);
        $dir_xml = _PS_ALL_THEMES_DIR_ . $this->theme . '/sample/sample.xml';
        $data = array();
        $sqls = '';
        if (file_exists($dir_xml)) {
            $data = simplexml_load_string(file_get_contents($dir_xml));
            $data = get_object_vars($data);
        }
        $dir_php = _PS_ALL_THEMES_DIR_ . $this->theme . '/sample/sample.php';
        if (file_exists($dir_php)) {
            include($dir_php);
        }
        if ($modules) {
            foreach ($modules as $module) {
                $this->importModule($module, $data, $sqls);
            }
        }
    }

    public function importModule($module, $data, $sqls) {
        $fix = array(
            'PREFIX_' => _DB_PREFIX_,
            'ENGINE_TYPE' => _MYSQL_ENGINE_,
        );

        if ($data) {
            $data_module = get_object_vars($data[$module['name']]);
            if (isset($data_module['config']) && $data_module['config']) {
                foreach (get_object_vars($data_module['config']) as $key => $value) {
                    Configuration::updateValue($key, $value);
                }
            }
            if (isset($data_module['hook']) && $data_module['hook']) {
                $hooks = $data_module['hook'];
                $this->InsertHookModule($module['name'], $hooks);
            }
        }

        if (isset($module['query']) && $module['query']) {
            if (isset($sqls[$module['name']]['sql']) && $sqls[$module['name']]['sql']) {
                $queries = str_replace(array_keys($fix), array_values($fix), $sqls[$module['name']]['sql']);
                foreach ($queries as $query) {
                    if ($query)
                        Db::getInstance()->execute(($query));
                }
            }
            if (isset($sqls[$module['name']]['data']) && $sqls[$module['name']]['data']) {
                foreach ($sqls[$module['name']]['data'] as $table => $data_table) {
                    if ((strpos($table, '	') !== false)) {
                        $delete_sql = "DELETE FROM " . _DB_PREFIX_ . $table . "";
                        Db::getInstance()->execute($delete_sql);
                    }
                    $sql = "SELECT count(*) as total FROM " . _DB_PREFIX_ . $table . "";
                    $total = Db::getInstance()->executeS($sql);
                    if ($total[0]['total'] <= 0) {
                        $datas = str_replace('_ID_SHOP_', (int) Context::getContext()->shop->id, $data_table);
                        $datas = str_replace(array_keys($fix), array_values($fix), $datas);
                        $datas = preg_split('#;\s*[\r\n]+#', $datas);
                        foreach ($datas as $data) {
                            if ($data) {

                                $data = str_replace('\/', '\\\/', $data);
                                $data = str_replace('\t', '\\\t', $data);
                                $data = str_replace('\n', '\\\n', $data);
                                $data = str_replace('\"', '\\\\\"', $data);
                                Db::getInstance()->execute($data);
                            }
                        }
                    }
                }
            }
        }
    }

    private function InsertHookModule($name_module, $hooks) {
        $id_shop = Context::getContext()->shop->id;
        $module = Module::getInstanceByName($name_module);
        $id_module = $module->id;
        Db::getInstance()->execute('INSERT IGNORE INTO ' . _DB_PREFIX_ . 'module_shop (id_module, id_shop) VALUES(' . $id_module . ', ' . (int) $id_shop . ')');
        Db::getInstance()->execute($sql = 'DELETE FROM `' . _DB_PREFIX_ . 'hook_module` WHERE `id_module` = ' . pSQL($id_module) . ' AND id_shop = ' . (int) $id_shop);
        if (is_array($hooks)) {
            foreach ($hooks as $hook)
                $this->insertHook($hook, $id_shop, $id_module);
        } else
            $this->insertHook($hooks, $id_shop, $id_module);
    }

    public function insertHook($hook, $id_shop, $id_module) {
        $hook = get_object_vars($hook);
        $sql = 'INSERT INTO `' . _DB_PREFIX_ . 'hook_module` (`id_module`, `id_shop`, `id_hook`, `position`)
			VALUES (' . (int) $id_module . ', ' . (int) $id_shop . ', ' . (int) Hook::getIdByName($hook['namehook']) . ', ' . (int) $hook['position'] . ')';
        Db::getInstance()->execute($sql);
    }

    public function exportData() {
        $path = _PS_ALL_THEMES_DIR_ . $this->theme . "/sample/";
        $modules = self::getListModule($this->theme);

        if (is_array($modules) && !empty($modules)) {

            $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\r\n";
            $xml .= "<sample>\r\n";

            $content = "<?php\r\n";
            $content .= "\$sqls = array();\r\n";

            foreach ($modules as $module) {
                if (isset($module['query']) && $module['query'] == 1) {
                    $tables = is_array($module['tables']['table']) ? ($module['tables']['table']) : array($module['tables']['table']);
                    foreach ($tables as $table) {
                        $content .= "\$sqls['" . $module['name'] . "']['sql'][]= \"" . $this->getSqlInsert($table) . "\";\r\n";
                        $content .= "\$sqls['" . $module['name'] . "']['data']['" . $table . "']=\"" . $this->getSqlSample($table) . "\";\r\n";
                    }
                }

                $xml .= "<" . $module['name'] . ">\r\n";
                if ((isset($module['prefix']) && $module['prefix'])) {
                    $configs = $this->getConfigModule($module);
                    $xml .= "<config>\r\n";
                    foreach ($configs as $config) {
                        $xml .= "<" . trim($config['name']) . ">" . $config['value'] . "</" . trim($config['name']) . ">\r\n";
                    }
                    $xml .= "</config>\r\n";
                }

                $hooks = $this->getHooksByName($module['name']);
                if ($hooks) {
                    foreach ($hooks as $hook) {
                        $xml .= "<hook>\r\n";
                        $xml .= "<namehook>" . $hook["hook"] . "</namehook>\r\n";
                        $xml .= "<position>" . $hook["position"] . "</position>\r\n";
                        $xml .= "</hook>\r\n";
                    }
                }
                $xml .= "</" . $module['name'] . ">\r\n";
            }
            $content .= "?>";
            $xml .= "</sample>\r\n";

            $content_save = @fopen($path . "sample.php", 'w');
            fwrite($content_save, $content);
            fclose($content_save);

            $xml_save = @fopen($path . "sample.xml", 'w');
            fwrite($xml_save, $xml);
            fclose($xml_save);
        }
    }

    public function getHooksByName($module_name) {
        $id_shop = Context::getContext()->shop->id;
        $hooks = Db::getInstance()->executeS('
                SELECT  h.`name` as hook, hm.`position`
                FROM `' . _DB_PREFIX_ . 'hook` h
                LEFT JOIN `' . _DB_PREFIX_ . 'hook_module` hm ON hm.`id_hook` = h.`id_hook`
                LEFT JOIN `' . _DB_PREFIX_ . 'module` m ON hm.`id_module` = m.`id_module`
                WHERE hm.`id_shop` = ' . (int) $id_shop . ' AND m.`name`= \'' . pSQL($module_name) . '\'');
        return $hooks;
    }

    public function getSqlSample($t) {
        if (isset($t)) {
            $output = '';

            $table = _DB_PREFIX_ . $t;
            $sql = 'SELECT * FROM `' . $table . '`';
            $string = $this->getSqlInsert($t);


            $items = Db::getInstance()->executeS($sql);
            foreach ($items as $item) {
                $field = array();
                $values = array();
                foreach ($item as $key => $value) {
                    $field[] = $key;
                    $values[] = "'" . DB::getInstance()->escape($value, true) . "'";
                }
                $output .= 'INSERT INTO `PREFIX_' . $t . '` (`' . implode("`,`", $field) . '`) VALUES(' . implode(", ", $values) . '); ' . "\r\n";
            }

            return $output;
        }
        return;
    }

    public function getSqlInsert($table) {
        $res = Db::getInstance()->executeS('SHOW CREATE TABLE `' . _DB_PREFIX_ . $table . '`');
        $output = $res[0]['Create Table'] . ";\n\n";
        $output = str_replace("CREATE TABLE `" . _DB_PREFIX_, "CREATE TABLE IF NOT EXISTS `PREFIX_", $output);
        $output = str_replace("=" . _MYSQL_ENGINE_, "=ENGINE_TYPE", $output);
        return $output;
    }

    public static function getListModule($theme) {

        $xml = _PS_ALL_THEMES_DIR_ . $theme . '/sample/module.xml';
        $result = array();
        if (file_exists($xml)) {
            $data = simplexml_load_string(file_get_contents($xml));
            if (empty($data)) {
                return $result;
            }
            foreach ($data->children() as $object) {

                $module = get_object_vars($object);
                $item = array();
                foreach ($module as $key => $field) {
                    if (is_object($field)) {
                        $item[$key] = get_object_vars($field);
                    } else {
                        $item[$key] = (string) $field;
                    }
                }
                $result[$item['name']] = $item;
            }
        }
        return $result;
    }

    public function getConfigModule($module) {
        $sql = 'SELECT *
					FROM ' . _DB_PREFIX_ . 'configuration c';
        $sql .= ' WHERE c.`name` LIKE "' . $module['prefix'] . '%"';
        $data = Db::getInstance()->executeS($sql);
        return $data;
    }

}

?>