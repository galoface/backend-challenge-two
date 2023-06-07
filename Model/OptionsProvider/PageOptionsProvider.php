<?php

namespace Infobase\CustomerAccess\Model\OptionsProvider;

use Magento\Framework\Data\OptionSourceInterface;

/**
 * Class PageOptionsProvider
 * @package Infobase\CustomerAccess\Model\OptionsProvider
 */
class PageOptionsProvider implements OptionSourceInterface
{

    /**
     * @return array
     */
    public function toOptionArray()
    {
        $options = [];

        $allRouteActions = $this->getAllRouteActions();

        if (!empty($allRouteActions)) {
            foreach ($allRouteActions as $key => $value) {
                $option = [
                    "label" => __($value),
                    "value" => $key
                ];

                array_push($options, $option);
            }

            return $options;
        }
    }

    /**
     * @return string[]
     */
    public function getAllRouteActions()
    {
        return [
            "catalog_product_view" => "Product Page"
        ];
    }
}

