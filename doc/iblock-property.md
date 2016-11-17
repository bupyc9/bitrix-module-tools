#### [Главная страница](../README.md)

## Пользовательские свойства инфоблока

Упрощает добавление [пользовательских свойств](http://dev.1c-bitrix.ru/api_help/iblock/classes/user_properties/) в проект.
Описан интерфейс `PropertyInterface` с подробным `phpdoc` для каждого метода.
На основе интерфейса написан абстрактный класс `AbstractProperty`, который реализует некоторые методы интерфейса.
Основной метод это `getPropertyFieldHtml`, который должен вернуть html представление свойства в админке. 

```Рекомендация: так как свойства могут быть разной сложности, рекомендуется представление выносить в компонент, который позволяет подключать css/js, иначе метод `getPropertyFieldHtml` разрастётся до ниимоверных размеров.``` 

#### Определение класса свойства

```php
<?php
class PropertyCheckBox extends \WS\Tools\IblockProperty\AbstractProperty {
    /**
     * @return string
     */
    protected function getType() {
        return 'S';
    }

    /**
     * @return string
     */
    protected function getUserType() {
        return 'CheckBox';
    }

    /**
     * @return string
     */
    protected function getName() {
        return 'Флажок';
    }

    /**
     * @param array $property
     * @param array $value
     * @param array $params
     * @return string
     */
    public function getPropertyFieldHtml(array $property, array $value, array $params) {
        ob_start();
        ?>
        <input type="checkbox" name="<?=$params["VALUE"]; ?>" value="Y"
            <?php if ($value["VALUE"] == "Y"): ?> checked<?php endif; ?>/>
        <label></label>
        <?php
        return ob_get_clean();
    }

    /**
     * @param array $property
     * @param array $value
     * @param array $params
     * @return string
     */
    public function getPublicViewHTML(array $property, array $value, array $params) {
        return $value['VALUE'] == 'Y' ? 'Да' : 'Нет';
    }
}
```

```Замечание: для примера, html представления выводится сразу в методе, так делать не рекомендуется```

#### Регстрация свойства

```php
<?php
\CModule::IncludeModule('ws.tools');
$toolsModule = WS\Tools\Module::getInstance();
$iblockProperty = $toolsModule->iblockProperty();
$iblockProperty->register(new PropertyCheckBox());
```

#### [Главная страница](../README.md)
