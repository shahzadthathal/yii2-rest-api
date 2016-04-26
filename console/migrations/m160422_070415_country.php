<?php

use yii\db\Migration;

class m160422_070415_country extends Migration
{
    public function up()
    {

     $this->createTable('{{%country}}', [
            'code'=> $this->primaryKey(),
            'name'=>$this->string(52)->notNull(),
            'population'=>$this->integer()->notNull()->defaultValue(0)
        ]);
        
        $this->batchInsert('{{%country}}',  ['code', 'name', 'population'], 
                                            [
                                            ['AU','Australia','18886000'],
                                            ['BR','Brazil', '170115000'],
                                            ['CA','Canada', '1147000'],
                                            ['CN','China', '1277558000'],
                                            ['DE','Germany', '82164700'],
                                            ['FR','France',  '59225700'],
                                            ['GB','United Kingdom', '59623400'],
                                            ['IN','India', '1013662000'],
                                            ['RU','Russia', '59623400'],
                                            ['US','United States', '278357000'],
                                            ]
        );

    }

    public function down()
    {
        echo "m160422_070415_country cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
