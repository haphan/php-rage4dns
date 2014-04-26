<?php
/**
 * (c) Ha Phan <thanhha.work@gmail.com>
 * Date: 4/26/14
 * Time: 8:57 AM
 */

namespace Haphan\Rage4DNS\Entity;


/**
 * This interface defines entity that can be displayed in console table
 *
 * interface TableRowInterface
 *
 * @package Haphan\Rage4DNS\Entity
 */
interface TableRowInterface
{
    public static function getTableHeaders();
    public function getTableRow();
}