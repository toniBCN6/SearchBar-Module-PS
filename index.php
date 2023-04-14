<?php

if (!defined('_PS_VERSION_')) {
    exit;
}

class Fmc_SearchProducts extends Module
{
    public function __construct()
    {
        $this->name = 'fmc_searchproducts';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'FidelMC6';
        $this->need_instance = 0;

        parent::__construct();

        $this->displayName = $this->l('FMC Search Products');
        $this->description = $this->l('Adds a search bar to search for products in your store.');

        $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');

        if (!Configuration::get('FMC_SEARCHPRODUCTS')) {
            $this->warning = $this->l('No name provided');
        }
    }

    public function install()
    {
        if (!parent::install()
            || !$this->registerHook('displayHeader')
            || !$this->registerHook('displayTop')
            || !$this->registerHook('displayNav1')
            || !$this->registerHook('displaySearch')
            || !Configuration::updateValue('FMC_SEARCHPRODUCTS', 'My friend')
        ) {
            return false;
        }

        return true;
    }

    public function uninstall()
    {
        if (!parent::uninstall() ||
            !$this->unregisterHook('displayTop') ||
            !$this->unregisterHook('displayNav1') ||
            !$this->unregisterHook('displaySearch')) {
            return false;
        }

        return true;
    }

    public function hookDisplayHeader()
    {
        $this->context->controller->addCSS($this->_path.'views/css/fmc_searchproducts.css', 'all');
    }

    public function hookDisplayTop()
    {
        $search_action = $this->context->link->getPageLink('search', true, (int) Configuration::get('PS_LANG_DEFAULT'));
        $search_query = Tools::getValue('search_query');
        $search_token = Tools::getToken(false);

        $this->context->smarty->assign(array(
            'search_action' => $search_action,
            'search_query' => $search_query,
            'search_token' => $search_token,
            'search_products_label' => $this->l('Search'),
            'search_placeholder' => $this->l('Search products'),
            'search_no_results' => $this->l('No results found'),
        ));

        return $this->display(__FILE__, 'views/templates/hook/fmc_searchproducts.tpl');
    }

    public function hookDisplayNav1()
    {
        return $this->hookDisplayTop();
    }

    public function hookDisplaySearch()
    {
        return $this->hookDisplayTop();
    }
}