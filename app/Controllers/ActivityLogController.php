<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class ActivityLogController extends BaseController
{
    public function index(): string
    {
        $search = trim((string) $this->request->getGet('search'));
        $action = (string) $this->request->getGet('action');
        $entity = (string) $this->request->getGet('entity');

        $query = $this->activityLogModel
            ->select('activity_logs.*, users.username')
            ->join(
                'users',
                'users.id = activity_logs.user_id',
                'left'
            );

        if ($search !== '') {
            $query->groupStart()
                ->like('activity_logs.activity', $search)
                ->orLike('users.username', $search)
                ->groupEnd();
        }

        if ($action !== '') {
            $query->where('activity_logs.action', $action);
        }

        if ($entity !== '') {
            $query->where('activity_logs.entity', $entity);
        }

        $activityLogs = $query
            ->orderBy('activity_logs.created_at', 'DESC')
            ->findAll();

        return view('admin/activity_logs/index', [
            'title'        => 'Activity Log',
            'pageTitle'    => 'Activity Log',
            'activityLogs' => $activityLogs,
            'search'       => $search,
            'action'       => $action,
            'entity'       => $entity,
        ]);
    }
}
