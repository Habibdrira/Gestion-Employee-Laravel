<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    //
    public function showNotifications()
    {
        // Récupère toutes les notifications de l'utilisateur connecté
        $notifications = auth()->user()->notifications;

        // Retourne la vue avec les notifications
        return view('employee.notifications.index', compact('notifications'));
    }





    public function markAllAsRead()
    {
        // Marquer toutes les notifications non lues comme lues
        auth()->user()->unreadNotifications->markAsRead();

        // Redirige l'utilisateur vers la page des notifications
        return redirect()->route('notifications.show');


    }
    
    public function adminShowNotifications()
    {
        // Récupère les notifications pour l'administrateur connecté
        $notifications = auth()->user()->notifications;

        // Retourne la vue avec les notifications
        return view('admin.notifications.index', compact('notifications'));
    }


    public function adminMarkAllAsRead()
    {
        // Marquer toutes les notifications non lues comme lues
        auth()->user()->unreadNotifications->markAsRead();

        // Redirige l'utilisateur vers la page des notifications
        return redirect()->route('admin.notifications.show')->with('success', 'Toutes les notifications ont été marquées comme lues.');
    }

}
