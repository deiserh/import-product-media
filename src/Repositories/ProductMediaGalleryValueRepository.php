<?php

/**
 * TechDivision\Import\Product\Media\Repositories\ProductMediaGalleryValueRepository
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * PHP version 5
 *
 * @author    Tim Wagner <t.wagner@techdivision.com>
 * @copyright 2016 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/techdivision/import-product-media
 * @link      http://www.techdivision.com
 */

namespace TechDivision\Import\Product\Media\Repositories;

use TechDivision\Import\Product\Media\Utils\MemberNames;
use TechDivision\Import\Repositories\AbstractRepository;

/**
 * Repository implementation to load product media gallery value data.
 *
 * @author    Tim Wagner <t.wagner@techdivision.com>
 * @copyright 2016 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/techdivision/import-product-media
 * @link      http://www.techdivision.com
 */
class ProductMediaGalleryValueRepository extends AbstractRepository
{

    /**
     * The prepared statement to load an existing product media gallery value entity.
     *
     * @var \PDOStatement
     */
    protected $productMediaGalleryStmt;

    /**
     * Initializes the repository's prepared statements.
     *
     * @return void
     */
    public function init()
    {

        // load the utility class name
        $utilityClassName = $this->getUtilityClassName();

        // initialize the prepared statements
        $this->productMediaGalleryValueStmt =
            $this->getConnection()->prepare($this->getUtilityClass()->find($utilityClassName::PRODUCT_MEDIA_GALLERY_VALUE));
    }

    /**
     * Load's the product media gallery value with the passed value/store/parent ID.
     *
     * @param integer $valueId  The value ID of the product media gallery value to load
     * @param string  $storeId  The store ID of the product media gallery value to load
     * @param string  $entityId The entity ID of the parent product of the product media gallery value to load
     *
     * @return array The product media gallery value
     */
    public function findOneByValueIdAndStoreIdAndEntityId($valueId, $storeId, $entityId)
    {

        // initialize the params
        $params = array(
            MemberNames::VALUE_ID  => $valueId,
            MemberNames::STORE_ID  => $storeId,
            MemberNames::ENTITY_ID => $entityId
        );

        // load and return the prodcut media gallery value with the passed value/store/parent ID
        $this->productMediaGalleryValueStmt->execute($params);
        return $this->productMediaGalleryValueStmt->fetch(\PDO::FETCH_ASSOC);
    }
}
