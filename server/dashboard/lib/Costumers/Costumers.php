<?php
class Costumers
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
            'fullname' => 'Full Name',
            'email' => 'Email',
            'password' => 'Password',
            'phone' => 'Phone',
            'birthdate' => 'Birth Date',
            'gender' => 'Gender',
            'address_line_one' => 'Address Line 1',
            'address_line_two' => 'Address Line 2',
            'country' => 'Country',
            'city' => 'City',
            'region' => 'Region',
            'postalcode' => 'Postal Code',
            'created_at' => 'Created at'
        ];

        return $ordering;
    }
}
?>
