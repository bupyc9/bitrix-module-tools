<?php
namespace WS\Tools\IblockProperty;

/**
 * @author Afanasyev Pavel <afanasev@worksolutions.ru>
 */
interface PropertyInterface {
    public function getUserTypeDescription();

    /**
     * Вызывается перед добавлением или изменением элемента
     * @param array $property
     * @param array $value
     * <ul>
     * <li>VALUE - значение</li>
     * <li>DESCRIPTION - описание</li>
     * </ul>
     * @return array
     * массив ошибок
     */
    public function checkFields(array $property, array $value);

    /**
     * Вызывается при проверке обязательности заполнения значения свойства перед добавлением или изменением элемента,
     * если свойство помечено как обязательное
     * @param array $property
     * @param array $value
     * <ul>
     * <li>VALUE - значение</li>
     * <li>DESCRIPTION - описание</li>
     * </ul>
     * @return int
     */
    public function getLength(array $property, array $value);

    /**
     * Вызывается перед сохранением значения свойства в БД
     * @param array $property
     * @param array $value
     * <ul>
     * <li>VALUE - значение</li>
     * <li>DESCRIPTION - описание</li>
     * </ul>
     * @return array
     * <ul>
     * <li>VALUE - значение</li>
     * <li>DESCRIPTION - описание</li>
     * </ul>
     */
    public function convertToDb(array $property, array $value);

    /**
     * Вызывается в методе \CIBlockResult::Fetch
     * @param array $property
     * @param array $value
     * <ul>
     * <li>VALUE - значение</li>
     * <li>DESCRIPTION - описание</li>
     * </ul>
     * @return array
     * <ul>
     * <li>VALUE - значение</li>
     * <li>DESCRIPTION - описание</li>
     * </ul>
     */
    public function convertFromDb(array $property, array $value);

    /**
     * Вызывается во время построения формы редактирования элемента в административной части
     * @param array $property
     * @param array $value
     * <ul>
     * <li>VALUE - значение</li>
     * <li>DESCRIPTION - описание</li>
     * </ul>
     * @param array $params
     * <ul>
     * <li>VALUE - html безопасное имя для значения</li>
     * <li>DESCRIPTION - html безопасное имя для описания</li>
     * <li>MODE - может принимать зачение:
     * <ul>
     * <li>FORM_FILL - при вызове из формы редактирования элемента</li>
     * <li>iblock_element_admin - при редактировании в режиме просмотра списка элементов</li>
     * <li>EDIT_FORM - при редактировании инфоблока</li>
     * </ul>
     * </li>
     * <li>FORM_NAME - имя формы в которую будет встроен элемент управления</li>
     * </ul>
     * @return string
     * HTML отображения элемента управления для редактирования значений свойства в административной части
     */
    public function getPropertyFieldHtml(array $property, array $value, array $params);

    /**
     * Вывод формы редактирования множественного свойства.
     * Если отсутствует, то используется getPropertyFieldHtml для каждого значения отдельно
     * @param array $property
     * @param array $value
     * <ul>
     * <li>VALUE - значение</li>
     * <li>DESCRIPTION - описание</li>
     * </ul>
     * @param array $params
     * <ul>
     * <li>VALUE - html безопасное имя для значения</li>
     * <li>DESCRIPTION - html безопасное имя для описания</li>
     * <li>MODE - может принимать зачение:
     * <ul>
     * <li>FORM_FILL - при вызове из формы редактирования элемента</li>
     * <li>iblock_element_admin - при редактировании в режиме просмотра списка элементов</li>
     * <li>EDIT_FORM - при редактировании инфоблока</li>
     * </ul>
     * </li>
     * <li>FORM_NAME - имя формы в которую будет встроен элемент управления</li>
     * </ul>
     * @return string
     * HTML отображения элемента управления для редактирования значений свойства в административной части
     */
    public function getPropertyFieldHtmlMulty(array $property, array $value, array $params);

