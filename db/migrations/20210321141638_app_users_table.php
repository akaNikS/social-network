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
        $query = 'create table app_users
            (
                id int(13) unsigned auto_increment,
                email varchar(255) not null,
                name varchar(128) not null,
                surname varchar(128) not null,
                middle_name varchar(128) null,
                password binary(16) not null,
                constraint app_users_pk
                    primary key (id)
            );';

        $queryUniqIndex = 'create unique index app_users_email_uindex on app_users (email);';

        $this->query($query);
        $this->query($queryUniqIndex);

    }
}
