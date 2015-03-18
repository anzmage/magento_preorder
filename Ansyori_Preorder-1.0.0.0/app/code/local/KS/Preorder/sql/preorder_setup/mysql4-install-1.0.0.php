<?php
$installer = $this;
/** @var $installer Mage_Catalog_Model_Resource_Setup */

$installer->startSetup();


$productTypes = array(
    Mage_Catalog_Model_Product_Type::TYPE_SIMPLE,
    Mage_Catalog_Model_Product_Type::TYPE_BUNDLE,
    Mage_Catalog_Model_Product_Type::TYPE_CONFIGURABLE,
    Mage_Catalog_Model_Product_Type::TYPE_VIRTUAL
);
$productTypes = join(',', $productTypes);

$installer->addAttribute(Mage_Catalog_Model_Product::ENTITY, 'is_preorder', array(
    'group'         => 'Prices',
    'frontend'      => '',
    'label'         => 'Is Preorder',
    'input'         => 'select',
    'source'        => 'eav/entity_attribute_source_boolean',
    'global'        => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_WEBSITE,
    'visible'       => true,
    'required'      => false,
    'user_defined'  => false,
    'default'       => '',
    'apply_to'      => $productTypes,
    'visible_on_front' => false,
    'used_in_product_listing' => true
));

$installer->endSetup();
?>