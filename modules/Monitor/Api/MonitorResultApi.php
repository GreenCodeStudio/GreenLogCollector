<?php
namespace Monitor\Api;

class MonitorResultApi extends \Core\ApiController
{
/**
     * @ApiEndpoint(
 *   'type' => 'get',
 *   'url' => 'MonitorResult',
 *   'tags' => 
 *   array (
 *     0 => 'Monitor-MonitorResult',
 *   ),
 *   'description' => 'Get list of MonitorResult',
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
 *                 'monitor_id' => 
 *                 array (
 *                   'type' => 'int',
 *                   'format' => NULL,
 *                 ),
 *                 'stamp' => 
 *                 array (
 *                   'type' => 'datetime',
 *                   'format' => 'date-time',
 *                 ),
 *                 'response_time' => 
 *                 array (
 *                   'type' => 'float',
 *                   'format' => NULL,
 *                 ),
 *                 'is_success' => 
 *                 array (
 *                   'type' => 'tinyint(1)',
 *                   'format' => NULL,
 *                 ),
 *                 'status' => 
 *                 array (
 *                   'type' => 'json',
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
        $this->will('MonitorResult', 'show');
        $MonitorResult = new \Monitor\MonitorResult();
        return $MonitorResult->getAll();
    }
    
    /**
     * @ApiEndpoint(
 *   'type' => 'get',
 *   'url' => 'MonitorResult/{id}',
 *   'tags' => 
 *   array (
 *     0 => 'Monitor-MonitorResult',
 *   ),
 *   'description' => 'Get one MonitorResult',
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
 *               'monitor_id' => 
 *               array (
 *                 'type' => 'int',
 *                 'format' => NULL,
 *               ),
 *               'stamp' => 
 *               array (
 *                 'type' => 'datetime',
 *                 'format' => 'date-time',
 *               ),
 *               'response_time' => 
 *               array (
 *                 'type' => 'float',
 *                 'format' => NULL,
 *               ),
 *               'is_success' => 
 *               array (
 *                 'type' => 'tinyint(1)',
 *                 'format' => NULL,
 *               ),
 *               'status' => 
 *               array (
 *                 'type' => 'json',
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
        $this->will('MonitorResult', 'show');
        $MonitorResult = new \Monitor\MonitorResult();
        return $MonitorResult->getById($id);
    }
     /**
     * @ApiEndpoint(
 *   'type' => 'post',
 *   'url' => 'MonitorResult',
 *   'tags' => 
 *   array (
 *     0 => 'Monitor-MonitorResult',
 *   ),
 *   'description' => 'Insert one MonitorResult',
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
 *             'monitor_id' => 
 *             array (
 *               'type' => 'int',
 *               'format' => NULL,
 *             ),
 *             'stamp' => 
 *             array (
 *               'type' => 'datetime',
 *               'format' => 'date-time',
 *             ),
 *             'response_time' => 
 *             array (
 *               'type' => 'float',
 *               'format' => NULL,
 *             ),
 *             'is_success' => 
 *             array (
 *               'type' => 'tinyint(1)',
 *               'format' => NULL,
 *             ),
 *             'status' => 
 *             array (
 *               'type' => 'json',
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
 *               'monitor_id' => 
 *               array (
 *                 'type' => 'int',
 *                 'format' => NULL,
 *               ),
 *               'stamp' => 
 *               array (
 *                 'type' => 'datetime',
 *                 'format' => 'date-time',
 *               ),
 *               'response_time' => 
 *               array (
 *                 'type' => 'float',
 *                 'format' => NULL,
 *               ),
 *               'is_success' => 
 *               array (
 *                 'type' => 'tinyint(1)',
 *                 'format' => NULL,
 *               ),
 *               'status' => 
 *               array (
 *                 'type' => 'json',
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
        $this->will('MonitorResult', 'add');
        $MonitorResult = new \Monitor\MonitorResult();
        $id = $MonitorResult->insert($data);
        return $MonitorResult->getById($id);
    }
    
        /**
     * @ApiEndpoint(
 *   'type' => 'put',
 *   'url' => 'MonitorResult/{id}',
 *   'tags' => 
 *   array (
 *     0 => 'Monitor-MonitorResult',
 *   ),
 *   'description' => 'Insert one MonitorResult',
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
 *             'monitor_id' => 
 *             array (
 *               'type' => 'int',
 *               'format' => NULL,
 *             ),
 *             'stamp' => 
 *             array (
 *               'type' => 'datetime',
 *               'format' => 'date-time',
 *             ),
 *             'response_time' => 
 *             array (
 *               'type' => 'float',
 *               'format' => NULL,
 *             ),
 *             'is_success' => 
 *             array (
 *               'type' => 'tinyint(1)',
 *               'format' => NULL,
 *             ),
 *             'status' => 
 *             array (
 *               'type' => 'json',
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
 *               'monitor_id' => 
 *               array (
 *                 'type' => 'int',
 *                 'format' => NULL,
 *               ),
 *               'stamp' => 
 *               array (
 *                 'type' => 'datetime',
 *                 'format' => 'date-time',
 *               ),
 *               'response_time' => 
 *               array (
 *                 'type' => 'float',
 *                 'format' => NULL,
 *               ),
 *               'is_success' => 
 *               array (
 *                 'type' => 'tinyint(1)',
 *                 'format' => NULL,
 *               ),
 *               'status' => 
 *               array (
 *                 'type' => 'json',
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
        $this->will('MonitorResult', 'edit');
        $MonitorResult = new \Monitor\MonitorResult();
        $MonitorResult->update($id, $data);
        return $MonitorResult->getById($id);
    }
    

}