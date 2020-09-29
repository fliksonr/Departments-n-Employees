<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%employees_departments}}`.
 */
class m200925_192909_create_employees_departments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%employees_departments}}', [
            'id' => $this->primaryKey(),
            'employee_id' => $this->integer()->notNull(),
            'department_id' => $this->integer()->notNull()
        ], $tableOptions);

        $this->addForeignKey(
            'fk-emp-dep-emp_id',
            'employees_departments',
            'employee_id',
            'employee',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-emp-dep-dep_id',
            'employees_departments',
            'department_id',
            'department',
            'id',
            'RESTRICT'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%employees_departments}}');
    }
}
