<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        // Mock notifications data
        $notifications = [
            [
                'id' => 1,
                'type' => 'leave_request',
                'title' => 'New Leave Request',
                'message' => 'John Smith has requested leave from March 10-15, 2024',
                'time' => '5 minutes ago',
                'read' => false,
                'icon' => 'fa-calendar-alt',
                'color' => 'blue'
            ],
            [
                'id' => 2,
                'type' => 'performance_review',
                'title' => 'Performance Review Due',
                'message' => 'Performance review for Sarah Johnson is due this week',
                'time' => '1 hour ago',
                'read' => false,
                'icon' => 'fa-chart-line',
                'color' => 'green'
            ],
            [
                'id' => 3,
                'type' => 'attendance_alert',
                'title' => 'Attendance Alert',
                'message' => 'Michael Brown has been absent for 3 consecutive days',
                'time' => '2 hours ago',
                'read' => true,
                'icon' => 'fa-exclamation-triangle',
                'color' => 'yellow'
            ],
            [
                'id' => 4,
                'type' => 'system_update',
                'title' => 'System Update',
                'message' => 'System maintenance scheduled for this weekend',
                'time' => '1 day ago',
                'read' => true,
                'icon' => 'fa-cog',
                'color' => 'purple'
            ],
            [
                'id' => 5,
                'type' => 'birthday',
                'title' => 'Birthday Reminder',
                'message' => 'Emma Wilson\'s birthday is tomorrow',
                'time' => '2 days ago',
                'read' => true,
                'icon' => 'fa-birthday-cake',
                'color' => 'pink'
            ]
        ];

        $unreadCount = count(array_filter($notifications, function($notification) {
            return !$notification['read'];
        }));

        return view('notifications.index', compact('notifications', 'unreadCount'));
    }

    public function markAsRead($id)
    {
        // Mark notification as read logic here
        return response()->json(['success' => true]);
    }

    public function markAllAsRead()
    {
        // Mark all notifications as read logic here
        return response()->json(['success' => true]);
    }

    public function getUnreadCount()
    {
        // Get unread notifications count
        $count = 3; // Mock count
        return response()->json(['count' => $count]);
    }

    public function deleteNotification($id)
    {
        // Delete notification logic here
        return response()->json(['success' => true]);
    }
}
