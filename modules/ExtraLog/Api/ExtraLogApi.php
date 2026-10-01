<?php
namespace ExtraLog\Api;

class ExtraLogApi extends \Core\ApiController
{
     /**
     * @ApiEndpoint(
 *   'type' => 'post',
 *   'url' => 'ExtraLog',
 *    'allowNotLogged'=>true,
 *   'tags' =>
 *   array (
 *     0 => 'ExtraLog-ExtraLog',
 *   ),
 *   'description' => 'Insert one ExtraLog',
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
 *               'type' => 'bigint',
 *               'format' => NULL,
 *             ),
 *             'project_id' =>
 *             array (
 *               'type' => 'int',
 *               'format' => NULL,
 *             ),
 *             'pageOpenIdentifier' =>
 *             array (
 *               'type' => 'varchar(32)',
 *               'format' => NULL,
 *             ),
 *             'created' =>
 *             array (
 *               'type' => 'datetime',
 *               'format' => 'date-time',
 *             ),
 *             'added' =>
 *             array (
 *               'type' => 'datetime',
 *               'format' => 'date-time',
 *             ),
 *             'source' =>
 *             array (
 *               'type' => 'varchar(32)',
 *               'format' => NULL,
 *             ),
 *             'type' =>
 *             array (
 *               'type' => 'text',
 *               'format' => NULL,
 *             ),
 *             'data' =>
 *             array (
 *               'type' => 'JSON',
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
 *                 'type' => 'bigint',
 *                 'format' => NULL,
 *               ),
 *               'project_id' =>
 *               array (
 *                 'type' => 'int',
 *                 'format' => NULL,
 *               ),
 *               'pageOpenIdentifier' =>
 *               array (
 *                 'type' => 'varchar(32)',
 *                 'format' => NULL,
 *               ),
 *               'created' =>
 *               array (
 *                 'type' => 'datetime',
 *                 'format' => 'date-time',
 *               ),
 *               'added' =>
 *               array (
 *                 'type' => 'datetime',
 *                 'format' => 'date-time',
 *               ),
 *               'source' =>
 *               array (
 *                 'type' => 'varchar(32)',
 *                 'format' => NULL,
 *               ),
 *               'type' =>
 *               array (
 *                 'type' => 'text',
 *                 'format' => NULL,
 *               ),
 *               'data' =>
 *               array (
 *                 'type' => 'JSON',
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
        $ExtraLog = new \ExtraLog\ExtraLog();
        $id = $ExtraLog->insert($data);
        return $ExtraLog->getById($id);
    }

    public function hasPermission(string $methodName)
    {
        return true;
    }
}
