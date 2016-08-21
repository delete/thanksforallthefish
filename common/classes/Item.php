<?php 
require_once "/var/www/site/common/models/Model.php";
require_once "/var/www/site/common/models/fields/IntegerField.php";
require_once "/var/www/site/common/models/fields/BooleanField.php";

/**
* 
*/
class Item extends Model
{
    public $_table_ = 'item';
    public $id;
    public $status;
    
    public function __construct($id, $status)
    {

        // Atributes that will be table columns.
        $this->id = new IntegerField("id", 11, false, true, $id);
        $this->status = new BooleanField('status', $status);
        
        // Must pass all the attributos as array to createTable function.
        $this->createTable(
            [ 
                [ 
                    'id' => $this->id->create() 
                ], 
                [ 
                    'staus' => $this->status->create() 
                ]
            ]
        );
    }
}

/*
CREATE TABLE `item` (
`id` int(11) NOT NULL PRIMARY KEY DEFAULT 1,
`status` tinyint(1) NOT NULL DEFAULT true
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
*/