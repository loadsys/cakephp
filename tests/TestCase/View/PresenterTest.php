<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         3.0.7
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace Cake\Test\TestCase\View;

use Cake\View\Presenter;
use Cake\ORM\Entity;
use Cake\TestSuite\TestCase;
use Cake\Validation\Validator;

/**
 * Entity test case.
 */
class EntityTest extends TestCase
{

    /**
     *
     */
    public function testProxyToEntity() {
        $entity = $this->getMock('Entity');
        $entity->expects($this->once())
            ->method('get')
            ->with('name')
            ->will($this->returnValue('Andrew'));
        $presenter = new Presenter($entity);

    }
}
