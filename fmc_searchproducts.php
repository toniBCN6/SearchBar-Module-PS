<?php

if (!defined('_PS_VERSION_')) {
    exit;
}

class Fmc_SearchProducts extends Module
{
    public function __construct()
    {
        $this->name = 'fmc_searchproducts';
        $this->tab = 'search_filter';
        $this->version = '1.0.0';
        $this->author = 'FidelMC6';
        $this->need_instance = 0;
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Search Products');
        $this->description = $this->l('Adds a search box to the website header for searching products.');

        $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');
    }

    public function install()
    {
        if (!parent::install() ||
            !$this->registerHook('displayHeader') ||
            !$this->registerHook('displaySearch') ||
            !$this->registerHook('displaySearchResults')
        ) {
            return false;
        }

        return true;
    }

    public function uninstall()
    {
        if (!parent::uninstall()) {
            return false;
        }

        return true;
    }

    public function hookDisplayHeader()
    {
        $this->context->controller->addCSS($this->_path . 'views/css/fmc_searchproducts.css');
    }

    public function hookDisplaySearch($params)
    {
        $searchQuery = Tools::getValue('search_query');

        $this->smarty->assign([
            'search_query' => $searchQuery,
            'search_action' => $this->context->link->getPageLink('search', true),
            'search_token' => Tools::getToken(false),
        ]);

        return $this->display(__FILE__, 'views/templates/hook/fmc_searchproducts.tpl');
    }

    public function hookDisplaySearchResults($params)
    {
        $searchQuery = Tools::getValue('search_query');

        if (empty($searchQuery)) {
            return;
        }

        $results = [];
        $products = Product::searchByName($this->context->language->id, $searchQuery);

        foreach ($products as $product) {
            $results[] = [
                'name' => $product['name'],
                'url' => $this->context->link->getProductLink($product['id_product']),
            ];
        }

        $this->smarty->assign([
            'search_query' => $searchQuery,
            'results' => $results,
        ]);

        return $this->display(__FILE__, 'views/templates/hook/fmc_searchproducts_results.tpl');
    }
}
