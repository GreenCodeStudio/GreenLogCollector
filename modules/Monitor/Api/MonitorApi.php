<?php
namespace Monitor\Api;

class MonitorApi extends \Core\ApiController
{
/**
     * @ApiEndpoint(
 *   'type' => 'get',
 *   'url' => 'Monitor',
 *   'tags' => 
 *   array (
 *     0 => 'Monitor-Monitor',
 *   ),
 *   'description' => 'Get list of Monitor',
 *   'responses' => 
 *   array (
 *     200 => 
 *     array (
 *       'content' => 
 *       array (
 *         'application/json' => 
 *         array (
 *           'schema' => 
 *           array (
 *             'type' => 'array',
 *             'items' => 
 *             array (
 *               'type' => 'object',
 *               'properties' => 
 *               array (
 *                 'id' => 
 *                 array (
 *                   'type' => 'int',
 *                   'format' => NULL,
 *                 ),
 *                 'name' => 
 *                 array (
 *                   'type' => 'text',
 *                   'format' => NULL,
 *                 ),
 *                 'address' => 
 *                 array (
 *                   'type' => 'text',
 *                   'format' => NULL,
 *                 ),
 *                 'type' => 
 *                 array (
 *                   'type' => 'varchar(256)',
 *                   'format' => NULL,
 *                 ),
 *                 'project_id' => 
 *                 array (
 *                   'type' => 'int',
 *                   'format' => NULL,
 *                 ),
 *               ),
 *             ),
 *           ),
 *         ),
 *       ),
 *     ),
 *   ),
 * )
     **/
    public function getList()
    {
        $this->will('Monitor', 'show');
        $Monitor = new \Monitor\Monitor();
        return $Monitor->getAll();
    }
    
    /**
     * @ApiEndpoint(
 *   'type' => 'get',
 *   'url' => 'Monitor/{id}',
 *   'tags' => 
 *   array (
 *     0 => 'Monitor-Monitor',
 *   ),
 *   'description' => 'Get one Monitor',
 *   'parameters' => 
 *   array (
 *     0 => 
 *     array (
 *       'name' => 'id',
 *       'in' => 'path',
 *       'required' => true,
 *     ),
 *   ),
 *   'responses' => 
 *   array (
 *     200 => 
 *     array (
 *       'content' => 
 *       array (
 *         'application/json' => 
 *         array (
 *           'schema' => 
 *           array (
 *             'type' => 'object',
 *             'properties' => 
 *             array (
 *               'id' => 
 *               array (
 *                 'type' => 'int',
 *                 'format' => NULL,
 *               ),
 *               'name' => 
 *               array (
 *                 'type' => 'text',
 *                 'format' => NULL,
 *               ),
 *               'address' => 
 *               array (
 *                 'type' => 'text',
 *                 'format' => NULL,
 *               ),
 *               'type' => 
 *               array (
 *                 'type' => 'varchar(256)',
 *                 'format' => NULL,
 *               ),
 *               'project_id' => 
 *               array (
 *                 'type' => 'int',
 *                 'format' => NULL,
 *               ),
 *             ),
 *           ),
 *         ),
 *       ),
 *     ),
 *   ),
 * )
     **/
    public function getOneById(int $id)
    {
        $this->will('Monitor', 'show');
        $Monitor = new \Monitor\Monitor();
        return $Monitor->getById($id);
    }
     /**
     * @ApiEndpoint(
 *   'type' => 'post',
 *   'url' => 'Monitor',
 *   'tags' => 
 *   array (
 *     0 => 'Monitor-Monitor',
 *   ),
 *   'description' => 'Insert one Monitor',
 *   'requestBody' => 
 *   array (
 *     'content' => 
 *     array (
 *       'application/json' => 
 *       array (
 *         'schema' => 
 *         array (
 *           'type' => 'object',
 *           'properties' => 
 *           array (
 *             'id' => 
 *             array (
 *               'type' => 'int',
 *               'format' => NULL,
 *             ),
 *             'name' => 
 *             array (
 *               'type' => 'text',
 *               'format' => NULL,
 *             ),
 *             'address' => 
 *             array (
 *               'type' => 'text',
 *               'format' => NULL,
 *             ),
 *             'type' => 
 *             array (
 *               'type' => 'varchar(256)',
 *               'format' => NULL,
 *             ),
 *             'project_id' => 
 *             array (
 *               'type' => 'int',
 *               'format' => NULL,
 *             ),
 *           ),
 *         ),
 *       ),
 *     ),
 *   ),
 *   'responses' => 
 *   array (
 *     200 => 
 *     array (
 *       'content' => 
 *       array (
 *         'application/json' => 
 *         array (
 *           'schema' => 
 *           array (
 *             'type' => 'object',
 *             'properties' => 
 *             array (
 *               'id' => 
 *               array (
 *                 'type' => 'int',
 *                 'format' => NULL,
 *               ),
 *               'name' => 
 *               array (
 *                 'type' => 'text',
 *                 'format' => NULL,
 *               ),
 *               'address' => 
 *               array (
 *                 'type' => 'text',
 *                 'format' => NULL,
 *               ),
 *               'type' => 
 *               array (
 *                 'type' => 'varchar(256)',
 *                 'format' => NULL,
 *               ),
 *               'project_id' => 
 *               array (
 *                 'type' => 'int',
 *                 'format' => NULL,
 *               ),
 *             ),
 *           ),
 *         ),
 *       ),
 *     ),
 *   ),
 * )
     **/
    public function insert($data)
    {
        $this->will('Monitor', 'add');
        $Monitor = new \Monitor\Monitor();
        $id = $Monitor->insert($data);
        return $Monitor->getById($id);
    }
    
