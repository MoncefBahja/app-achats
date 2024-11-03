<?php
class Products
{
    /**
     *
     */
    public function __construct()
    {
    }

    /**
     *
     */
    public function __destruct()
    {
    }
    
    /**
     * Set friendly columns\' names to order tables\' entries
     */
    public function setOrderingValues()
    {
        $ordering = [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'price' => 'Price',
            'stock' => 'Stock',
            'category_id' => 'Category ID',
            'subcategory_id' => 'Subcategory ID',
            'image_url' => 'Image URL',
            'created_at' => 'Created at'
        ];

        return $ordering;
    }
}
?>
