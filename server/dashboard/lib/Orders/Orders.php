<?php
class Orders
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
            'user_id' => 'User ID',
            'status' => 'Status',
            'total' => 'Total',
            'created_at' => 'Created At'
        ];

        return $ordering;
    }
}
?>
