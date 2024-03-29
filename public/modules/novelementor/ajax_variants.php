<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include_once('../../config/config.inc.php');
include_once('../../init.php');
include_once('novelementor.php');

$novelementor = new NovElementor();
$context = Context::getContext();
$showLabel = Tools::getValue('showLabel');
$id_product = Tools::getValue('id_product');
$product = new Product($id_product, true, $context->language->id, $context->shop->id);
$product_for_template = $novelementor->getTemplateVarProduct($product);
$attr_groups = $novelementor->assignAttributesGroups($id_product, $product_for_template);

echo json_encode(array(
    'success'=>true,
    'product'=>$product_for_template,
    'groups'=>$attr_groups['groups'],
    'colors'=>$attr_groups['colors'],
    'combinationImages'=>$attr_groups['combinationImages'],
    'showLabel'=>$showLabel
));
die();