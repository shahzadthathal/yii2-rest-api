<?php

use yii\db\Migration;
use yii\db\Schema;
use Carbon\Carbon;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'role' => $this->smallInteger()->notNull()->defaultValue(1),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

         $this->insert('{{%user}}', [
            'email' => 'admin@app.com',
            'username'=>'admin',
            'password_hash'=> '$2y$13$c4vtp6wiLL.nqY158ee1Nui8dI1xfdjqEQJj5vPMzKtIM8uOE/uVW',
            'auth_key'=>'R1p_c-xhZAMHMyKlWHudwVYl3Gjp_lnL',
            'created_at' => date("Y-m-d H:m:s"),
            'updated_at' => date("Y-m-d H:m:s")
        ]);




         /*
        -- post
        */
        $this->createTable('{{%post}}', [
            'id' => Schema::TYPE_PK,
            'category_id' => Schema::TYPE_INTEGER ." NOT NULL DEFAULT '0'",
            'user_id' => Schema::TYPE_INTEGER .' NOT NULL',
            'title' => Schema::TYPE_STRING . ' NOT NULL',
            'slug' => Schema::TYPE_STRING . ' NOT NULL',
            'content' => Schema::TYPE_TEXT . ' NOT NULL',
            'image' => Schema::TYPE_STRING . ' NOT NULL',
            'comments_count' => Schema::TYPE_INTEGER ." NOT NULL DEFAULT '0'",
            'meta_title' => Schema::TYPE_STRING,
            'meta_description' => Schema::TYPE_STRING,
            'meta_keywords' => Schema::TYPE_STRING,
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL'
        ]);
        $this->createIndex('post_title_unique', '{{%post}}', 'title', true);
        $this->createIndex('post_slug_unique', '{{%post}}', 'slug', true);
        $this->createIndex('post_category_id_index', '{{%post}}', 'category_id');
        

/*
        $this->insert('{{%post}}',[
            'category_id' => 1,
            'user_id' => 1,
            'title' => 'yii2 post 1',
            'slug' => 'yii2-post1',
            'content' => "Coooool post!",
            'created_at' => date("Y-m-d H:m:s"),
            'updated_at' => date("Y-m-d H:m:s")
        ]);
*/

         /*
        -- category
        */
        $this->createTable('{{%category}}', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING .' NOT NULL',
            'sort_order' => Schema::TYPE_INTEGER .' NOT NULL',
            'created_at' => Schema::TYPE_INTEGER .' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER .' NOT NULL'
        ]);
        $this->createIndex('category_name_unique', '{{%category}}', 'name', true);
        if ($this->db->driverName === 'mysql') {
            $this->addForeignKey('post_category_f', '{{%post}}', 'category_id', '{{%category}}', 'id');
        }

        /* $this->insert('{{%category}}', [
            'name' => 'Yii2 Category 1',
            'sort_order' => 1,
            'created_at' => date("Y-m-d H:m:s"),
            'updated_at' => date("Y-m-d H:m:s"),
        ]);
*/



         /*
        -- comment
        */
        $this->createTable('{{%comment}}', [
            'id' => Schema::TYPE_PK,
            'user_id' => Schema::TYPE_INTEGER .' NOT NULL',
            'post_id' => Schema::TYPE_INTEGER .' NOT NULL',
            'content' => Schema::TYPE_TEXT . ' NOT NULL',
            'created_at' => Schema::TYPE_DATETIME . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'deleted_at' => Schema::TYPE_INTEGER . ' NOT NULL',
        ]);
        $this->createIndex('comment_user_id_index', '{{%comment}}', 'user_id');
        $this->createIndex('comment_post_id_index', '{{%comment}}', 'post_id');

        
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
