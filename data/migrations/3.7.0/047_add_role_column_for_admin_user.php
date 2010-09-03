<?php

/**
 * This file is part of the OpenPNE package.
 * (c) OpenPNE Project (http://www.openpne.jp/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file and the NOTICE file that were distributed with this source code.
 */

class Revision47_AddAdministratorRoleColumn extends Doctrine_Migration_Base
{
  public function up()
  {
    $options = array('notnull' => true, 'default' => 'master', 'comment' => 'Administrator\'\'s role');
    $this->addColumn('admin_user', 'role', 'string', '32', $options);
  }

  public function postUp()
  {
    Doctrine_Query::create()
      ->update('AdminUser')
      ->set('role', '?', 'master')
      ->execute();
  }

  public function down()
  {
    $this->removeColumn('admin_user', 'role');
  }
}
