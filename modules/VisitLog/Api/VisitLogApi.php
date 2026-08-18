<?php
namespace VisitLog\Api;

class VisitLogApi extends \Core\ApiController
{
     /**
     * @ApiEndpoint(
 *   'type' => 'post',
 *   'url' => 'VisitLog',
      *   'allowNotLogged'=>true,
 *   'tags' =>
 *   array (
 *     0 => 'VisitLog-VisitLog',
 *   ),
 *   'description' => 'Insert one VisitLog',
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
 *             'project_id' =>
 *             array (
 *               'type' => 'int',
 *               'format' => NULL,
 *             ),
 *             'userIdentifier' =>
 *             array (
 *               'type' => 'varchar(32)',
 *               'format' => NULL,
 *             ),
 *             'userAgent' =>
 *             array (
 *               'type' => 'text',
 *               'format' => NULL,
 *             ),
 *             'ipAddress' =>
 *             array (
 *               'type' => 'varchar(45)',
 *               'format' => NULL,
 *             ),
 *             'sessionIdentifier' =>
 *             array (
 *               'type' => 'varchar(32)',
 *               'format' => NULL,
 *             ),
 *             'pageOpenIdentifier' =>
 *             array (
 *               'type' => 'varchar(32)',
 *               'format' => NULL,
 *             ),
 *             'url' =>
 *             array (
 *               'type' => 'text',
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
 *             'type' =>
 *             array (
 *               'type' => 'varchar(32)',
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
 *               'project_id' =>
 *               array (
 *                 'type' => 'int',
 *                 'format' => NULL,
 *               ),
 *               'userIdentifier' =>
 *               array (
 *                 'type' => 'varchar(32)',
 *                 'format' => NULL,
 *               ),
 *               'userAgent' =>
 *               array (
 *                 'type' => 'text',
 *                 'format' => NULL,
 *               ),
 *               'ipAddress' =>
 *               array (
 *                 'type' => 'varchar(45)',
 *                 'format' => NULL,
 *               ),
 *               'sessionIdentifier' =>
 *               array (
 *                 'type' => 'varchar(32)',
 *                 'format' => NULL,
 *               ),
 *               'pageOpenIdentifier' =>
 *               array (
 *                 'type' => 'varchar(32)',
 *                 'format' => NULL,
 *               ),
 *               'url' =>
 *               array (
 *                 'type' => 'text',
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
 *               'type' =>
 *               array (
 *                 'type' => 'varchar(32)',
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
        $VisitLog = new \VisitLog\VisitLog();
        $id = $VisitLog->insert($data);
        return $VisitLog->getById($id);
    }


    public function hasPermission(string $methodName)
    {
        return true;
    }
}
