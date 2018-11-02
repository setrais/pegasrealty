<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alexk984
 * Date: 09.10.11
 * Time: 13:14
 */
 
class ProductHelper {

    /**
     * @param MenuModel[] $products
     * @param Restaurants $current_sd
     * @return Restaurants[]
     */
    public static function FindShopsWithSimilarProducts($products, $current_sd){
        $result = array();
        $criteria = new CDbCriteria;
        $criteria->condition = 't.type_id = :type_id AND t.id != :current_sd_id
            AND (t.parent_restaurant_id != :current_sd_id OR t.parent_restaurant_id IS NULL)';
        $criteria->params = array(
            ':type_id'=>$current_sd->type_id,
            ':current_sd_id'=>$current_sd->id
        );
        $criteria->with = array('products');
        $restaurants = Restaurants::model()->findAll($criteria);

        foreach($restaurants as $restaurant)
            //exclude current shop and filials
            if ($restaurant->id != $current_sd->id && $restaurant->parent_restaurant_id != $current_sd->id
                && self::HasItems($restaurant, $products))
                $result [] = $restaurant;
        return $result;
    }

    /**
     * @static
     * @param Restaurants $restaurant
     * @param MenuModel[] $products
     * @return bool
     */
    static function HasItems($restaurant, $products){
        $found = 0;
        foreach($restaurant->products as $product){
            foreach($products as $product2){
                if (self::SameItems($product,$product2)){
                    $found++;
                    break;
                }
            }
        }
        return $found == count($products);
    }

    /**
     * @static
     * @param Restaurants $restaurant
     * @param MenuModel $product
     * @return MenuModel|null
     */
    static function FindItem($restaurant, $product){
        foreach($restaurant->products as $product2){
            if (self::SameItems($product,$product2))
                return $product2;
        }
        return null;
    }

    /**
     * @static
     * @param MenuModel $product1
     * @param MenuModel $product2
     * @return bool
     */
    static function SameItems($product1, $product2){
        if ($product1->name == $product2->name)
            return true;
        return false;
    }
}
