<?php
namespace WS\Tools\IblockProperty;

/**
 * @author Afanasyev Pavel <afanasev@worksolutions.ru>
 */
abstract class AbstractProperty implements PropertyInterface {
    /**
     * @return string
     */
    abstract protected function getType();

    /**
     * @return string
     */
    abstract protected function getUserType();

    /**
     * @return string
     */
    abstract protected function getName();

    public final function getUserTypeDescription() {
        return array(
            'PROPERTY_TYPE' => $this->getType(),
            'USER_TYPE' => $this->getUserType(),
            'DESCRIPTION' => $this->getName(),
            'CheckFields' => array($this, 'checkFields'),
            'GetLength' => array($this, 'getLength'),
            'ConvertToDB' => array($this, 'convertToDb'),
            'ConvertFromDB' => array($this, 'convertFromDb'),
            'GetPropertyFieldHtml' => array($this, 'getPropertyFieldHtml'),
            'GetPropertyFieldHtmlMulty' => array($this, 'getPropertyFieldHtmlMulty'),
            'GetAdminListViewHTML' => array($this, 'getAdminListViewHTML'),
            'GetPublicViewHTML' => array($this, 'getPublicViewHTML'),
            'GetPublicEditHTML' => array($this, 'getPublicEditHTML'),
            'GetSettingsHTML' => array($this, 'getSettingsHTML'),
            'PrepareSettings' => array($this, 'prepareSettings'),
        );
    }

    public function checkFields(array $property, array $value) {
        return array();
    }

    public function getLength(array $property, array $value) {
        return strlen($value['VALUE']);
    }

    public function convertToDb(array $property, array $value) {
        return $value;
    }

    public function convertFromDb(array $property, array $value) {
        return $value;
    }

    public function getPropertyFieldHtmlMulty(array $property, array $value, array $params) {
        return '';
    }

    public function getAdminListViewHTML(array $property, array $value, array $params) {
        if (strlen($value['VALUE']) > 0) {
            return str_replace(' ', '&nbsp;', htmlspecialchars($value['VALUE']));
        }

        return '&nbsp;';
    }

    public function getPublicViewHTML(array $property, array $value, array $params) {
        if (strlen($value['VALUE']) > 0) {
            return str_replace(' ', '&nbsp;', htmlspecialchars($value['VALUE']));
        }

        return '';
    }

    public function getPublicEditHTML(array $property, array $value, array $params) {
        return '<input type="text" name="' . htmlspecialchars($params["VALUE"]) . '" size="25" value="' . htmlspecialchars(
            $value["VALUE"]
        ) . '" />';
    }

    public function getSettingsHTML(array $property, array $params, array & $fields) {
        return '';
    }

    public function prepareSettings(array $fields) {
        return array();
    }
}