    /**
     * Вызывается во время построения списка элементов в административной части
     * @param array $property
     * @param array $value
     * <ul>
     * <li>VALUE - значение</li>
     * <li>DESCRIPTION - описание</li>
     * </ul>
     * @param array $params
     * <ul>
     * <li>VALUE - html безопасное имя для значения</li>
     * <li>DESCRIPTION - html безопасное имя для описания</li>
     * <li>MODE - может принимать зачение:
     * <ul>
     * <li>FORM_FILL - при вызове из формы редактирования элемента</li>
     * <li>iblock_element_admin - при редактировании в режиме просмотра списка элементов</li>
     * <li>EDIT_FORM - при редактировании инфоблока</li>
     * </ul>
     * </li>
     * <li>FORM_NAME - имя формы в которую будет встроен элемент управления</li>
     * </ul>
     * @return string
     * HTML отображения значения свойства в списке элементов административной части
     */
    public function getAdminListViewHTML(array $property, array $value, array $params);

    /**
     * Вызывается из метода CIBlockFormatProperties::GetDisplayValue, которая используется компонентами модуля
     * информационных блоков для форматирования значений свойств
     * @param array $property
     * @param array $value
     * <ul>
     * <li>VALUE - значение</li>
     * </ul>
     * @param array $params
     * @return string
     * HTML отображения значения свойства в публичной части сайта
     */
    public function getPublicViewHTML(array $property, array $value, array $params);

    /**
     * Вызывается в компонентах во время построения формы редактирования элемента
     * @param array $property
     * @param array $value
     * <ul>
     * <li>VALUE - значение</li>
     * <li>DESCRIPTION - описание</li>
     * </ul>
     * @param array $params
     * <ul>
     * <li>VALUE - html безопасное имя для значения</li>
     * <li>DESCRIPTION - html безопасное имя для описания</li>
     * <li>FORM_NAME - имя формы в которую будет встроен элемент управления</li>
     * </ul>
     * @return string
     * HTML отображения элемента управления для редактирования значений свойства в публичной части сайта
     */
    public function getPublicEditHTML(array $property, array $value, array $params);

    /**
     * Вызывается при построении формы редактирования инфоблока
     * @param array $property
     * @param array $params
     * <ul>
     * <li>NAME - html безопасное имя для настроек</li>
     * </ul>
     * @param array $fields
     * можно вернуть дополнительные флаги управления формой:
     * <ul>
     * <li>HIDE - массив названий полей свойства которые будут скрыты для редактирования.
     * Возможные значения: MULTIPLE, SEARCHABLE, FILTRABLE, WITH_DESCRIPTION, MULTIPLE_CNT, ROW_COUNT, COL_COUNT и DEFAULT_VALUE</li>
     * <li>SHOW - массив полей которые должны быть показаны даже если базовое свойство их не поддерживает.
     * Возможные значения: MULTIPLE, SEARCHABLE, FILTRABLE, WITH_DESCRIPTION, MULTIPLE_CNT, ROW_COUNT и COL_COUNT</li>
     * <li>SET - ассоциативный массив полей для принудительного выставления значений в случае если они не отображаются в форме.
     * Возможные значения: MULTIPLE, SEARCHABLE, FILTRABLE, WITH_DESCRIPTION, MULTIPLE_CNT, ROW_COUNT и COL_COUNT</li>
     * <li>USER_TYPE_SETTINGS_TITLE - строка для отображения в качестве заголовка секции настроек.</li>
     * </ul>
     * @return string
     * HTML отображения настроек свойства для формы редактирования инфоблока
     */
    public function getSettingsHTML(array $property, array $params, array & $fields);

    /**
     * Вызывается перед сохранением метаданных свойства в базу данных
     * @param array $fields
     * @return array
     * массив с дополнительными настройками свойства, либо весь набор настроек, включая стандартные
     */
    public function prepareSettings(array $fields);
}