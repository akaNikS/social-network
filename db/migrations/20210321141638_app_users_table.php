<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AppUsersTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        $query = 'CREATE TABLE
        (
            id int auto_increment,
            email varchar(255) null,
            name varchar(128) null,
            surname varchar(128) null,
            middle_name varchar(128) null,
            password varchar(255) null,
            constraint app_users_pk
                primary key (id)
        )';
        $this->query($query);
    }
}
