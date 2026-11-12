<?php

namespace Project\Api;

use ApiEndpoint;

class ProjectApi extends \Core\ApiController
{
    #[ApiEndpoint(
        type: 'get',
        url: 'Project',
        tags: ['Project-Project'],
        description: 'Get list of Project',
        responses: [
            200 => [
                'content' => [
                    'application/json' => [
                        'schema' => [
                            'type' => 'array',
                            'items' => [
                                'type' => 'object',
                                'properties' => [
                                    'id' => ['type' => 'int'],
                                    'name' => ['type' => 'text'],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
    )]
    public function getList()
    {
        $this->will('Project', 'show');
        $Project = new \Project\Project();
        return $Project->getAll();
    }

    /**
     * @ApiEndpoint(
     *   'type' => 'get',
     *   'url' => 'Project/{id}',
     *   'tags' =>
     *   array (
     *     0 => 'Project-Project',
     *   ),
     *   'description' => 'Get one Project',
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
        $this->will('Project', 'show');
        $Project = new \Project\Project();
        return $Project->getById($id);
    }

    /**
     * @ApiEndpoint(
     *   'type' => 'post',
     *   'url' => 'Project',
     *   'tags' =>
     *   array (
     *     0 => 'Project-Project',
     *   ),
     *   'description' => 'Insert one Project',
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
        $this->will('Project', 'add');
        $Project = new \Project\Project();
        $id = $Project->insert($data);
        return $Project->getById($id);
    }

    /**
     * @ApiEndpoint(
     *   'type' => 'put',
     *   'url' => 'Project/{id}',
     *   'tags' =>
     *   array (
     *     0 => 'Project-Project',
     *   ),
     *   'description' => 'Insert one Project',
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
        $this->will('Project', 'edit');
        $Project = new \Project\Project();
        $Project->update($id, $data);
        return $Project->getById($id);
    }


}