        /**
     * @ApiEndpoint(
 *   'type' => 'put',
 *   'url' => 'Monitor/{id}',
 *   'tags' => 
 *   array (
 *     0 => 'Monitor-Monitor',
 *   ),
 *   'description' => 'Insert one Monitor',
 *   'parameters' => 
 *   array (
 *     0 => 
 *     array (
 *       'name' => 'id',
 *       'in' => 'path',
 *       'required' => true,
 *     ),
 *   ),
 *   'requestBody' => 
 *   array (
 *     'content' => 
 *     array (
 *       'application/json' => 
 *       array (
 *         'schema' => 
 *         array (
 *           'type' => 'object',
 *           'properties' => 
 *           array (
 *             'id' => 
 *             array (
 *               'type' => 'int',
 *               'format' => NULL,
 *             ),
 *             'name' => 
 *             array (
 *               'type' => 'text',
 *               'format' => NULL,
 *             ),
 *             'address' => 
 *             array (
 *               'type' => 'text',
 *               'format' => NULL,
 *             ),
 *             'type' => 
 *             array (
 *               'type' => 'varchar(256)',
 *               'format' => NULL,
 *             ),
 *             'project_id' => 
 *             array (
 *               'type' => 'int',
 *               'format' => NULL,
 *             ),
 *           ),
 *         ),
 *       ),
 *     ),
 *   ),
 *   'responses' => 
 *   array (
 *     200 => 
 *     array (
 *       'content' => 
 *       array (
 *         'application/json' => 
 *         array (
 *           'schema' => 
 *           array (
 *             'type' => 'object',
 *             'properties' => 
 *             array (
 *               'id' => 
 *               array (
 *                 'type' => 'int',
 *                 'format' => NULL,
 *               ),
 *               'name' => 
 *               array (
 *                 'type' => 'text',
 *                 'format' => NULL,
 *               ),
 *               'address' => 
 *               array (
 *                 'type' => 'text',
 *                 'format' => NULL,
 *               ),
 *               'type' => 
 *               array (
 *                 'type' => 'varchar(256)',
 *                 'format' => NULL,
 *               ),
 *               'project_id' => 
 *               array (
 *                 'type' => 'int',
 *                 'format' => NULL,
 *               ),
 *             ),
 *           ),
 *         ),
 *       ),
 *     ),
 *   ),
 * )
     **/
    public function update($data, int $id)
    {
        $this->will('Monitor', 'edit');
        $Monitor = new \Monitor\Monitor();
        $Monitor->update($id, $data);
        return $Monitor->getById($id);
    }
    

}